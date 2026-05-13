<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
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
        $pendingUsers = User::where('status', 'pending')->where('role', 'owner')->with('shop')->get();
        return view('admin.pending-shops', compact('pendingUsers'));
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active']);
        return back()->with('success', 'User berhasil diaktifkan.');
    }
}
