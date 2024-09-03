<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Prospect;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::with(['user', 'client', 'contact', 'prospect'])->latest()->get()->take(30);
        $total_items = Quote::all()->count();

        return inertia('Quote/Index', compact('quotes', 'total_items'));
    }

    public function create()
    {
        $clients = Client::get(['id', 'name', 'address']);
        $prospects = Prospect::get(['id', 'name', 'address']);

        return inertia('Quote/Create', compact('clients', 'prospects'));
    }

    public function edit(Quote $quote)
    {
        $clients = Client::get(['id', 'name', 'address']);
        $prospects = Prospect::get(['id', 'name', 'address']);

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
        $offset = $currentPage * 30;
        $quotes = Quote::latest()
            ->with(['user', 'client', 'contact', 'prospect'])
            ->skip($offset)
            ->take(30)
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

    public function markAsAuthorized(Request $request, Quote $quote)
    {
        $now = now()->toDateTimeString();
        // si se autoriza sin haber mandado al cliente, se marca tambien como enviado
        if ($quote->sent_at === null) {
            $quote->sent_at = $now;
        }
        $quote->authorized_at = $now;
        $quote->rejected_at = null;
        $quote->save();

        //si se indica que se cree el proyecto desde la vista
        if ( $request->create_project ) {
            //si la cotizacion es para un prospecto se convierte a cliente
            if ( $quote->prospect_id ) {

                //recuperar al prospecto
                $prospect = Prospect::find($quote->prospect_id);
                
                // crear nuevo cliente
                $client_data = [
                    'name' => $prospect->name,
                    'rfc' => 'RFC No especificado de prospecto ' . $prospect->id,
                    'address' => $prospect->address ?? 'No especificado',
                    'state' => $prospect->state,
                    'responsible_id' => $prospect->responsible_id ?? auth()->id(),
                ];

                $client = Client::create($client_data + ['user_id' => auth()->id()]);
                
                // cambiar contacto a modelo de cliente
                $prospect->contact->update([
                    'contactable_type' => Client::class,
                    'contactable_id' => $client->id,
                ]);
                
                // pasar sus contizaciones a "cliente"
                $prospect->quotes->each(function ($quote) use ($client) {
                    $quote->update(['client_id' => $client->id, 'prospect_id' => null]);
                });

                // eliminar prospecto
                $prospect->delete();
            }

            //Se crea un proyecto para esa cotización
            Project::create([
                'name' => $quote->name,
                'internal_project' => $quote->client_id ?? $quote->prospect_id ?? 1,
                'payment_method' => $quote->payment_type,
                'category' => 'Sin especificar. Creado automáticamente',
                'description' => $quote->description,
                'hours_work' => $quote->total_work_days * 3 * 6,
                'total_work_days' => $quote->total_work_days,
                'start_date' => now(),
                'estimated_date' => now()->addDays($quote->total_work_days + (int)($quote->total_work_days / 5) * 2), //sumar días habiles a fecha de inicio
                'state' => 'En revisión',
                'price' => $quote->total_cost,
                'user_id' => auth()->id(),
                'responsible_id' =>auth()->id(),
                'client_id' => $quote->client_id ?? $client->id, //si la cotización fue hecha para un cliente, si no, se convierte a cliente el prospecto 
                'quote_id' => $quote->id,
            ]);
        }
        
        return response()->json(['prop' => $now]);
    }
    
    public function markAsRejected(Quote $quote)
    {
        $now = now()->toDateTimeString();
        // si se rechaza sin haber mandado al cliente, se marca tambien como enviado
        if ($quote->sent_at === null) {
            $quote->sent_at = $now;
        }
        $quote->authorized_at = null;
        $quote->rejected_at = $now;
        $quote->save();
        
        //recupera el proyecto que posiblemente se haya creado
        $project = Project::where('quote_id', $quote->id)->first();

        //si se encuetra el proyecto se elimina
        if ( $project ) {
            $project->delete();
        }

        return response()->json(['prop' => $now]);
    }

    public function markAsSent(Quote $quote)
    {
        $now = now()->toDateTimeString();
        $quote->sent_at = $now;
        $quote->save();

        return response()->json(['prop' => $now]);
    }

    public function markAsPaid(Quote $quote)
    {
        $now = now()->toDateTimeString();
        $quote->paid_at = $now;
        $quote->save();

        return response()->json(['prop' => $now]);
    }

    public function fetchAllInfo()
    {
        $quotes = Quote::all(['id', 'authorized_at', 'rejected_at', 'sent_at', 'paid_at', 'total_cost']);

        return response()->json(compact('quotes'));
    }
}
