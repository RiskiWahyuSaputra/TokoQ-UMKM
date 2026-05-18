<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => ['sometimes', 'required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'shop_name' => 'sometimes|required|string|max:255',
            'shop_description' => 'nullable|string|max:1000',
            'shop_address' => 'nullable|string|max:500',
            'shop_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->has('name')) {
            $user->name = $validated['name'];
        }

        if ($request->has('email')) {
            $user->email = $validated['email'];
        }

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->isDirty()) {
            $user->save();
        }

        // Update or create shop profile
        $shopData = [];
        if ($request->has('shop_name')) {
            $shopData['name'] = $validated['shop_name'];
        }
        if ($request->has('shop_description')) {
            $shopData['description'] = $validated['shop_description'] ?? null;
        }
        if ($request->has('shop_address')) {
            $shopData['address'] = $validated['shop_address'] ?? null;
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
                $shopName = $shopData['name'] ?? $user->name . "'s Shop";
                $slug = Str::slug($shopName) . '-' . $user->id;

                $user->shop()->create(array_merge($shopData, [
                    'name' => $shopName,
                    'slug' => $slug,
                ]));
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
