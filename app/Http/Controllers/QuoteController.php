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
        return inertia('Quote/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:191',
            'company' => 'nullable|string|max:191',
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
            'total_cost' => 101.5 * $request->total_hours,
        ]);

        return back();
    }
}
