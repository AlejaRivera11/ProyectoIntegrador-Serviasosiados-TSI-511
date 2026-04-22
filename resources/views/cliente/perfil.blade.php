@extends('layouts.plantilla')
@section('titulomain', 'Perfil del Cliente')
@section('contenido')

    <div class="card">
        <h2>Perfil del Cliente</h2>
        <p><strong>Nombre:</strong>
            {{ $cliente->nombre_cliente }}
        </p>
        <p><strong>Tipo de Documento:</strong>
            {{ $cliente->tipo_documento }}
        </p>
        <p><strong>Documento:</strong>
            {{ $cliente->documento }}
        </p>
        <p><strong>Correo:</strong>
            {{ $cliente->correo_cliente }}
        </p>
        <p><strong>Teléfono:</strong>
            {{ $cliente->telefono_cliente }}
        </p>
        <p><strong>Dirección:</strong>
            {{ $cliente->direccion_cliente }}
        </p>
    </div>

@endsection
