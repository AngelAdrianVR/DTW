<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function index()
    {
        $quote_requests = QuoteRequest::latest()->get();

        return inertia('QuoteRequest/Index', compact('quote_requests'));
    }

    public function createEnglish()
    {
        return inertia('QuoteRequest/CreateEn');
    }

    public function create()
    {
        return inertia('QuoteRequest/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:10',
            'related_sites' => 'nullable|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'business_type' => 'nullable|string|max:255',
            'project_type' => 'required|string|max:255',
            'estimate' => 'required|string|max:255',
            'project_description' => 'nullable|string|max:600',
            'way_of_knowing' => 'required|string|max:255',
        ]);

        QuoteRequest::create($request->all());

        return back();
    }

    public function show(QuoteRequest $quoteRequest)
    {
        return inertia('QuoteRequest/Show', compact('quoteRequest'));
    }

    public function edit(QuoteRequest $quoteRequest)
    {
        //
    }

    public function update(Request $request, QuoteRequest $quoteRequest)
    {
        //
    }

    public function destroy(QuoteRequest $quoteRequest)
    {
        //
    }
}