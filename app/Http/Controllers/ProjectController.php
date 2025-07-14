<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectCategory;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('client')->orderByDesc('created_at')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = Client::all();
        $categories = ProjectCategory::all();

        return view('projects.create', compact('clients', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:Not Started,In Progress,Completed',
            'client_id' => 'nullable|exists:clients,id',
            'category_id' => 'nullable|exists:project_categories,id',
        ]);

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'client_id' => $request->client_id,
            'category_id' => $request->category_id,
            //'admin_id' => auth()->guard('admin')->id(), // asumsi pakai guard admin
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $clients = Client::all();
        $categories = ProjectCategory::all();

        return view('projects.edit', compact('project', 'clients', 'categories'));

    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:Not Started,In Progress,Completed',
            'client_id' => 'nullable|exists:clients,id',
            'category_id' => 'nullable|exists:project_categories,id',
        ]);

        $project->update($request->only([
            'title', 'description', 'start_date', 'end_date', 'status', 'client_id'
        ]));

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

}
