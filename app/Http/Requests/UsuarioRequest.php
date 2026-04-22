<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
            'password'  => $id ? 'nullable|min:8' : 'required|min:8',
            'rol'       => 'required',
            'estado'    => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'documento.required' => 'El documento es obligatorio.',
            'documento.unique'   => 'Este documento ya esta registrado.',
            'password.required'  => 'La contrasena es obligatoria.',
            'password.min'       => 'La contrasena debe tener minimo 8 caracteres.',
            'rol.required'       => 'El rol es obligatorio.',
            'estado.required'    => 'El estado es obligatorio.',
        ];
    }
}
