<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::resource('messages', MessageController::class)->except('show');
Route::post('messages/mark-as-dispatched', [MessageController::class, 'MarkAsdispatched'])->name('messages.mark-as-dispatched');
Route::post('messages/massive-delete', [MessageController::class, 'massiveDelete'])->name('messages.massive-delete');