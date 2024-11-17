<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    public function index()
    {

        $blogs = Blog::where('user_id', Auth::id())->paginate(10);
        return view('backend.pages.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('backend.pages.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $thumbnailPath = $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->store('blog_thumbnails', 'public')
            : null;

        Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'thumbnail' => $thumbnailPath,
            'status' => $request->input('status', 1),
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

        public function upload(Request $request)
    {
        // Validate image
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the image
        $image = $request->file('upload');
        $path = $image->store('blog_images', 'public');

        // Return the URL of the uploaded image
        return response()->json([
            'url' => Storage::url($path)
        ]);
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('backend.pages.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Remove old thumbnail if exists
            if ($blog->thumbnail) {
                Storage::disk('public')->delete($blog->thumbnail);
            }

            $blog->thumbnail = $request->file('thumbnail')->store('blog_thumbnails', 'public');
        }

        $blog->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'thumbnail' => $blog->thumbnail,
            'status' => $request->input('status', 1),
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Remove thumbnail if exists
        if ($blog->thumbnail) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
