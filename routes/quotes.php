<?php

use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::resource('quotes', QuoteController::class);
