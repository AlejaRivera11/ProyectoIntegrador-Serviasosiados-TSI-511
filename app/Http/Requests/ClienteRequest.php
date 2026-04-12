<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('cliente');

        return [
            'tipo_documento' => 'required',
            'documento' => 'required|unique:clientes,documento,'.$id,
            'nombre_cliente' => 'required',
            'telefono_cliente' => 'required',
            'correo_cliente' => 'required|email|unique:clientes,correo_cliente,'.$id,
            'direccion_cliente' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'documento.required' => 'El documento es obligatorio.',
            'documento.unique' => 'Este documento ya está registrado.',
            'nombre_cliente.required' => 'El nombre es obligatorio.',
            'telefono_cliente.required' => 'El telefono es obligatorio.',
            'correo_cliente.required' => 'El correo es obligatorio.',
            'correo_cliente.email' => 'El correo no tiene un formato valido.',
            'correo_cliente.unique' => 'Este correo ya está registrado.',
            'direccion_cliente.required' => 'La direccion es obligatoria.',
        ];
    }
}
