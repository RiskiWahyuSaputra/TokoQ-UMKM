<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ValidationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Landing Page
Route::get('/', function () {
    return view('landing');
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
            return redirect()->intended('/admin/validate');
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

    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');

    // POS
    Route::get('/pos', [\App\Http\Controllers\PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/checkout', [\App\Http\Controllers\PosController::class, 'checkout'])->name('pos.checkout');
});

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/validate', [ValidationController::class, 'index'])->name('admin.validate');
    Route::post('/admin/validate/{user}', [ValidationController::class, 'activate']);
});
