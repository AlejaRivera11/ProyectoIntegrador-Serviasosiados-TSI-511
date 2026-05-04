<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('id', 'DESC')->paginate(4);

        return view('usuario.index', compact('usuarios'));
    }

    public function store(UsuarioRequest $request)
    {
        $datosValidos = $request->validated();
        $datosValidos['password'] = Hash::make($datosValidos['password']);
        $datosValidos['email'] = $datosValidos['correo_cliente'];
        $user = User::create($datosValidos);

        $user->assignRole($request->rol);

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function update(UsuarioRequest $request, User $usuario)
    {
        $datosValidos = $request->validated();

        if (! empty($datosValidos['password'])) {
            $datosValidos['password'] = Hash::make($datosValidos['password']);
        } else {
            unset($datosValidos['password']);
        }

        $usuario->update($datosValidos);
        $usuario->syncRoles([$request->rol]);

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }
}
