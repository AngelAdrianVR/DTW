<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::latest()->get()->take(15);
        $total_items = Client::all()->count();

        return inertia('Client/Index', compact('clients', 'total_items'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Client $client)
    {
        //
    }

    public function edit(Client $client)
    {
        //
    }

    public function update(Request $request, Client $client)
    {
        //
    }

    public function destroy(Client $client)
    {
        //
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
}
