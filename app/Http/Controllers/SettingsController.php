<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('shop');
        return view('owner.settings.index', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'shop_name' => 'nullable|string|max:255',
            'shop_description' => 'nullable|string|max:1000',
            'shop_address' => 'nullable|string|max:500',
            'shop_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update or create shop profile
        $shopData = [];
        if ($request->filled('shop_name')) {
            $shopData['name'] = $request->shop_name;
        }
        if ($request->filled('shop_description')) {
            $shopData['description'] = $request->shop_description;
        }
        if ($request->filled('shop_address')) {
            $shopData['address'] = $request->shop_address;
        }

        if ($request->hasFile('shop_logo')) {
            if ($user->shop && $user->shop->logo_path) {
                Storage::disk('public')->delete($user->shop->logo_path);
            }
            $shopData['logo_path'] = $request->file('shop_logo')->store('shop-logos', 'public');
        }

        if (!empty($shopData)) {
            if ($user->shop) {
                $user->shop->update($shopData);
            } else {
                // Create new shop if doesn't exist
                $slug = \Illuminate\Support\Str::slug($request->shop_name ?? $user->name) . '-' . $user->id;
                $user->shop()->create(array_merge($shopData, [
                    'name' => $request->shop_name ?? $user->name . "'s Shop",
                    'slug' => $slug,
                ]));
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
