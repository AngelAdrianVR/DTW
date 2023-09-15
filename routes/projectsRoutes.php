<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::resource('projects', ProjectController::class);
Route::post('projects/massive-delete', [ProjectController::class, 'massiveDelete'])->name('projects.massive-delete');
Route::put('projects/{project}/finish', [ProjectController::class, 'finishProject'])->name('projects.finish');