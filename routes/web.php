<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VilleController;

Route::view('/', 'villes');
Route::get('/villes_de_france/ville/{nom?}', [VilleController::class, 'ville']);
Route::get('/villes_de_france/departement/{dep?}', [VilleController::class, 'departement']);
Route::get('/villes_de_france/code/{code?}', [VilleController::class, 'code']);
Route::get('/villes_de_france/search', [VilleController::class, 'autocomplete']); // ✅ auto
