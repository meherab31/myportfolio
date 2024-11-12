<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function index()
    {
        // Retrieve educations associated with the logged-in user
        $educations = Education::where('user_id', Auth::id())->get();
        return view('backend.pages.educations', compact('educations'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        // Create new education entry for the logged-in user
        Education::create([
            'user_id' => Auth::id(),
            'degree' => $request->input('degree'),
            'institution' => $request->input('institution'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('educations.index')->with('success', 'Education added successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        // Find the education entry and update it
        $education = Education::findOrFail($id);
        $education->update($request->all());

        return redirect()->route('educations.index')->with('success', 'Education updated successfully.');
    }

    public function destroy($id)
    {
        // Find the education entry and delete it
        $education = Education::findOrFail($id);
        $education->delete();
        return redirect()->back()->with('success', 'Education deleted successfully.');
    }
}
