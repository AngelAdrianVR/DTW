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
        $quotes = Quote::with(['user', 'client', 'contact'])->latest()->get()->take(15);
        $total_items = Quote::all()->count();

        return inertia('Quote/Index', compact('quotes', 'total_items'));
    }

    public function create()
    {
        $clients = Client::get(['id', 'name', 'address']);
        $prospects = [];
        // $prospects = Prospect::get(['id', 'name']);

        return inertia('Quote/Create', compact('clients', 'prospects'));
    }

    public function edit(Quote $quote)
    {
        $clients = Client::get(['id', 'name', 'address']);
        $prospects = [];
        // $prospects = Prospect::get(['id', 'name']);

        return inertia('Quote/Edit', compact('quote', 'clients', 'prospects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'features' => 'required|string',
            'total_work_days' => 'required|numeric|min:0',
            'percentage_discount' => 'nullable|numeric|min:0',
            'payment_type' => 'required|string|max:255',
            'total_cost' => 'required|numeric|min:0',
            'offer_validity_days' => 'nullable|numeric|min:0',
            'show_process' => 'boolean',
            'show_benefits' => 'boolean',
            'show_bank_info' => 'boolean',
            'client_id' => 'nullable|numeric|min:1',
            'contact_id' => 'required|numeric|min:1',
            'prospect_id' => 'nullable|numeric|min:1',
        ]);

        Quote::create($validated + ['user_id' => auth()->id()]);

        return to_route('quotes.index');
    }

    public function update(Quote $quote, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'features' => 'required|string',
            'total_work_days' => 'nullable|numeric|min:0',
            'percentage_discount' => 'nullable|numeric|min:0',
            'payment_type' => 'nullable|string|max:255',
            'total_cost' => 'nullable|numeric|min:0',
            'offer_validity_days' => 'nullable|numeric|min:0',
            'show_process' => 'boolean',
            'show_benefits' => 'boolean',
            'show_bank_info' => 'boolean',
            'client_id' => 'nullable|numeric|min:1',
            'contact_id' => 'required|numeric|min:1',
            'prospect_id' => 'nullable|numeric|min:1',
        ]);

        $quote->update($validated);

        return to_route('quotes.index');
    }

    public function show(Quote $quote)
    {
        $quote = $quote->load(['client', 'prospect', 'contact']);
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
        $quotes = Quote::with(['user', 'client', 'contact'])
            ->where('id', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->orWhereHas('client', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            // ->orWhereHas('prospect', function ($query) {
            //     $query->orWhere('prospect.name', 'LIKE', "%$query%");
            // })
            ->get();

        return response()->json(['items' => $quotes]);
    }

    public function markAsAuthorized(Quote $quote)
    {
        $now = now()->toDateTimeString();
        // si se autoriza sin haber mandado al cliente, se marca tambien como enviado
        if ($quote->sent_at === null) {
            $quote->sent_at = $now;
        }
        $quote->authorized_at = $now;
        $quote->save();

        return response()->json(['prop' => $now]);
    }

    public function markAsSent(Quote $quote)
    {
        $now = now()->toDateTimeString();
        $quote->sent_at = $now;
        $quote->save();

        return response()->json(['prop' => $now]);
    }
}
