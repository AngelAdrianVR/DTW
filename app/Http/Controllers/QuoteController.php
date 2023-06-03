<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::latest()->paginate(15);
        return inertia('Quote/Index', compact('quotes'));
    }

    public function store(Request $request)
    {   
        // $request->validate([
        //     'name' => 'required|string|max:30',
        //     'email' => 'required|email',
        //     'company' => 'nullable|string',
        //     'phone' => 'nullable|string|min:10|max:10',
        //     'message' => 'required',
        // ]); 

        // Quote::create($request->all());

        return back();

    }
}
