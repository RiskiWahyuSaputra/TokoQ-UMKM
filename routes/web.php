<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ValidationController;
use App\Models\Shop;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Landing Page
Route::get('/', function () {
    return view('landing', [
        'totalShops' => Shop::count(),
    ]);
})->name('landing');

// Authentication
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Owner Dashboard (Protected by 'active' middleware)
Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Inventory
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [\App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');

    // POS
    Route::get('/pos', [\App\Http\Controllers\PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/checkout', [\App\Http\Controllers\PosController::class, 'checkout'])->name('pos.checkout');

    // Sales
    Route::get('/sales', [\App\Http\Controllers\SalesController::class, 'index'])->name('sales.index');

    // AI Prediction
    Route::get('/ai', [\App\Http\Controllers\AiController::class, 'index'])->name('ai.index');

    // Reports
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');

// Settings
    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
});

// Upgrade Plan (owner only)
Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/upgrade', function () {
        return view('owner.upgrade');
    })->name('upgrade');
    Route::get('/help', function () {
        return view('owner.help');
    })->name('help');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [ValidationController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/validate', [ValidationController::class, 'index'])->name('admin.validate');
    Route::post('/admin/validate/{user}', [ValidationController::class, 'activate'])->name('admin.activate');

    // Additional Admin Routes
    Route::get('/admin/shops', [ValidationController::class, 'shops'])->name('admin.shops');
    Route::get('/admin/users', [ValidationController::class, 'users'])->name('admin.users');
    Route::get('/admin/transactions', [ValidationController::class, 'transactions'])->name('admin.transactions');
    Route::post('/admin/users/{user}/suspend', [ValidationController::class, 'suspendUser'])->name('admin.users.suspend');
    Route::post('/admin/users/{user}/activate', [ValidationController::class, 'activateUser'])->name('admin.users.activate');
    Route::post('/admin/shops/{shop}/suspend', [ValidationController::class, 'suspendShop'])->name('admin.shops.suspend');
    Route::post('/admin/shops/{shop}/activate', [ValidationController::class, 'activateShop'])->name('admin.shops.activate');
    Route::post('/admin/validate/bulk-activate', [ValidationController::class, 'bulkActivate'])->name('admin.validate.bulk-activate');
    Route::post('/admin/validate/{user}/reject', [ValidationController::class, 'reject'])->name('admin.validate.reject');
    Route::post('/admin/validate/{user}/revisi', [ValidationController::class, 'revisi'])->name('admin.validate.revisi');
    Route::get('/admin/reports', [ValidationController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/settings', [ValidationController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [ValidationController::class, 'settingsSave'])->name('admin.settings.save');
    Route::get('/admin/logs', [ValidationController::class, 'logs'])->name('admin.logs');
    Route::get('/admin/audit-logs', [ValidationController::class, 'auditLogs'])->name('admin.audit-logs');
});
