<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Client;
use App\Models\Project;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
    public function index()
    {
        $projects = ProjectResource::collection(Project::with('client')->latest()->get());

        // return $projects;
        return inertia('Project/Index', compact('projects'));
    }

    
    public function create()
    {
        $users = User::all(['id', 'name']);
        $quotes = Quote::all(['id', 'quote_name', 'total_cost']);
        $clients = Client::all(['id', 'name']);

        return inertia('Project/Create', compact('users', 'quotes', 'clients'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'client_info.phone' => 'nullable|min:10|max:10',
            'hours_work' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date|after:tomorrow',
            'payment_method' => 'required|string|max:100',
            'estimated_date' => 'nullable|date|after:today',
            'category' => 'required|string|max:100',
            'invoice' => 'nullable|boolean',
            'responsible_id' => 'nullable',
            'customer_id' => 'nullable',
            'quote_id' => 'nullable',
        ]);

        $project = Project::create($request->all() + ['user_id' => auth()->user()->id]);

         // Guardar el archivo en la colección 'media'
         if ($request->hasFile('media')) {
            $project->addMediaFromRequest('media')->toMediaCollection('media');
        }

        return to_route('projects.index');
    }

    
    public function show($project_id)
    {
        
        $project = ProjectResource::make(Project::with('client', 'user:id,name', 'quote:id,quote_name')->find($project_id));
        $projects = Project::latest()->get(['id', 'name']);

        // return $project;
        return inertia('Project/Show', compact('project', 'projects'));
    }

    
    public function edit(Project $project)
    {
        $users = User::all(['id', 'name']);
        $quotes = Quote::all(['id', 'quote_name', 'total_cost']);
        $clients = Client::all(['id', 'name']);

        // return $project;
        return inertia('Project/Edit', compact('project', 'users', 'quotes', 'clients'));
    }

    
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'client_info.phone' => 'nullable|min:10|max:10',
            'hours_work' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date|after:tomorrow',
            'payment_method' => 'required|string|max:100',
            'estimated_date' => 'nullable|date|after:today',
            'category' => 'required|string|max:100',
            'invoice' => 'nullable|boolean',
            'responsible_id' => 'nullable',
            'customer_id' => 'nullable',
            'quote_id' => 'nullable',
        ]);

        $project->update($request->all());

        return to_route('projects.index');
    }


    public function updateWithMedia(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'client_info.phone' => 'nullable|min:10|max:10',
            'hours_work' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date|after:tomorrow',
            'payment_method' => 'required|string|max:100',
            'estimated_date' => 'nullable|date|after:today',
            'category' => 'required|string|max:100',
            'invoice' => 'nullable|boolean',
            'responsible_id' => 'nullable',
            'customer_id' => 'nullable',
            'quote_id' => 'nullable',
        ]);

        $project->update($request->all());

        // update images. Clear all then attach all
        if ($request->hasFile('media')) {
            $project->clearMediaCollection('media');
            $project->addMediaFromRequest('media')->toMediaCollection('media');
        }

        return to_route('projects.index');
    }

    
    public function destroy(Project $project)
    {
        //
    }

    public function massiveDelete(Request $request)
    {
        foreach ($request->projects as $project) {
            $project = Project::find($project['id']);
            $project->delete();
        }

        return response()->json(['message' => 'mensaje(s) eliminado(s)']);
    }

    public function finishProject(Project $project)
    {
        $project->update([
            'finish_date' => now()
        ]);

    }
}
