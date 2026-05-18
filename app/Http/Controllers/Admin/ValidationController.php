<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Setting;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function dashboard()
    {
        $pendingCount = User::where('status', 'pending')->where('role', 'owner')->count();
        $activeCount = User::where('status', 'active')->where('role', 'owner')->count();
        $suspendedCount = User::where('status', 'suspended')->where('role', 'owner')->count();
        $totalShops = Shop::count();
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('total_amount');

        // Recent pending shops (only truly pending)
        $recentShops = User::where('status', 'pending')
            ->where('role', 'owner')
            ->with('shop')
            ->latest()
            ->take(10)
            ->get();

        // Trend: transactions last 7 days vs previous 7 days
        $txThisWeek = Transaction::where('created_at', '>=', now()->subDays(7))->count();
        $txLastWeek = Transaction::where('created_at', '>=', now()->subDays(14))
            ->where('created_at', '<', now()->subDays(7))->count();
        $txTrend = $txLastWeek > 0 ? round((($txThisWeek - $txLastWeek) / $txLastWeek) * 100) : ($txThisWeek > 0 ? 100 : 0);

        // Revenue trend
        $revThisWeek = Transaction::where('created_at', '>=', now()->subDays(7))->sum('total_amount');
        $revLastWeek = Transaction::where('created_at', '>=', now()->subDays(14))
            ->where('created_at', '<', now()->subDays(7))->sum('total_amount');
        $revTrend = $revLastWeek > 0 ? round((($revThisWeek - $revLastWeek) / $revLastWeek) * 100) : ($revThisWeek > 0 ? 100 : 0);

        // Daily transaction counts for chart (last 7 days)
        $dailyTx = [];
        $dailyRev = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dailyTx[] = [
                'day' => $date->locale('id')->format('D'),
                'count' => Transaction::whereDate('created_at', $date)->count(),
            ];
            $dailyRev[] = Transaction::whereDate('created_at', $date)->sum('total_amount');
        }

        // Recent audit activity
        $recentAudit = AuditLog::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'pendingCount', 'activeCount', 'suspendedCount', 'totalShops',
            'totalProducts', 'totalTransactions', 'totalRevenue',
            'recentShops', 'txTrend', 'revTrend', 'dailyTx', 'dailyRev', 'recentAudit'
        ));
    }

    public function index()
    {
        $pendingCount = User::where('status', 'pending')->where('role', 'owner')->count();
        $pendingUsers = User::where('status', 'pending')->where('role', 'owner')->with('shop')->latest()->get();
        return view('admin.pending-shops', compact('pendingUsers', 'pendingCount'));
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $oldStatus = $user->status;
        $user->update(['status' => 'active']);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'activate',
            'model_type' => User::class,
            'model_id' => $user->id,
            'old_values' => ['status' => $oldStatus],
            'new_values' => ['status' => 'active'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'description' => "Mengaktifkan toko {$user->shop->name} ({$user->name})",
        ]);

        return back()->with('success', 'User berhasil diaktifkan.');
    }

    public function shops(Request $request)
    {
        $query = Shop::with('owner')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('owner', fn($o) => $o->where('name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('status') && in_array($request->status, ['active', 'pending', 'suspended'])) {
            $query->whereHas('owner', fn($q) => $q->where('status', $request->status));
        }

        $shops = $query->paginate(20)->appends($request->query());
        return view('admin.shops', compact('shops'));
    }

    public function users(Request $request)
    {
        $query = User::with('shop')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && in_array($request->role, ['admin', 'owner'])) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status') && in_array($request->status, ['active', 'pending', 'suspended'])) {
            $query->where('status', $request->status);
        }

        $users = $query->paginate(20)->appends($request->query());
        return view('admin.users', compact('users'));
    }

    public function transactions(Request $request)
    {
        $query = Transaction::with(['shop.owner'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('shop', fn($q) => $q->where('name', 'like', "%{$search}%"));
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->paginate(20)->appends($request->query());
        return view('admin.transactions', compact('transactions'));
    }

    public function suspendUser(User $user)
    {
        $oldStatus = $user->status;
        $user->update(['status' => 'suspended']);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'suspend',
            'model_type' => User::class,
            'model_id' => $user->id,
            'old_values' => ['status' => $oldStatus],
            'new_values' => ['status' => 'suspended'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'description' => "Menonaktifkan pengguna {$user->name}",
        ]);

        return back()->with('success', "Pengguna {$user->name} telah dinonaktifkan.");
    }

    public function activateUser(User $user)
    {
        $oldStatus = $user->status;
        $user->update(['status' => 'active']);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'activate',
            'model_type' => User::class,
            'model_id' => $user->id,
            'old_values' => ['status' => $oldStatus],
            'new_values' => ['status' => 'active'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'description' => "Mengaktifkan kembali pengguna {$user->name}",
        ]);

        return back()->with('success', "Pengguna {$user->name} telah diaktifkan.");
    }

    public function suspendShop(Shop $shop)
    {
        if ($shop->owner) {
            $oldStatus = $shop->owner->status;
            $shop->owner->update(['status' => 'suspended']);

            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'suspend',
                'model_type' => Shop::class,
                'model_id' => $shop->id,
                'old_values' => ['status' => $oldStatus],
                'new_values' => ['status' => 'suspended'],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'description' => "Menonaktifkan toko {$shop->name}",
            ]);
        }
        return back()->with('success', "Toko {$shop->name} telah dinonaktifkan.");
    }

    public function activateShop(Shop $shop)
    {
        if ($shop->owner) {
            $oldStatus = $shop->owner->status;
            $shop->owner->update(['status' => 'active']);

            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'activate',
                'model_type' => Shop::class,
                'model_id' => $shop->id,
                'old_values' => ['status' => $oldStatus],
                'new_values' => ['status' => 'active'],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'description' => "Mengaktifkan toko {$shop->name}",
            ]);
        }
        return back()->with('success', "Toko {$shop->name} telah diaktifkan.");
    }

    public function bulkActivate(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:users,id',
        ]);

        $users = User::whereIn('id', $request->ids)->get();
        foreach ($users as $user) {
            $oldStatus = $user->status;
            $user->update(['status' => 'active']);

            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'activate',
                'model_type' => User::class,
                'model_id' => $user->id,
                'old_values' => ['status' => $oldStatus],
                'new_values' => ['status' => 'active'],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'description' => "Bulk aktif: {$user->name}",
            ]);
        }

        return back()->with('success', count($request->ids) . ' pengguna berhasil diaktifkan.');
    }

    public function reject(Request $request, User $user)
    {
        $request->validate(['reason' => 'required|string|max:500']);
        $oldStatus = $user->status;
        $user->update(['status' => 'suspended']);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'suspend',
            'model_type' => User::class,
            'model_id' => $user->id,
            'old_values' => ['status' => $oldStatus],
            'new_values' => ['status' => 'suspended'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'description' => "Menolak pendaftaran {$user->name}. Alasan: {$request->reason}",
        ]);

        return back()->with('success', "Pendaftaran {$user->name} ditolak.");
    }

    public function revisi(Request $request, User $user)
    {
        $request->validate(['reason' => 'required|string|max:500']);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => User::class,
            'model_id' => $user->id,
            'old_values' => [],
            'new_values' => ['revision_requested' => true],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'description' => "Minta revisi {$user->name}. Alasan: {$request->reason}",
        ]);

        return back()->with('success', "Permintaan revisi telah dikirim ke {$user->name}.");
    }

    public function reports()
    {
        $totalShops = Shop::count();
        $activeShops = Shop::whereHas('owner', fn($q) => $q->where('status', 'active'))->count();
        $suspendedShops = Shop::whereHas('owner', fn($q) => $q->where('status', 'suspended'))->count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('total_amount');
        $totalProducts = Product::count();

        // Daily revenue for last 14 days
        $dailyRevenue = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dailyRevenue[] = [
                'date' => $date->format('d M'),
                'revenue' => Transaction::whereDate('created_at', $date)->sum('total_amount'),
                'count' => Transaction::whereDate('created_at', $date)->count(),
            ];
        }

        // Top shops by revenue
        $topShops = Shop::with('owner')
            ->withSum('transactions', 'total_amount')
        ->orderByDesc('transactions_sum_total_amount')
        ->take(10)
        ->get();

        // Top products
        $topProducts = Product::with('shop')
            ->withCount('transactionItems')
            ->orderByDesc('transaction_items_count')
            ->take(10)
            ->get();

        return view('admin.reports', compact(
            'totalShops', 'activeShops', 'suspendedShops',
            'totalTransactions', 'totalRevenue', 'totalProducts',
            'dailyRevenue', 'topShops', 'topProducts'
        ));
    }

    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function settingsSave(Request $request)
    {
        $data = $request->validate([
            'auto_approve' => 'nullable|boolean',
            'email_notification' => 'nullable|boolean',
            'maintenance_mode' => 'nullable|boolean',
            'admin_password' => 'nullable|string|min:8',
        ]);

        Setting::updateOrCreate(['key' => 'auto_approve'], ['value' => $request->has('auto_approve') ? '1' : '0', 'group' => 'general']);
        Setting::updateOrCreate(['key' => 'email_notification'], ['value' => $request->has('email_notification') ? '1' : '0', 'group' => 'general']);
        Setting::updateOrCreate(['key' => 'maintenance_mode'], ['value' => $request->has('maintenance_mode') ? '1' : '0', 'group' => 'general']);

        if (!empty($data['admin_password'])) {
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                $admin->update(['password' => bcrypt($data['admin_password'])]);
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    public function logs()
    {
        $systemLogs = [];
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            $content = file_get_contents($logFile);
            $lines = array_filter(array_slice(explode("\n", $content), -50));
            foreach ($lines as $line) {
                if (!trim($line)) continue;
                // Aggressive sanitization: remove all local paths
                $line = preg_replace('/[A-Z]:[\\\\\\/][^\\s\\])]+/', '[path]', $line);
                $line = preg_replace('#/(home|var/www|mnt)/[^\s\\])]+#', '[path]', $line);
                $line = preg_replace('/\b(?:password|token|secret|key|credential)\s*[:=]\s*\S+/i', '$1: [redacted]', $line);
                // Parse log level
                $level = 'info';
                if (preg_match('/\] (\w+)\./', $line, $m)) {
                    $level = strtolower($m[1]);
                }
                $systemLogs[] = ['raw' => $line, 'level' => $level];
            }
        }
        return view('admin.logs', compact('systemLogs'));
    }

    public function auditLogs(Request $request)
    {
        $query = AuditLog::with('user')->latest();

        if ($request->filled('action') && in_array($request->action, ['create', 'update', 'delete', 'activate', 'suspend'])) {
            $query->where('action', $request->action);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->paginate(25)->appends($request->query());
        return view('admin.audit-logs', compact('logs'));
    }
}
