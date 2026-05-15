<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculoRequest;
use App\Models\Cliente;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::orderBy('id', 'DESC')->paginate(2);

        return view('vehiculo.index', compact('vehiculos'));
    }

    public function store(VehiculoRequest $request)
    {
        $datosValidos = $request->validated();

        $clientes = Cliente::where('documento', $datosValidos['cliente_id'])->first(); 
        if (! $clientes) {
            return redirect()->back()->with('error', 'No existe un cliente con ese documento.');
        }
        $datosValidos['cliente_id'] = $clientes->id;   
        Vehiculo::create($datosValidos);

        return redirect()->route('vehiculo.index')
            ->with('success', 'Vehiculo registrado correctamente.');
    }

    public function update(VehiculoRequest $request, Vehiculo $vehiculo)
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

    // Metodos para mostrar el formulario y registro de vehiculos de cada cliente en su perfil.

    public function misVehiculos()
    {
        $cliente = auth()->user()->cliente;
        $vehiculos = $cliente->vehiculos()->paginate(5);

        return view('perfilCliente.misVehiculos', compact('vehiculos'));
    }

    public function storeVehiculo(VehiculoRequest $request)
    {
        $cliente = auth()->user()->cliente;
        $datosValidos = $request->validated();
        $datosValidos['cliente_id'] = $cliente->id;
        Vehiculo::create($datosValidos);

        return redirect()->route('perfilCliente.misVehiculos')
            ->with('success', 'Vehiculo registrado correctamente.');
    }

    public function updateVehiculo(VehiculoRequest $request, Vehiculo $vehiculo)
    {
        $datos = $request->validated();

        $cliente = Cliente::where('documento', $request->cliente_id)->first();

        if ($cliente) {
            $datos['cliente_id'] = $cliente->id;
        }

        $vehiculo->update($datos);

        return redirect()->route('perfilCliente.misVehiculos')
            ->with('success', 'Vehiculo actualizado correctamente.');
    }
}
