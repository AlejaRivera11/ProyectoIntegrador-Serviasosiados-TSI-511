<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('vehiculo')?->id;

        return [
            'placa' => 'required|unique:vehiculos,placa,'.$id,
            'marca' => 'required',
            'referencia' => 'required',
            'modelo' => 'required',
            'color' => 'required',
            'kilometraje' => 'required|integer',
            'cliente_id' => 'required|exists:clientes,documento',
        ];
    }

    public function messages(): array
    {
        return [
            'placa.required' => 'La placa es obligatoria.',
            'placa.unique' => 'Esta placa ya está registrada.',
            'marca.required' => 'La marca es obligatoria.',
            'referencia.required' => 'La referencia es obligatoria.',
            'modelo.required' => 'El modelo es obligatorio.',
            'color.required' => 'El color es obligatorio.',
            'kilometraje.required' => 'El kilometraje es obligatorio.',
            'kilometraje.integer' => 'El kilometraje debe ser un número entero.',
            'cliente_id.required' => 'El documento del cliente es obligatorio.',
            'cliente_id.exists' => 'El documento del cliente seleccionado no existe.',
        ];
    }
}
