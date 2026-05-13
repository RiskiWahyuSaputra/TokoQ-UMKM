<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Auth::user()->shop->categories;
        return view('owner.inventory.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'shop_id' => Auth::user()->shop->id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }
}
