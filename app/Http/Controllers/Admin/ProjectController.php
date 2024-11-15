<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->with('skillCategory')->get();
        $categories = SkillCategory::all(); // For dropdown
        return view('backend.pages.projects', compact('projects', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'skill_category_id' => 'required|exists:skill_categories,id',
            'description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'github_link' => 'nullable|url',
            'live_demo_link' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload with proper name
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageExtension = $image->getClientOriginalExtension(); // Get file extension
            $imageName = Str::slug($request->input('title')) . '-' . time() . '.' . $imageExtension; // Use project title + timestamp
            $imagePath = $image->storeAs('project_thumbnails', $imageName, 'public'); // Store with proper name
        }

        Project::create([
            'user_id' => Auth::id(),
            'skill_category_id' => $request->input('skill_category_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'technologies' => json_encode(explode(',', $request->input('technologies'))),
            'github_link' => $request->input('github_link'),
            'live_demo_link' => $request->input('live_demo_link'),
            'youtube_url' => $request->input('youtube_url'),
            'image' => $imagePath,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project added successfully.');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'skill_category_id' => 'required|exists:skill_categories,id',
            'description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'github_link' => 'nullable|url',
            'live_demo_link' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload and delete the old one if necessary
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($project->image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $project->image));
            }

            // Upload the new image with a proper name
            $image = $request->file('image');
            $imageExtension = $image->getClientOriginalExtension(); // Get file extension
            $imageName = Str::slug($request->input('title')) . '-' . time() . '.' . $imageExtension; // Use project title + timestamp
            $imagePath = $image->storeAs('project_thumbnails', $imageName, 'public');
        } else {
            // If no image is provided, keep the old image
            $imagePath = $project->image;
        }

        // Update the project
        $project->update([
            'skill_category_id' => $request->input('skill_category_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'technologies' => json_encode(explode(',', $request->input('technologies'))),
            'github_link' => $request->input('github_link'),
            'live_demo_link' => $request->input('live_demo_link'),
            'youtube_url' => $request->input('youtube_url'),
            'image' => $imagePath,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Delete the image if it exists
        if ($project->image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $project->image));
        }

        $project->delete();

        return redirect()->back()->with('success', 'Project deleted successfully.');
    }
}
