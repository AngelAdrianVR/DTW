<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index()
    {
        return inertia('Component/Index', [
            'components' => Component::latest()->paginate(20)
        ]);
        
    }

    public function create()
    {
        return inertia('Component/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'category' => 'nullable|string',
            'bg_color' => 'nullable|string',
            'views' => 'nullable|numeric',
            'author' => 'nullable|string',
            'html_code' => 'required',
            'css_code' => 'nullable',
            'js_code' => 'nullable',
        ]);

        Component::create($request->all());

        return to_route('components.index');
    }

    public function show(Component $component)
    {
        //incrementar en uno las vistas
        $component->increment('views');

        return inertia('Component/Show', [
            'component' => $component
        ]);
    }

    public function edit(Component $component)
    {
        return inertia('Component/Edit', compact('component'));
    }

    public function update(Request $request, Component $component)
    {
        $request->validate([
            'name' => 'nullable|string',
            'category' => 'nullable|string',
            'bg_color' => 'nullable|string',
            'views' => 'nullable|numeric',
            'author' => 'nullable|string',
            'html_code' => 'required',
            'css_code' => 'nullable',
            'js_code' => 'nullable',
        ]);

        $component->update($request->all());

        return to_route('components.index');
    }

    public function destroy(Component $component)
    {
        $component->delete();
    }

    public function filterData(Request $request)
    {
        $components = Component::query();
        
        if ($request->has('category')) {
            $components->where('category', $request->category);
        }
        
        return response()->json($components->latest()->get());
    }
}
