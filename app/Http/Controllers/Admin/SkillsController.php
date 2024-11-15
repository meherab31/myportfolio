<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index()
    {
        $categories = SkillCategory::with('skills')->get();
        return view('backend.pages.skills.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('backend.pages.skills.create_category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        SkillCategory::create(['name' => $request->name]);
        return redirect()->route('skills.index')->with('success', 'Category added successfully!');
    }

    public function createSkill()
    {
        $categories = SkillCategory::all();
        return view('backend.pages.skills.create_skill', compact('categories'));
    }

    public function storeSkill(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:skill_categories,id',
            'percentage' => 'required|integer|between:0,100',
        ]);

        Skill::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill added successfully!');
    }

    public function editCategory($id)
    {
        $category = SkillCategory::findOrFail($id);
        return view('backend.pages.skills.edit_category', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category = SkillCategory::findOrFail($id);
        $category->update(['name' => $request->name]);
        return redirect()->route('skills.index')->with('success', 'Category updated successfully!');
    }

    public function editSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $categories = SkillCategory::all();
        return view('backend.pages.skills.edit_skill', compact('skill', 'categories'));
    }

    public function updateSkill(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:skill_categories,id',
            'percentage' => 'required|integer|between:0,100',
        ]);

        $skill = Skill::findOrFail($id);
        $skill->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully!');
    }

    public function deleteCategory($id)
    {
        $category = SkillCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('skills.index')->with('success', 'Category deleted successfully!');
    }

    public function deleteSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully!');
    }
}
