<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    
    public function index()
    {
        $settings = SettingResource::collection(Setting::all());

        return inertia('Setting/Index', compact('settings'));
    }

    
    public function create()
    {
        return inertia('Setting/Create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        Setting::create($request->all());

        return to_route('settings.index');
    }

    
    public function show(Setting $setting)
    {
        //
    }

    
    public function edit(Setting $setting)
    {

        return inertia('Setting/Edit',compact('setting'));
    }

    
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $setting->update($request->all());

        return to_route('settings.index');
    }

    
    public function destroy(Setting $setting)
    {
        //
    }
}
