<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilClienteRequest;
use Illuminate\Support\Facades\Hash;

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

        // Actualizar datos del cliente
        $cliente->update([
            'telefono_cliente' => $request->telefono_cliente,
            'correo_cliente' => $request->correo_cliente,
            'direccion_cliente' => $request->direccion_cliente,
        ]);

        // Actualizar contraseña si se ingresó una nueva
        if ($request->filled('password')) {
            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('perfilCliente.datosPersonales')
            ->with('success', 'Datos actualizados correctamente.');
    }
}
