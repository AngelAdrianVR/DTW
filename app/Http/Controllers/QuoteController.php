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

    public function create()
    {
        $quotes = Quote::all();

        return inertia('Quote/Create', compact('quotes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:191',
            'company' => 'nullable|string|max:191',
            'company_address' => 'nullable|string',
            'project' => 'nullable|string',
            'total_work_days' => 'required|numeric|min:1',
            'total_cost' => 'required|numeric|min:1',
            'percentage_discount' => 'nullable|numeric|',
            'email' => 'nullable',
            'included_features' => 'nullable',
            'suggested_features' => 'nullable',
            'discounts' => 'nullable',
            'advance_payment_percentage' => 'required|numeric',
            'total_hours' => 'required|numeric',
            'promised_end_date' => 'date',
            'offer_validity_days' => 'required|numeric',
        ]);

        Quote::create($request->all() + [
            'user_id' => auth()->id(), 
        ]);

        return back();
    }
}
