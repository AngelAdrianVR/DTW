<?php

namespace App\Http\Controllers;

use App\Models\Foot;
use Illuminate\Http\Request;

class FootController extends Controller
{
    public function index()
    {   
        $kits = Foot::first();

        return inertia('Foot/Index', compact('kits'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Foot $foot)
    {
        //
    }

    public function edit(Foot $foot)
    {
        //
    }

    public function update(Request $request, Foot $foot)
    {
        //
    }

    public function destroy(Foot $foot)
    {
        //
    }
}
