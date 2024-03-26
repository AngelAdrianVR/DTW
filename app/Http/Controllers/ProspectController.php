<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProspectResource;
use App\Models\Client;
use App\Models\Prospect;
use App\Models\User;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    public function index()
    {
        $prospects = Prospect::with(['contact'])->latest()->get()->take(15);
        $total_items = Prospect::all()->count();

        return inertia('Prospect/Index', compact('prospects', 'total_items'));
    }

    public function create()
    {
        $sellers = User::get(['id', 'name', 'profile_photo_path']);

        return inertia('Prospect/Create', compact('sellers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'abstract' => 'nullable|string|max:800',
            'responsible_id' => 'required|numeric|min:1',
            'contact.name' => 'required|string|max:255',
            'contact.phone' => 'required|string|max:13',
            'contact.email' => 'nullable|string|max:255',
        ]);

        $prospect = Prospect::create($validated + ['user_id' => auth()->id()]);

        // crear contacto
        $prospect->contact()->create([
            'name' => $validated['contact']['name'],
            'phone' => $validated['contact']['phone'],
            'email' => $validated['contact']['email'],
        ]);

        return to_route('prospects.show', $prospect);
    }

    public function show(Prospect $prospect)
    {
        $prospect = $prospect->load(['responsible', 'user', 'contact']);
        $prospects = Prospect::latest()->get(['id', 'name']);

        $defaultTab = request('defaultTab');

        return inertia('Prospect/Show', compact('prospect', 'prospects', 'defaultTab'));
    }

    public function edit(Prospect $prospect)
    {
        $prospect = $prospect->load(['responsible', 'contact']);
        $sellers = User::get(['id', 'name', 'profile_photo_path']);

        return inertia('Prospect/Edit', compact('prospect', 'sellers'));
    }

    public function update(Request $request, Prospect $prospect)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'abstract' => 'nullable|string|max:800',
            'responsible_id' => 'required|numeric|min:1',
            'contact.name' => 'required|string|max:255',
            'contact.phone' => 'required|string|max:13',
            'contact.email' => 'nullable|string|max:255',
        ]);

        $prospect->update($validated);

        // editar el primer contacto registrado
        $prospect->contact->update([
            'name' => $validated['contact']['name'],
            'phone' => $validated['contact']['phone'],
            'email' => $validated['contact']['email'],
        ]);

        return to_route('prospects.show', $prospect);
    }

    public function destroy(Prospect $prospect)
    {
        // Eliminar cotizaciones relacionadas
        $prospect->quotes()->delete();

        // eliminar prospecto
        $prospect->delete();

        return response()->json([]);
    }

    // APIs
    public function getItemsByPage($currentPage)
    {
        $offset = $currentPage * 15;
        $prospects = Prospect::latest('id')
            ->with([])
            ->skip($offset)
            ->take(15)
            ->get();

        return response()->json(['items' => $prospects]);
    }

    public function getMatches($query)
    {
        $prospects = Prospect::where('name', 'LIKE', "%$query%")
            ->orWhere('contact_name', 'LIKE', "%$query%")
            ->orWhere('contact_phone', 'LIKE', "%$query%")
            ->orWhere('contact_email', 'LIKE', "%$query%")
            ->orWhere('status', 'LIKE', "%$query%")
            ->orWhereHas('responsible', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->latest()
            ->get();

        return response()->json(['items' => $prospects]);
    }

    public function getQuotes(Prospect $prospect)
    {
        $items = $prospect->quotes()->with(['user:id,name', 'contact:id,name'])->get();

        return response()->json(compact('items'));
    }

    public function getContact(Prospect $prospect)
    {
        $item = $prospect->contact;

        return response()->json(compact('item'));
    }

    public function turnIntoClient(Prospect $prospect)
    {
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

        return to_route('clients.show', $client->id);
    }
}
