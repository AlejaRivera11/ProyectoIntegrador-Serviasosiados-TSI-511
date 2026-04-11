<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/cliente',ClienteController::class);

Route::resource('/vehiculo',VehiculoController::class);

