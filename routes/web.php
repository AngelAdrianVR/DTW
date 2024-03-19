<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// quotes routes
Route::resource('quotes', QuoteController::class)->middleware('auth');

// messages routes
Route::resource('messages', MessageController::class)->middleware('auth')->except('show');
Route::post('messages/mark-as-dispatched', [MessageController::class, 'MarkAsdispatched'])->middleware('auth')->name('messages.mark-as-dispatched');
Route::post('messages/massive-delete', [MessageController::class, 'massiveDelete'])->middleware('auth')->name('messages.massive-delete');

// projects routes
Route::resource('projects', ProjectController::class)->middleware('auth');
Route::post('projects/massive-delete', [ProjectController::class, 'massiveDelete'])->name('projects.massive-delete');
Route::put('projects/{project}/finish', [ProjectController::class, 'finishProject'])->name('projects.finish');

// ** Quote request routes **
Route::resource('quote-request', QuoteRequestController::class)->middleware('auth')->except(['edit', 'update', 'destroy']);
Route::get('create-quote-en', [QuoteRequestController::class, 'createEnglish'])->name('create-quote-en.create');
Route::put('quote-request/change-dispatched-status/{quoteRequest}', [QuoteRequestController::class, 'changeDispatchedStatus'])->middleware('auth')->name('quote-request.change-dispatched-status');

// prospects routes
Route::resource('prospects', ProspectController::class)->middleware('auth');
Route::put('prospects/{prospect}/aproved', [ProspectController::class, 'aprovedProspect'])->name('prospects.aproved')->middleware('auth');
Route::put('prospects/{prospect}/rejected', [ProspectController::class, 'rejectedProspect'])->name('prospects.rejected')->middleware('auth');

// users routes
Route::get('users-get-notifications', [UserController::class, 'getNotifications'])->middleware('auth')->name('users.get-notifications');
Route::post('users-read-notifications', [UserController::class, 'readNotifications'])->middleware('auth')->name('users.read-user-notifications');
Route::post('users-delete-notifications', [UserController::class, 'deleteNotifications'])->middleware('auth')->name('users.delete-user-notifications');

//PDF routes ----------------------------------------------------
Route::get('/generar-pdf/{id}', 'PDFController@generatePDF');



