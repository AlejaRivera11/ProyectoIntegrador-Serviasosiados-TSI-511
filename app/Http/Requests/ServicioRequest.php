<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // $id = $this->route('servicio')?->id;
        $id = $this->route('servicio');

        if (is_object($id)) {
            $id = $id->id;
        }

        return [
            'nombre' => 'required|unique:servicios,nombre,'.$id,
            'descripcion' => 'required',
            'tiempo' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del servicio es obligatorio.',
            'nombre.unique' => 'Este servicio ya esta registrado.',
            'descripcion.required' => 'La descripcion es obligatoria.',
            'tiempo.required' => 'El tiempo estimado es obligatorio.',
        ];
    }
}
