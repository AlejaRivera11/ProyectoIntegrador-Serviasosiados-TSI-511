<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('inicio', function () {
    return view('inicio');
})->name('inicio');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Usuarios
    Route::get('usuario', [UsuarioController::class, 'index'])
        ->name('usuario.index')
        ->middleware('can:usuario.index');
    Route::post('usuario', [UsuarioController::class, 'store'])
        ->name('usuario.store')
        ->middleware('can:usuario.store');
    Route::put('usuario/{usuario}', [UsuarioController::class, 'update'])
        ->name('usuario.update')
        ->middleware('can:usuario.update');

    // Clientes
    Route::get('cliente', [ClienteController::class, 'index'])
        ->name('cliente.index')
        ->middleware('can:cliente.index');
    Route::post('cliente', [ClienteController::class, 'store'])
        ->name('cliente.store')
        ->middleware('can:cliente.store');
    Route::put('cliente/{cliente}', [ClienteController::class, 'update'])
        ->name('cliente.update')
        ->middleware('can:cliente.update');

    //  Vehiculos
    Route::get('vehiculo', [VehiculoController::class, 'index'])
        ->name('vehiculo.index')
        ->middleware('can:vehiculo.index');
    Route::post('vehiculo', [VehiculoController::class, 'store'])
        ->name('vehiculo.store')
        ->middleware('can:vehiculo.store');
    Route::put('vehiculo/{vehiculo}', [VehiculoController::class, 'update'])
        ->name('vehiculo.update')
        ->middleware('can:vehiculo.update');

    // Mecanicos
    Route::get('mecanico', [MecanicoController::class, 'index'])
        ->name('mecanico.index')
        ->middleware('can:mecanico.index');
    Route::post('mecanico', [MecanicoController::class, 'store'])
        ->name('mecanico.store')
        ->middleware('can:mecanico.store');
    Route::put('mecanico/{mecanico}', [MecanicoController::class, 'update'])
        ->name('mecanico.update')
        ->middleware('can:mecanico.update');

    // PDF
    Route::get('/pdf/clientes', [PdfController::class, 'pdfClientes'])->name('pdf.clientes');
    Route::get('/pdf/vehiculos', [PdfController::class, 'pdfVehiculo'])->name('pdf.vehiculos');

});

require __DIR__.'/auth.php';
