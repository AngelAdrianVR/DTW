<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index()
    {
        return inertia('Component/Index', [
            'components' => Component::all()
        ]);
    }

    public function create()
    {
        return inertia('Component/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'html_code' => 'required',
            'css_code' => 'nullable',
            'js_code' => 'nullable',
        ]);

        Component::create($request->all());

        // return redirect()->back()->with('success', 'Componente guardado con éxito');
    }

    public function show(Component $component)
    {
        return inertia('Component/Show', [
            'components' => Component::all()
        ]);
    }

    public function edit(Component $component)
    {
        //
    }

    public function update(Request $request, Component $component)
    {
        //
    }

    public function destroy(Component $component)
    {
        //
    }
}
