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
            'hours_work' => 'required|numeric|min:1',
            'cuote' => 'required|numeric|min:1',
            'promisse_finish_date' => 'required|date',
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
        //
    }

    
    public function update(Request $request, Project $project)
    {
        //
    }

    
    public function destroy(Project $project)
    {
        //
    }
}
