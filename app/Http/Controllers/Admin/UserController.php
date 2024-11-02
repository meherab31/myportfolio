<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view("backend.pages.profile",compact("user"));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Handle profile picture upload and delete the old one if present
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                // Remove the old profile picture
                Storage::disk('public')->delete(str_replace('storage/', '', $user->profile_picture));
            }

            // Define a simpler file name
            $imageName = 'user_' . $user->id . '.' . $request->file('profile_picture')->extension();
            $imagePath = $request->file('profile_picture')->storeAs('profile_pictures', $imageName, 'public');
            $user->profile_picture = 'storage/' . $imagePath;
        }

        /** @var \App\Models\User $user **/
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }




}
