<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function index()
    {
        // Assuming settings are stored as key-value, but for now we might just have simple static form or DB backed
        // Let's assume we want to edit user profile or store name
        // For simplicity, let's just make it a profile edit for the admin
        $user = auth()->user();
        return view('settings.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->id(),
            'password' => 'nullable|min:6',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = asset('storage/' . $path);
        }

        $user->save();

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
    }

    public function removeAvatar()
    {
        $user = auth()->user();
        if ($user->avatar) {
             // Optional: delete file from storage if valid path
             // For now just nullify the database column
            $user->avatar = null;
            $user->save();
        }
        return redirect()->route('settings.index')->with('success', 'Profile picture removed!');
    }
}
