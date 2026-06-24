<?php

use App\Http\Controllers\Api\DepartementController;
use App\Http\Controllers\Api\EmployeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes API — RH Manager
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::apiResource('departements', DepartementController::class);
    Route::apiResource('employes', EmployeController::class);
});
