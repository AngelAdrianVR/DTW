<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SuscriptionProjectController;
use App\Http\Controllers\UserController;
use App\Models\Client;
use App\Models\Project;
use App\Models\Prospect;
use App\Models\User;
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
        //guardar ultimo acceso cada vez que se loguea.
        $authenticated_user = User::find(auth()->id());
        $authenticated_user->last_access = now();
        $authenticated_user->save();

        $total_prospects = Prospect::all()->count();
        $total_clients = Client::all()->count();
        $total_projects = Project::all()->count();

        return inertia('Dashboard', [
            'total_prospects' => $total_prospects,
            'total_clients' => $total_clients,
            'total_projects' => $total_projects
        ]);
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



// quotes routes -------------------------------------------------------------
Route::resource('quotes', QuoteController::class)->middleware('auth');
Route::get('quotes-get-matches/{query}', [QuoteController::class, 'getMatches'])->name('quotes.get-matches');
Route::get('quotes-get-by-page/{currentPage}', [QuoteController::class, 'getItemsByPage'])->name('quotes.get-by-page')->middleware('auth');
Route::put('quotes-mark-as-authorized/{quote}', [QuoteController::class, 'markAsAuthorized'])->name('quotes.mark-as-authorized')->middleware('auth');
Route::put('quotes-mark-as-rejected/{quote}', [QuoteController::class, 'markAsRejected'])->name('quotes.mark-as-rejected')->middleware('auth');
Route::put('quotes-mark-as-sent/{quote}', [QuoteController::class, 'markAsSent'])->name('quotes.mark-as-sent')->middleware('auth');
Route::put('quotes-mark-as-paid/{quote}', [QuoteController::class, 'markAsPaid'])->name('quotes.mark-as-paid')->middleware('auth');
Route::get('quotes-fetch-all-info', [QuoteController::class, 'fetchAllInfo'])->name('quotes.fetch-all-info')->middleware('auth');


// clients routes-------------------------------------------------------------
Route::resource('clients', ClientController::class)->middleware('auth');
Route::get('clients-get-matches/{query}', [ClientController::class, 'getMatches'])->name('clients.get-matches');
Route::get('clients-get-by-page/{currentPage}', [ClientController::class, 'getItemsByPage'])->name('clients.get-by-page')->middleware('auth');
Route::get('clients-get-contacts/{client}', [ClientController::class, 'getContacts'])->name('clients.get-contacts')->middleware('auth');
Route::get('clients-get-quotes/{client}', [ClientController::class, 'getQuotes'])->name('clients.get-quotes')->middleware('auth');
Route::get('clients-get-projects/{client}', [ClientController::class, 'getProjects'])->name('clients.get-projects')->middleware('auth');
Route::get('clients-fetch-quotes/{client}', [ClientController::class, 'fetchQuotes'])->name('clients.fetch-quotes')->middleware('auth');


// ------- CRM (prospectos Routes)  ------------------------------------------
Route::resource('prospects', ProspectController::class)->middleware('auth');
Route::get('prospects-get-matches/{query}', [ProspectController::class, 'getMatches'])->name('prospects.get-matches');
Route::get('prospects-get-quotes/{prospect}', [ProspectController::class, 'getQuotes'])->name('prospects.get-quotes');
Route::post('prospects/turn-into-client/{prospect}', [ProspectController::class, 'turnIntoClient'])->name('prospects.turn-into-client');
Route::get('prospects-get-quotes/{prospect}', [ProspectController::class, 'getQuotes'])->name('prospects.get-quotes')->middleware('auth');
Route::get('prospects-get-contact/{prospect}', [ProspectController::class, 'getContact'])->name('prospects.get-contact')->middleware('auth');


// messages routes ---------------------------------------------------
Route::resource('messages', MessageController::class)->middleware('auth')->except('show');
Route::post('messages/mark-as-dispatched', [MessageController::class, 'MarkAsdispatched'])->middleware('auth')->name('messages.mark-as-dispatched');
Route::post('messages/massive-delete', [MessageController::class, 'massiveDelete'])->middleware('auth')->name('messages.massive-delete');


