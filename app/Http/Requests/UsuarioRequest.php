<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('usuario')?->id;

        return [
            'documento' => 'required|unique:users,documento,'.$id,
            'correo_cliente' => 'required|email|unique:users,correo_cliente,'.$id,
            'password' => $id ? 'nullable|min:8' : 'required|min:8',
            'rol' => 'required',
            'estado' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'documento.required' => 'El documento es obligatorio.',
            'documento.unique' => 'Este documento ya esta registrado.',
            'correo_cliente.required' => 'El correo es obligatorio.',
            'correo_cliente.email' => 'El correo debe ser una direccion de email valida.',
            'correo_cliente.unique' => 'Este correo ya esta registrado.',
            'password.required' => 'La contrasena es obligatoria.',
            'password.min' => 'La contrasena debe tener minimo 8 caracteres.',
            'rol.required' => 'El rol es obligatorio.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
