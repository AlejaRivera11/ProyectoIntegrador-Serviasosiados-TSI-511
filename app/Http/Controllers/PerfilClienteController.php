<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilClienteRequest;

class PerfilClienteController extends Controller
{
    public function index()
    {
        $cliente = auth()->user()->cliente;

        return view('perfilCliente.datosPersonales', compact('cliente'));
    }

    public function update(PerfilClienteRequest $request)
    {
        $cliente = auth()->user()->cliente;
        $cliente->update($request->validated());

        return redirect()->route('perfilCliente.datosPersonales')->with('success', 'Datos actualizados correctamente.');
    }
}
