<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes Web — RH Manager
|--------------------------------------------------------------------------
*/

// Redirection racine vers le dashboard
Route::redirect('/', '/dashboard');

// Routes d'authentification (invités)
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [AuthController::class, 'showLoginForm'])->name('connexion');
    Route::post('/connexion', [AuthController::class, 'login']);
});

// Déconnexion (authentifié)
Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('deconnexion');

// Routes protégées (authentifié)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('departements', DepartementController::class);
    Route::resource('employes', EmployeController::class);
});
