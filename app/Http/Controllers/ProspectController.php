<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProspectResource;
use App\Models\Prospect;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    
    public function index()
    {
        $prospects = ProspectResource::collection(Prospect::with('user')->latest()->paginate(15));

        return inertia('Prospect/Index', compact('prospects'));
    }

    
    public function create()
    {
        return inertia('Prospect/Create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'prospect_name' => 'required|string',
            'company' => 'required|string',
            'project_type' => 'required|string',
            'notes' => 'required|string',
        ]);

        Prospect::create($request->all() + ['user_id' => auth()->id()]);

        return to_route('prospects.index');
    }

    
    public function show(Prospect $prospect)
    {
        //
    }

    
    public function edit(Prospect $prospect)
    {
        return inertia('Prospect/Edit', compact('prospect'));
    }

    
    public function update(Request $request, Prospect $prospect)
    {
        $request->validate([
            'prospect_name' => 'required|string',
            'company' => 'required|string',
            'project_type' => 'required|string',
            'notes' => 'required|string',
        ]);

        $prospect->update($request->all());

        return to_route('prospects.index');
    }

    
    public function destroy(Prospect $prospect)
    {
        //
    }


    // API
    public function aprovedProspect(Prospect $prospect)
    {
        $prospect->update([
            'is_aproved' => true
        ]);
    }

    public function rejectedProspect(Prospect $prospect)
    {
        $prospect->update([
            'is_aproved' => false
        ]);
        
    }

    public function getContacts(Prospect $prospect)
    {
        $items = $prospect->contacts;

        return response()->json(compact('items'));
    }
}
