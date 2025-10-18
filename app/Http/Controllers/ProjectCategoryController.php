<?php

namespace App\Http\Controllers;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:project_categories',
        ]);

        ProjectCategory::create($validatedData);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(ProjectCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, ProjectCategory $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:project_categories,name,' . $category->id,
        ]);

        $category->update($validatedData);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ProjectCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
