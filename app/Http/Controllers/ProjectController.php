<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
    public function index()
    {

        $projects = ProjectResource::collection(Project::latest()->get());

        return inertia('Project/Index', compact('projects'));
    }

    
    public function create()
    {
        return inertia('Project/Create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'client_info.phone' => 'nullable|min:10|max:10',
            'hours_work' => 'required|numeric|min:1',
            'cuote' => 'required|numeric|min:1',
            'promisse_finish_date' => 'required|date|after:tomorrow',
        ]);

        Project::create($request->all() + ['user_id' => auth()->user()->id]);

        return to_route('projects.index');
    }

    
    public function show(Project $project)
    {
        //
    }

    
    public function edit(Project $project)
    {
        return inertia('Project/Edit', compact('project'));
    }

    
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'client_info.phone' => 'nullable|min:10|max:10',
            'hours_work' => 'required|numeric|min:1',
            'cuote' => 'required|numeric|min:1',
            'promisse_finish_date' => 'required|date|after:tomorrow',
        ]);

        $project->update($request->all());

        return to_route('projects.index');
    }

    
    public function destroy(Project $project)
    {
        //
    }
}
