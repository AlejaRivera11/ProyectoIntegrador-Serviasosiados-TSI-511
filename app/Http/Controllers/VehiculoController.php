<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\VehiculoRequest;
use App\Models\vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::orderBy('id', 'DESC')->paginate(2);

        return view('vehiculo.index', compact('vehiculos'));
    }

   
    public function store(VehiculoRequest $request)
    {
    $datosValidos = $request->validated();

    // Buscar el cliente por documento
    $clientes = Cliente::where('documento', $datosValidos['cliente_id'])->first();

    if (!$clientes) {
        return redirect()->back()->with('error', 'No existe un cliente con ese documento.');
    }

    // Reemplazar el documento por el id real
    $datosValidos['cliente_id'] = $clientes->id;

    Vehiculo::create($datosValidos);

    return redirect()->route('vehiculo.index')
                     ->with('success', 'Vehiculo registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehiculoRequest $request, vehiculo $vehiculo)
    {
        $datosValidos = $request->validated();
        $vehiculo->update($datosValidos);
        return redirect()->route('vehiculo.index')
            ->with('success', 'Vehículo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vehiculo $vehiculo)
    {
        //
    }
}
