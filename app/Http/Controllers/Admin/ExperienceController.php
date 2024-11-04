<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::where('user_id', Auth::id())->get();
        return view('backend.pages.experiences', compact('experiences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        Experience::create([
            'user_id' => Auth::id(),
            'job_title' => $request->input('job_title'),
            'company_name' => $request->input('company_name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('experiences.index')->with('success', 'Experience added successfully.');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $experience = Experience::findOrFail($id);
        $experience->update($request->all());
        // $experience->update([
        //     'job_title' => $request->input('job_title'),
        //     'company_name' => $request->input('company_name'),
        //     'start_date' => $request->input('start_date'),
        //     'end_date' => $request->input('end_date'),
        //     'description' => $request->input('description'),
        // ]);

        return redirect()->route('experiences.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Request $request, $id){
        $experience = Experience::findOrFail($id);
        $experience->delete();
        return redirect()->back();
    }
}
