<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/cliente', ClienteController::class);

Route::resource('/vehiculo', VehiculoController::class);

Route::get('/pdf/clientes', [PdfController::class, 'pdfClientes'])->name('pdf.clientes');
