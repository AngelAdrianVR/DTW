<?php

namespace App\Http\Controllers;

use App\Models\DeliveredProduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveredProductionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'deliveryKits' => 'nullable|array|min:1',
            'delivered_at' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->deliveryKits as $kit) {
                DeliveredProduction::create([
                    'kit_type' => $kit['kitType'],
                    'amount' => $kit['amount'],
                    'price' => $kit['price'],
                    'created_at' => $request->delivered_at,
                    'notes' => $request->notes,
                ]);
            }
        });
    }

    public function show(DeliveredProduction $deliveredProduction)
    {
        //
    }

    public function edit(DeliveredProduction $deliveredProduction)
    {
        //
    }

    public function update(Request $request, DeliveredProduction $deliveredProduction)
    {
        //
    }

    public function destroy(DeliveredProduction $deliveredProduction)
    {
        //
    }

    public function fetchDeliveryHistory()
    {
        // Obtener todas las entregas ordenadas por fecha
        $deliveries = DeliveredProduction::select('kit_type', 'amount', 'price', 'created_at')
        ->orderBy('created_at', 'desc')
        ->get();

        // Agrupar entregas por fecha
        $groupedDeliveries = $deliveries->groupBy(fn($item) => $item->created_at->toDateString());

        // Calcular el total entregado por cada tipo de kit
        $totalByKit = $deliveries->groupBy('kit_type')->map(function ($kits) {
            return [
                'total_amount' => $kits->sum('amount'),
                'total_price' => $kits->sum(fn($kit) => $kit->amount * $kit->price), // Total en dinero
            ];
        });

        return response()->json([
            'deliveries_by_date' => $groupedDeliveries,
            'total_by_kit' => $totalByKit,
        ]);
    }
}
