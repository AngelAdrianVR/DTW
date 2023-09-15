<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($id)
{
    $quote = Quote::findOrFail($id); // Recupera la cotización desde la base de datos

    $pdf = PDF::loadView('pdf.quote', compact('quote'));

    return $pdf->stream('quote.pdf'); // Cambia el nombre del archivo PDF según tus preferencias
}
}
