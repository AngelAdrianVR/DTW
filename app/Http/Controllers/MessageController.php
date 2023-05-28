<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class MessageController extends Controller
{
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email',
            'company' => 'nullable|string',
            'phone' => 'nullable|string|min:10|max:10',
            'message' => 'required',
        ]); 

        Message::create($request->all());

        request()->session()->flash('flash.banner', '¡Se ha enviado tu mensaje!');
        request()->session()->flash('flash.bannerStyle', 'success');

        return Redirect::back();

    }
}
