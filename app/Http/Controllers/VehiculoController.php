<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculoRequest;
use App\Models\Cliente;
use App\Models\vehiculo;

class VehiculoController extends Controller
{


    public function index()
    {
        $vehiculos = vehiculo::orderBy('id', 'DESC')->paginate(2);
        return view('vehiculo.index', compact('vehiculos'));
    }

    public function store(VehiculoRequest $request)
    {
        $datosValidos = $request->validated();
        
        $clientes = Cliente::where('documento', $datosValidos['cliente_id'])->first(); // Buscar el cliente por document
        if (! $clientes) {
            return redirect()->back()->with('error', 'No existe un cliente con ese documento.');
        }
        $datosValidos['cliente_id'] = $clientes->id;   // Reemplazar el documento por el id real
        vehiculo::create($datosValidos);

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
        $cliente = Cliente::where('documento', $datosValidos['cliente_id'])->first();

        if (! $cliente) {
            return redirect()->back()->with('error', 'No existe un cliente con ese documento.');
        }

        $datosValidos['cliente_id'] = $cliente->id;
        $vehiculo->update($datosValidos);

        return redirect()->route('vehiculo.index')
            ->with('success', 'Vehiculo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vehiculo $vehiculo)
    {
        //
    }
}
