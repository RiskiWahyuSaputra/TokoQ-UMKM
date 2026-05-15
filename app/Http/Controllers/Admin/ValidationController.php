<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function dashboard()
    {
        $pendingCount = User::where('status', 'pending')->where('role', 'owner')->count();
        $activeCount = User::where('status', 'active')->where('role', 'owner')->count();
        $totalShops = Shop::count();
        $recentShops = User::where('role', 'owner')
            ->with('shop')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('pendingCount', 'activeCount', 'totalShops', 'recentShops'));
    }

    public function index()
    {
        $pendingCount = User::where('status', 'pending')->where('role', 'owner')->count();
        $pendingUsers = User::where('status', 'pending')->where('role', 'owner')->with('shop')->get();
        return view('admin.pending-shops', compact('pendingUsers', 'pendingCount'));
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active']);
        return back()->with('success', 'User berhasil diaktifkan.');
    }

    public function shops()
    {
        $shops = Shop::with('owner')->latest()->paginate(20);
        return view('admin.shops', compact('shops'));
    }

    public function users()
    {
        $users = User::with('shop')->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function transactions()
    {
        $transactions = Transaction::with(['shop.owner'])->latest()->paginate(20);
        return view('admin.transactions', compact('transactions'));
    }

    public function reports()
    {
        $totalShops = Shop::count();
        $activeShops = Shop::whereHas('owner', fn($q) => $q->where('status', 'active'))->count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('total_amount');
        $totalProducts = Product::count();

        return view('admin.reports', compact('totalShops', 'activeShops', 'totalTransactions', 'totalRevenue', 'totalProducts'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function logs()
    {
        $logs = [];
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            $content = file_get_contents($logFile);
            $lines = array_filter(array_slice(explode("\n", $content), -100));
            foreach ($lines as $line) {
                if (trim($line)) $logs[] = $line;
            }
        }
        return view('admin.logs', compact('logs'));
    }
}
