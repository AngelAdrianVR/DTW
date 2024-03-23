<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Client;
use App\Models\Prospect;
use App\Models\Quote;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = QuoteResource::collection(Quote::latest()->paginate(15));
        return inertia('Quote/Index', compact('quotes'));
    }

    public function create()
    {
        $quotes = Quote::all();
        $clients = Client::get(['id', 'name']);
        $prospects = [];
        // $prospects = Prospect::get(['id', 'name']);

        return inertia('Quote/Create', compact('quotes', 'clients', 'prospects'));
    }

    public function edit(Quote $quote)
    {
        return inertia('Quote/Edit', compact('quote'));
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

        return to_route('quotes.index');
    }

    public function update(Quote $quote, Request $request)
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

        $quote->update($request->all());

        return to_route('quotes.index');
    }

    public function show(Quote $quote)
    {
        return inertia('Quote/Show', compact('quote'));
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();

        return response()->json([]);
    }

    // APIs
    public function getItemsByPage($currentPage)
    {
        $offset = $currentPage * 15;
        $quotes = Quote::latest('id')
            ->with([])
            ->skip($offset)
            ->take(15)
            ->get();

        return response()->json(['items' => $quotes]);
    }

    public function getMatches($query)
    {
        $quotes = Quote::with([])
            ->where('id', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->orWhereHas('user', function ($query) {
                $query->orWhere('user.name', 'LIKE', "%$query%");
            })
            ->orWhereHas('client', function ($query) {
                $query->orWhere('client.name', 'LIKE', "%$query%");
            })
            // ->orWhereHas('prospect', function ($query) {
            //     $query->orWhere('prospect.name', 'LIKE', "%$query%");
            // })
            ->get();

        return response()->json(['items' => $quotes]);
    }
}