// projects routes -----------------------------------------------------
Route::resource('projects', ProjectController::class)->middleware('auth');
Route::post('projects/massive-delete', [ProjectController::class, 'massiveDelete'])->name('projects.massive-delete');
Route::put('projects/{project}/finish', [ProjectController::class, 'finishProject'])->name('projects.finish');
Route::post('projects/update-with-media/{project}', [ProjectController::class, 'updateWithMedia'])->name('projects.update-with-media');
Route::get('projects-get-by-page/{currentPage}', [ProjectController::class, 'getItemsByPage'])->name('projects.get-by-page')->middleware('auth');


// suscription projects routes -----------------------------------------------------
Route::resource('suscription-projects', SuscriptionProjectController::class)->middleware('auth');
Route::get('projects-get-by-page/{currentPage}', [SuscriptionProjectController::class, 'getItemsByPage'])->name('suscription-projects.get-by-page')->middleware('auth');
Route::put('projects-update-status/{suscription_project}/{status}', [SuscriptionProjectController::class, 'updateStatus'])->name('suscription-projects.update-status')->middleware('auth');


// projects-tasks routes -------------------------------------------------
Route::resource('project-tasks', ProjectTaskController::class)->middleware('auth');
Route::post('project-tasks-{project_task}-comment', [ProjectTaskController::class, 'comment'])->name('project-tasks.comment')->middleware('auth');
Route::put('project-tasks-{project_task}-pause-play', [ProjectTaskController::class, 'pausePlayTask'])->name('project-tasks.pause-play')->middleware('auth');
Route::put('project-tasks-{project_task}-update-status', [ProjectTaskController::class, 'updateStatus'])->name('project-tasks.update-status')->middleware('auth');
Route::get('project-tasks-late-tasks', [ProjectTaskController::class, 'getLateTasks'])->middleware('auth')->name('project-tasks.get-late-tasks');


// Quote request routes ---------------------------------------------
Route::resource('quote-request', QuoteRequestController::class)->middleware('auth')->except(['edit', 'update', 'destroy']);
Route::get('create-quote-en', [QuoteRequestController::class, 'createEnglish'])->name('create-quote-en.create');
Route::put('quote-request/change-dispatched-status/{quoteRequest}', [QuoteRequestController::class, 'changeDispatchedStatus'])->middleware('auth')->name('quote-request.change-dispatched-status');


// prospects routes -------------------------------------------------------
Route::resource('prospects', ProspectController::class)->middleware('auth');
Route::put('prospects/{prospect}/aproved', [ProspectController::class, 'aprovedProspect'])->name('prospects.aproved')->middleware('auth');
Route::put('prospects/{prospect}/rejected', [ProspectController::class, 'rejectedProspect'])->name('prospects.rejected')->middleware('auth');
Route::get('prospects-get-contacts/{prospect}', [ProspectController::class, 'getContacts'])->name('prospects.get-contacts')->middleware('auth');


// users routes ---------------------------------------------------------------
Route::resource('users', UserController::class)->middleware('auth');
Route::get('users-get-notifications', [UserController::class, 'getNotifications'])->middleware('auth')->name('users.get-notifications');
Route::post('users-read-notifications', [UserController::class, 'readNotifications'])->middleware('auth')->name('users.read-user-notifications');
Route::post('users-delete-notifications', [UserController::class, 'deleteNotifications'])->middleware('auth')->name('users.delete-user-notifications');
Route::get('users-get-by-page/{currentPage}', [UserController::class, 'getItemsByPage'])->name('users.get-by-page')->middleware('auth');


// finances routes ---------------------------------------------------------------
Route::resource('finances', FinanceController::class)->middleware('auth');


// purchases routes ---------------------------------------------------------------
Route::resource('purchases', PurchaseController::class)->middleware('auth');


// Admin view routes ---------------------------------------
Route::resource('settings', SettingController::class)->middleware('auth');


//PDF routes ----------------------------------------------------
Route::get('/generar-pdf/{id}', 'PDFController@generatePDF');
