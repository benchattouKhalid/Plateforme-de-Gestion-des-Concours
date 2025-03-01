<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConcoursController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\GestionnaireGlobalController;
use App\Http\Controllers\GestionnaireLocalController;
use App\Http\Controllers\Admin\StatistiqueController;
use App\Http\Controllers\CondidatController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ConcoursController::class, 'index'])->name('concours.index');
Route::get('/concours/{id}/apply', [ConcoursController::class, 'showApplicationForm'])->name('concours.apply');
Route::post('/concours/{id}/apply', [ConcoursController::class, 'submitApplication'])->name('concours.submit');
Route::get('/get-villes/{region}', [RegionController::class, 'getVilles'])->name('get.villes');




Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/concours/create', [AdminController::class, 'createConcours'])->name('admin.concours.create');
    Route::post('/admin/concours/store', [AdminController::class, 'storeConcours'])->name('admin.concours.store');

    Route::get('/admin/candidats', [AdminController::class, 'index_condidat'])->name('admin.candidats.index');
    Route::post('/admin/candidats/{id}/confirm', [AdminController::class, 'confirm'])->name('admin.candidats.confirm');
    Route::post('/admin/candidats/{id}/reject', [AdminController::class, 'reject'])->name('admin.candidats.reject');
    Route::get('/admin/candidats/{id}', [AdminController::class, 'show'])->name('admin.candidats.show');


    Route::get('/admin/concours/pending', [AdminController::class, 'showPendingConcours'])->name('admin.concours.pending');
    Route::get('/admin/concours/{id}/confirm', [AdminController::class, 'confirmConcours'])->name('admin.concours.confirm');
    Route::get('/admin/concours/{id}/reject', [AdminController::class, 'rejectConcours'])->name('admin.concours.reject');
    Route::get('/admin/concours/{id}/edit', [AdminController::class, 'editConcours'])->name('admin.concours.edit');
    Route::put('/admin/concours/{id}', [AdminController::class, 'updateConcours'])->name('admin.concours.update');

    Route::get('/admin/statistique', [StatistiqueController::class, 'index'])->name('admin.statistique');
    Route::post('/admin/statistique', [StatistiqueController::class, 'filterByRegion'])->name('admin.statistique.filter');
    Route::get('/admin/statistique/concours', [AdminController::class, 'concoursStatistique'])->name('admin.statistique.concours');
    Route::get('/admin/statistique/concours-by-date', [AdminController::class, 'filterByDate'])->name('admin.concours.by.date');
    Route::get('/admin/statistique/concours-regions', [AdminController::class, 'filterByRegionAndConcours'])->name('admin.statistique.region.concours');



    Route::get('/users/create', [UserController::class, 'create'])->name('create'); // Show create user form
    Route::post('/users', [UserController::class, 'store'])->name('store'); // Store new user
    Route::get('/users', [UserController::class, 'index'])->name('index'); // List all users
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('edit'); // Edit user
    Route::put('/users/{id}', [UserController::class, 'update'])->name('update'); // Update user
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('destroy'); // Delete user

});

// ------------------------------permission-----------------------------------------------


Route::middleware(['permission:manage_concours'])->group(function () {
Route::get('/admin/concours/create', [AdminController::class, 'createConcours'])->name('admin.concours.create');
Route::post('/admin/concours/store', [AdminController::class, 'storeConcours'])->name('admin.concours.store');


Route::get('/admin/concours/pending', [AdminController::class, 'showPendingConcours'])->name('admin.concours.pending');
Route::get('/admin/concours/{id}/confirm', [AdminController::class, 'confirmConcours'])->name('admin.concours.confirm');
Route::get('/admin/concours/{id}/reject', [AdminController::class, 'rejectConcours'])->name('admin.concours.reject');
Route::get('/admin/concours/{id}/edit', [AdminController::class, 'editConcours'])->name('admin.concours.edit');
Route::put('/admin/concours/{id}', [AdminController::class, 'updateConcours'])->name('admin.concours.update');


});

Route::middleware(['permission:manage_candidats'])->group(function () {

    Route::get('/admin/candidats', [AdminController::class, 'index_condidat'])->name('admin.candidats.index');
    Route::post('/admin/candidats/{id}/confirm', [AdminController::class, 'confirm'])->name('admin.candidats.confirm');
    Route::post('/admin/candidats/{id}/reject', [AdminController::class, 'reject'])->name('admin.candidats.reject');
    Route::get('/admin/candidats/{id}', [AdminController::class, 'show'])->name('admin.candidats.show');

});


Route::middleware(['permission:view_statistiques'])->group(function () {

    Route::get('/admin/statistique', [StatistiqueController::class, 'index'])->name('admin.statistique');
    Route::post('/admin/statistique', [StatistiqueController::class, 'filterByRegion'])->name('admin.statistique.filter');
    Route::get('/admin/statistique/concours', [AdminController::class, 'concoursStatistique'])->name('admin.statistique.concours');
    Route::get('/admin/statistique/concours-by-date', [AdminController::class, 'filterByDate'])->name('admin.concours.by.date');
    Route::get('/admin/statistique/concours-regions', [AdminController::class, 'filterByRegionAndConcours'])->name('admin.statistique.region.concours');


});


Route::middleware('auth')->group(function () {
    Route::get('/gestionnaire-global/dashboard', [GestionnaireGlobalController::class, 'index'])
        ->name('gestionnaire-global.dashboard');
    Route::get('/gestionnaire-local/dashboard', [GestionnaireLocalController::class, 'index'])
        ->name('gestionnaire-local.dashboard');
});





Route::middleware('auth:candidat')->group(function () {
    Route::get('/condidat/dashboard', [CondidatController::class, 'dashboard'])->name('condidat.dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');
