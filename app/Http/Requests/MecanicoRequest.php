<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MecanicoRequest extends FormRequest
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
        $id = $this->route('mecanico');

        return [
            'tipo_documento' => 'required',
            'documento_mecanico' => 'required|unique:mecanicos,documento_mecanico,'.$id,
            'nombre_mecanico' => 'required',
            'telefono_mecanico' => 'required',
            'direccion_mecanico' => 'required',
        ];

    }

    public function messages(): array
    {
        return [
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'documento_mecanico.required' => 'El documento es obligatorio.',
            'documento_mecanico.unique' => 'Este documento ya está registrado.',
            'nombre_mecanico.required' => 'El nombre es obligatorio.',
            'telefono_mecanico.required' => 'El telefono es obligatorio.',
            'direccion_mecanico.required' => 'La direccion es obligatoria.',
        ];
    }
}
