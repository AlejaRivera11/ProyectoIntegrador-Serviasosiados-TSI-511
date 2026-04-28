@extends('layouts.plantilla')

@section('titulomain', 'Servicios')

@section('contenido')

<div class="card">
    <div class="form-actions">
        <button class="btn btn-refresh" onclick="limpiarFormularioServicio()" title="Limpiar">↺</button>
        <button class="btn btn-primary" onclick="submitRegistrarServicio()">
            <i class="fas fa-plus"></i> Registrar
        </button>
        <button class="btn btn-warning" onclick="submitActualizarServicio()">
            <i class="fas fa-pen-to-square"></i> Actualizar
        </button>
    </div>

    <form id="form-servicio" method="POST" action="{{ route('servicio.store') }}">
        @csrf
        <input type="hidden" name="_method" id="form-method" value="POST">
        <input type="hidden" name="servicio_id" id="servicio_id">

        <div class="form-grid">

            <div class="form-group">
                <label>Nombre del servicio</label>
                <input type="text" name="nombre" id="nombre"
                       placeholder="Nombre del servicio">
            </div>

            <div class="form-group">
                <label>Tiempo estimado</label>
                <input type="text" name="tiempo" id="tiempo"
                       placeholder="Ej: 2 horas">
            </div>

            <div class="form-group full">
                <label>Descripcion</label>
                <input type="text" name="descripcion" id="descripcion"
                       placeholder="Descripcion del servicio">
            </div>

        </div>
    </form>

    <div class="buscador">
        <input type="text" id="input-busqueda"
               placeholder="Buscar por nombre..."
               class="input-buscador">
    </div>
</div>

{{-- Tabla --}}
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Tiempo estimado</th>
                </tr>
            </thead>
            <tbody id="tabla-servicios">
                @forelse($servicios as $servicio)
                    <tr onclick="seleccionarServicio(
                        '{{ $servicio->id }}',
                        '{{ $servicio->nombre }}',
                        '{{ $servicio->descripcion }}',
                        '{{ $servicio->tiempo}}'
                    )">
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{ $servicio->descripcion }}</td>
                        <td>{{ $servicio->tiempo }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center;padding:20px;color:#888;">
                            No hay servicios registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="paginacion">
        {{ $servicios->links('vendor.pagination.default') }}
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/scriptServicio.js') }}"></script>
@endpush