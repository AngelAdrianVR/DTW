<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::with(['contacts'])->latest()->get()->take(15);
        $total_items = Client::all()->count();

        return inertia('Client/Index', compact('clients', 'total_items'));
    }

    public function create()
    {
        $users = User::where('is_active', true)->get(['id', 'name', 'profile_photo_path']);

        return inertia('Client/Create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rfc' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'responsible_id' => 'required|numeric|min:1',
            'contacts.0.name' => 'required|string|max:255',
            'contacts.0.phone' => 'required|string|max:13',
            'contacts.0.email' => 'nullable|string|max:255',
            'contacts' => 'array|min:1',
        ]);

        $client = Client::create($validated + ['user_id' => auth()->id()]);

        $client->contacts()->create([
            'name' => $validated['contacts'][0]['name'],
            'phone' => $validated['contacts'][0]['phone'],
            'email' => $validated['contacts'][0]['email'],
        ]);

        return to_route('clients.show', $client);
    }

    public function show(Client $client)
    {
        $client = $client->load(['user', 'responsible', 'contacts']);
        $clients = Client::get(['id','name']);
        
        return inertia('Client/Show', compact('client', 'clients'));
    }

    public function edit(Client $client)
    {
        $client = $client->load(['contacts']);
        $users = User::where('is_active', true)->get(['id', 'name', 'profile_photo_path']);

        return inertia('Client/Edit', compact('client', 'users'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rfc' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'responsible_id' => 'required|numeric|min:1',
            'contacts.0.name' => 'required|string|max:255',
            'contacts.0.phone' => 'required|string|max:13',
            'contacts.0.email' => 'nullable|string|max:255',
            'contacts' => 'array|min:1',
        ]);

        $client->update($validated);

        // editar el primer contacto registrado
        $client->contacts[0]->update([
            'name' => $validated['contacts'][0]['name'],
            'phone' => $validated['contacts'][0]['phone'],
            'email' => $validated['contacts'][0]['email'],
        ]);

        return to_route('clients.show', $client);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([]);
    }

    // APIs
    public function getItemsByPage($currentPage)
    {
        $offset = $currentPage * 15;
        $clients = Client::latest('id')
            ->with([])
            ->skip($offset)
            ->take(15)
            ->get();

        return response()->json(['items' => $clients]);
    }

    public function getMatches($query)
    {
        $clients = Client::with([])
            ->where('id', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->orWhere('rfc', 'LIKE', "%$query%")
            ->get();

        return response()->json(['items' => $clients]);
    }

    public function getContacts(Client $client)
    {
        $items = $client->contacts;

        return response()->json(compact('items'));
    }

    public function getQuotes(Client $client)
    {
        $items = $client->quotes()->with(['user:id,name', 'contact:id,name'])->get();

        return response()->json(compact('items'));
    }
    
    public function getProjects(Client $client)
    {
        $items = $client->projects()->with(['tasks'])->get();

        return response()->json(compact('items'));
    }

    public function fetchQuotes($client)
    {
        $quotes = Quote::where('client_id', $client)->get();

        return response()->json(compact('quotes'));
    }
}
