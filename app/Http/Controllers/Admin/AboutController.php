<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\About;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();

        // If no About record exists, create a new instance
        if (!$about) {
            $about = new About();
        }

        return view("backend.pages.about", compact("about"));
    }

    public function update(Request $request)
    {
        // Fetch the first About instance
        $about = About::first() ?? new About();

        // Validate the incoming request
        $request->validate([
            'bio' => 'required|string|max:1000', // Example validation
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15', // Adjust as needed
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the about information
        $about->bio = $request->input('bio');
        $about->address = $request->input('address');
        $about->phone = $request->input('phone');

        // Handle image upload and delete the old one if present
        if ($request->hasFile('image')) {
            if ($about->image) {
                // Remove the old image
                Storage::disk('public')->delete(str_replace('storage/', '', $about->image));
            }

            // Define a simpler file name
            $imageName = 'about_image.' . $request->file('image')->extension();
            $imagePath = $request->file('image')->storeAs('about_images', $imageName, 'public');
            $about->image = 'storage/' . $imagePath;
        }

        $about->save();

        return redirect()->route('about')->with('success', 'About information updated successfully!');
    }
}
