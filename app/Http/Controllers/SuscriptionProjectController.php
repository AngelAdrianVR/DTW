<?php

namespace App\Http\Controllers;

use App\Models\SuscriptionProject;
use App\Models\User;
use Illuminate\Http\Request;

class SuscriptionProjectController extends Controller
{
    
    public function index()
    {
        $suscription_projects = SuscriptionProject::with(['responsible:id,name'])->get()->take(30);
        $total_projects = SuscriptionProject::all()->count();

        // return $suscription_projects;
        return inertia('SuscriptionProject/Index', compact('suscription_projects', 'total_projects'));
    }

    
    public function create()
    {
        $users = User::all(['id', 'name']);

        return inertia('SuscriptionProject/Create', compact('users'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'subscribers_quantity' => 'required|numeric|min:0|max:10000',
            'public_price' => 'required|numeric|min:0|max:5000',
            'plans_quantity' => 'required|numeric|min:1|max:5',
            'status' => 'required|string',
            'release_date' => 'nullable|date|before:tomorrow',
            'responsible_id' => 'nullable',
            'description' => 'nullable|string|max:200',
        ]);

        $suscription_project = SuscriptionProject::create($request->all());

        return to_route('suscription-projects.show', $suscription_project->id);
    }

    
    public function show(SuscriptionProject $suscriptionProject)
    {
        //
    }

    
    public function edit(SuscriptionProject $suscription_project)
    {
        $users = User::all(['id', 'name']);

        return inertia('SuscriptionProject/Edit', compact('users', 'suscription_project'));
    }

   
    public function update(Request $request, SuscriptionProject $suscription_project)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'subscribers_quantity' => 'required|numeric|min:0|max:10000',
            'public_price' => 'required|numeric|min:0|max:5000',
            'plans_quantity' => 'required|numeric|min:1|max:5',
            'status' => 'required|string',
            'release_date' => 'nullable|date|before:tomorrow',
            'responsible_id' => 'nullable',
            'description' => 'nullable|string|max:200',
        ]);

        $suscription_project->update($request->all());

        return to_route('suscription-projects.show', $suscription_project->id);
    }

    
    public function destroy(SuscriptionProject $suscription_project)
    {
        //
    }


    public function updateStatus(SuscriptionProject $suscription_project, $status)
    {
        $suscription_project->update([
            'status' => $status
        ]);
    }
}
