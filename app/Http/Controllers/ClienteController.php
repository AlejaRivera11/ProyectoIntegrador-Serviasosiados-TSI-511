<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Str;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = Cliente::orderBy('id', 'DESC')->paginate(4);

        return view('cliente.index', compact('clientes'));
    }

    public function store(ClienteRequest $request)
    {
        $datosValidos = $request->validated();

        // Crear usuario con contraseña temporal
        $user = User::create([
            'documento' => $datosValidos['documento'],
            'password' => bcrypt(Str::random(8)),
            'rol' => 'cliente',
            'estado' => 'activo',
        ]);

        // Crear cliente — agregamos el user_id a los datos validados
        $datosValidos['user_id'] = $user->id;
        Cliente::create($datosValidos);

        return redirect()->route('cliente.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    public function update(ClienteRequest $request, Mecanico $mecanico)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->validated());

        return redirect()->route('cliente.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }
}
