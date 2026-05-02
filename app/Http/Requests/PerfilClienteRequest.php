<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PerfilClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $cliente = auth()->user()->cliente;

        return [
            'telefono_cliente' => 'required',
            'correo_cliente' => 'required|email|unique:clientes,correo_cliente,'.$cliente->id,
            'direccion_cliente' => 'required',
            'password' => 'nullable|min:8', // opcional
        ];
    }

    public function messages(): array
    {
        return [
            'telefono_cliente.required' => 'El telefono es obligatorio.',
            'correo_cliente.required' => 'El correo es obligatorio.',
            'correo_cliente.email' => 'El correo no tiene un formato valido.',
            'correo_cliente.unique' => 'Este correo ya esta registrado.',
            'direccion_cliente.required' => 'La direccion es obligatoria.',
            'password.min' => 'La contrasena debe tener minimo 8 caracteres.',
        ];
    }
}
