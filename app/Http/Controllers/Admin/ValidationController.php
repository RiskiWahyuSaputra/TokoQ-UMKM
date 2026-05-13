<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('status', 'pending')->where('role', 'owner')->get();
        return view('admin.pending-shops', compact('pendingUsers'));
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active']);
        return back()->with('success', 'User activated successfully.');
    }
}
