<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteRequestResource;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function index()
    {
        $quote_requests = QuoteRequestResource::collection(QuoteRequest::latest()->get()); 

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
        $quoteRequest = QuoteRequestResource::make($quoteRequest);
        return inertia('QuoteRequest/Show', compact('quoteRequest'));
    }

    public function changeDispatchedStatus(QuoteRequest $quoteRequest)
    {
        $new_status = !$quoteRequest->is_dispatched;
        $quoteRequest->is_dispatched = $new_status;
        $quoteRequest->save();

        return response()->json(['is_dispatched' => $new_status]);
    }

}
