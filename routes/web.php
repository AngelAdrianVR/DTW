<?php


use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SettingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Spanish/Landing', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('dtw');

Route::get('/En', function () {
    return Inertia::render('English/LandingEn', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('dtw-en');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return inertia('Dashboard');
    })->name('dashboard');
});

// Customer view routes

// ** Quote request routes **
Route::resource('quote-request', QuoteRequestController::class)->except(['edit', 'update', 'destroy']);
Route::get('create-quote-en', [QuoteRequestController::class, 'createEnglish'])->name('create-quote-en.create');
Route::put('quote-request/change-dispatched-status/{quoteRequest}', [QuoteRequestController::class, 'changeDispatchedStatus'])->middleware('auth')->name('quote-request.change-dispatched-status');

// ----- Spanish ------
Route::get('us', function () {
    return inertia('Spanish/Us');
})->name('us');

Route::get('packages', function () {
    return inertia('Spanish/Package');
})->name('packages');


// ----- English -----
Route::get('us-En', function () {
    return inertia('English/UsEn');
})->name('us-en');

Route::get('packages-En', function () {
    return inertia('English/PackageEn');
})->name('packages-en');


// Admin view routes ---------------------------------------
Route::resource('settings', SettingController::class)->middleware('auth');


Route::resource('resources', ResourceController::class)->middleware('auth');


Route::resource('prospects', ProspectController::class)->middleware('auth');
Route::put('prospects/{prospect}/aproved', [ProspectController::class, 'aprovedProspect'])->name('prospects.aproved')->middleware('auth');
Route::put('prospects/{prospect}/rejected', [ProspectController::class, 'rejectedProspect'])->name('prospects.rejected')->middleware('auth');



//PDF routes ----------------------------------------------------
Route::get('/generar-pdf/{id}', 'PDFController@generatePDF');



