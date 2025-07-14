<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;


class ProjectCategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:project_categories,name|max:255',
        ]);

        ProjectCategory::create(['name' => $request->name]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ProjectCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, ProjectCategory $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:project_categories,name,' . $category->id,
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ProjectCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

