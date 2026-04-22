<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required',
            'documento' => 'required|unique:users,documento',
            'nombre_cliente' => 'required',
            'telefono_cliente' => 'required',
            'direccion_cliente' => 'required',
            'correo_cliente' => 'required|email|unique:clientes,correo_cliente',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'documento.required' => 'El documento es obligatorio.',
            'documento.unique' => 'Este documento ya está registrado.',
            'nombre_cliente.required' => 'El nombre es obligatorio.',
            'telefono_cliente.required' => 'El telefono es obligatorio.',
            'direccion_cliente.required' => 'La direccion es obligatoria.',
            'correo_cliente.required' => 'El correo es obligatorio.',
            'correo_cliente.email' => 'El correo no tiene un formato valido.',
            'correo_cliente.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::create([
            'documento' => $request->documento,
            'password' => Hash::make($request->password),
            'rol' => 'cliente',
            'estado' => 'activo',
        ]);

        $user->assignRole('cliente');

        Cliente::create([
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'nombre_cliente' => $request->nombre_cliente,
            'telefono_cliente' => $request->telefono_cliente,
            'direccion_cliente' => $request->direccion_cliente,
            'correo_cliente' => $request->correo_cliente,
            'user_id' => $user->id,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('inicio');
    }
}
