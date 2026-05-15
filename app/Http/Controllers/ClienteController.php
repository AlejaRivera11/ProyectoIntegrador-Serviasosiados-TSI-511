<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Mail\BienvenidaClienteMail;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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

        $passwordTemporal = Str::random(8);

        $user = User::create([
            'nombre' => $datosValidos['nombre_cliente'],
            'documento' => $datosValidos['documento'],
            'correo_cliente' => $datosValidos['correo_cliente'],
            'email' => $datosValidos['correo_cliente'],
            'password' => bcrypt($passwordTemporal),
            'rol' => 'cliente',
            'estado' => 'activo',
        ]);

        $user->assignRole('cliente');

        $datosValidos['user_id'] = $user->id;
        Cliente::create($datosValidos);

        Mail::to($datosValidos['correo_cliente'])->send(
            new BienvenidaClienteMail(
                $datosValidos['nombre_cliente'],
                $datosValidos['documento'],
                $passwordTemporal
            )
        );

        return redirect()->route('cliente.index')
            ->with('success', 'Cliente registrado y credenciales enviadas por correo.');
    }

    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());

        return redirect()->route('cliente.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }
}
