<?php

namespace App\Http\Controllers;

use App\Models\Foot;
use Illuminate\Http\Request;

class FootController extends Controller
{
    public function index()
    {   
        $kits = Foot::first();
        
        return inertia('Foot/Index', compact('kits'));
    }

    public function publicIndex()
    {   
        $kits = Foot::first();

        return inertia('Foot/PublicIndex', compact('kits'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Foot $foot)
    {
        //
    }

    public function edit(Foot $foot)
    {
        //
    }

    public function update(Request $request, Foot $foot)
    {
        //
    }

    public function destroy(Foot $foot)
    {
        //
    }

    public function storeMovement(Request $request)
    {
        $request->validate([
            'kitType' => 'required|string',
            'product' => $request->movementType !== 'Registrar producción' ? 'required|string' : 'nullable|string',
            'quantity' => $request->movementType !== 'Registrar producción' ? 'required|string' : 'nullable|string',
            'bagsQuantity' => $request->movementType === 'Registrar producción' ? 'required|numeric|min:0' : 'nullable|numeric|min:0',
            'movementType' => 'required|string|in:Entrada de producto,Salida de producto,Registrar producción',
        ]);

        $kitType = $request->kitType;
        $foot = Foot::first(); //el registro donde se encuentra el json con todos los kits
        $data = $foot->kits;

        if ($request->movementType === 'Registrar producción') {
            $totalKitsProduction = $request->bagsQuantity * 50; // cálculo de kits totales
            
            //rebajar la cantidad a cada producto del kit
            foreach ($data[$kitType]['products'] as &$product) {
                //si el producto es la bolsa de empaque se descuenta la cantidad de bolsas grandes utilizadas
                if ($product['name'] === 'Bolsa grande empaque azúl' || $product['name'] === 'Bolsa grande empaque transparente') {
                    if ($product['quantity'] < $request->bagsQuantity) {
                        return response()->json(['error' => "Cantidad insuficiente en {$product['name']}"], 400);
                    }
                    $product['quantity'] -= $request->bagsQuantity;
                    continue;
                }
                // descuento de cantidad total de kits a cada producto
                if ($product['quantity'] < $totalKitsProduction) {
                    return response()->json(['error' => "Cantidad insuficiente en {$product['name']}"], 400);
                }
                $product['quantity'] -= $totalKitsProduction;
            }
            
            //actualiza la cantidad de producción actual
            $data[$kitType]['current_production'] += $totalKitsProduction;
        } elseif ($request->movementType === 'Entrada de producto' || $request->movementType === 'Salida de producto') {
            $productIndex = collect($data[$kitType]['products'])->search(fn($prod) => $prod['name'] === $request->product);

            if ($productIndex === false) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            $product = &$data[$kitType]['products'][$productIndex];

            if ($request->movementType === 'Entrada de producto') {
                $product['quantity'] += $request->quantity;
            } elseif ($request->movementType === 'Salida de producto') {
                if ($product['quantity'] < $request->quantity) {
                    return response()->json(['error' => 'Cantidad insuficiente para realizar la salida'], 400);
                }
                $product['quantity'] -= $request->quantity;
            }
        }

        $foot->kits = $data;
        $foot->save();
    }

    public function storeNewProduction(Request $request)
    {
        $request->validate([
            'kitType' => 'required|string',
            'goal' => 'required|numeric|min:1',
            'current_production' => 'required|numeric|min:0',
        ]);

        $kitType = $request->kitType; //tipo de kit
        $foot = Foot::first();
        $data = $foot->kits;

        $data[$kitType]['goal'] = intval($request->goal);
        $data[$kitType]['current_production'] = intval($request->current_production);

        $foot->kits = $data;
        $foot->save();
    }

}
