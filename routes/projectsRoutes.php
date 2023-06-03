<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::resource('projects', ProjectController::class);