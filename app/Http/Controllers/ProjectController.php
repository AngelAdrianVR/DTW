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
        $projects = ProjectResource::collection(Project::with(['client', 'tasks'])->latest()->get()->take(20));
        $total_projects = Project::all()->count();

        // return $projects;
        return inertia('Project/Index', compact('projects', 'total_projects'));
    }

    
    public function create()
    {
        $users = User::all(['id', 'name']);
        $clients = Client::all(['id', 'name']);

        return inertia('Project/Create', compact('users', 'clients'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'internal_project' => 'boolean',
            'client_info.phone' => 'nullable|min:10|max:10',
            'hours_work' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'estimated_date' => 'nullable|date',
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date',
            'payment_method' => $request->internal_project ? 'nullable' : 'required|string|max:100',
            'category' => 'required|string|max:100',
            'invoice' => 'nullable|boolean',
            'responsible_id' => 'required',
            'client_id' => $request->internal_project ? 'nullable' : 'required',
            'quote_id' => $request->internal_project ? 'nullable' : 'required',
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
        
        $project = ProjectResource::make(Project::with(['client:id,name', 'user:id,name', 'quote:id,name', 'tasks' => ['comments.user', 'participants', 'project', 'user']])->find($project_id));
        $projects = Project::latest()->get(['id', 'name']);
        $users = User::all(['id', 'name']);

        // return $project;
        return inertia('Project/Show', compact('project', 'projects', 'users'));
    }

    
    public function edit(Project $project)
    {
        $users = User::all(['id', 'name']);
        $quotes = Quote::all(['id', 'name', 'total_cost', 'total_work_days']);
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
            'finish_date' => 'nullable|date',
            'payment_method' => 'required|string|max:100',
            'estimated_date' => 'nullable|date',
            'category' => 'required|string|max:100',
            'invoice' => 'nullable|boolean',
            'responsible_id' => 'required',
            'client_id' => 'required',
            'quote_id' => 'required',
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
            'responsible_id' => 'required',
            'client_id' => 'required',
            'quote_id' => 'required',
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
        $project->delete();
    }


    public function finishProject(Project $project)
    {
        $project->update([
            'finish_date' => now()
        ]);

    }


    public function getItemsByPage($currentPage)
    {
        $offset = $currentPage * 20;
        $projects = ProjectResource::collection(Project::latest()
            ->skip($offset)
            ->take(20)
            ->get());

        return response()->json(['items' => $projects]);
    }
}
