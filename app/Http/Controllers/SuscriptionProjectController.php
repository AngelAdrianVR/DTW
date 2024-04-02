<?php

namespace App\Http\Controllers;

use App\Models\SuscriptionProject;
use Illuminate\Http\Request;

class SuscriptionProjectController extends Controller
{
    
    public function index()
    {
        $suscription_projects = SuscriptionProject::all()->take(20);
        $total_projects = SuscriptionProject::all()->count();

        // return $suscription_projects;
        return inertia('SuscriptionProject/Index', compact('suscription_projects', 'total_projects'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(SuscriptionProject $suscriptionProject)
    {
        //
    }

    
    public function edit(SuscriptionProject $suscriptionProject)
    {
        //
    }

   
    public function update(Request $request, SuscriptionProject $suscriptionProject)
    {
        //
    }

    
    public function destroy(SuscriptionProject $suscriptionProject)
    {
        //
    }
}
