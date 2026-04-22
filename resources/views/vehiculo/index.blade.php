@extends('layouts.plantilla')

@section('titulomain', 'Vehículos')

@section('contenido')

    <div class="card">
        {{-- Botones de acción --}}

        <div class="form-actions">
            <button class="btn btn-refresh" onclick="limpiarFormularioVehiculo()" title="Limpiar campos">↺</button>

            <button class="btn btn-primary" onclick="submitRegistrarVehiculo()" title="Registrar nuevo vehículo">
                <i class="fa-solid fa-plus"></i> Registrar
            </button>

            <button class="btn btn-warning" onclick="submitActualizarVehiculo()" title="Guardar cambios">
                <i class="fa-solid fa-pen-to-square"></i> Actualizar
            </button>

            <a href="{{ route('pdf.vehiculos') }}" target="_blank" class="btn btn-secondary" title="Exportar a PDF">
                <i class="fa-solid fa-file-export"></i> Exportar
            </a>
        </div>

        {{-- Formulario --}}
        <form id="form-vehiculo" method="POST" action="{{ route('vehiculo.store') }}">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">
            <input type="hidden" name="vehiculo_id" id="vehiculo_id">

            <div class="form-grid">
                <div class="form-group">
                    <label>Placa</label>
                    <input type="text" name="placa" id="placa" placeholder="Placa del vehículo">
                </div>

                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" name="marca" id="marca" placeholder="Marca del vehículo">
                </div>

                <div class="form-group">
                    <label>Modelo</label>
                    <input type="text" name="modelo" id="modelo" placeholder="Modelo del vehículo">
                </div>

                <div class="form-group">
                    <label>Referencia</label>
                    <input type="text" name="referencia" id="referencia" placeholder="Referencia del vehículo">
                </div>

                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="color" id="color" placeholder="Color del vehículo">
                </div>

                <div class="form-group">
                    <label>Kilometraje</label>
                    <input type="number" name="kilometraje" id="kilometraje" placeholder="Kilometraje del vehículo">
                </div>

                <div class="form-group">
                    <label>Documento del propietario</label>
                    <input type="text" name="cliente_id" id="cliente_id" placeholder="Documento del propietario">
                </div>
            </div>
        </form>

        <div class="buscador">
            <input type="text" id="input-busqueda" placeholder="Buscar por placa..." class="input-buscador">
        </div>
    </div>


    {{-- Tabla --}}
    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Referencia</th>
                        <th>Color</th>
                        <th>Kilometraje</th>
                        <th>Documento Propietario</th>
                    </tr>
                </thead>
                <tbody id="tabla-vehiculos">
                    @forelse($vehiculos as $vehiculo)
                        <tr
                            onclick="seleccionarVehiculo(
                    '{{ $vehiculo->id }}',
                    '{{ $vehiculo->placa }}',
                    '{{ $vehiculo->marca }}',
                    '{{ $vehiculo->modelo }}',
                    '{{ $vehiculo->referencia }}',
                    '{{ $vehiculo->color }}',
                    '{{ $vehiculo->kilometraje }}',
                    '{{ $vehiculo->cliente->documento }}'
                          )">
                            <td>{{ $vehiculo->placa }}</td>
                            <td>{{ $vehiculo->marca }}</td>
                            <td>{{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->referencia }}</td>
                            <td>{{ $vehiculo->color }}</td>
                            <td>{{ $vehiculo->kilometraje }}</td>
                            <td>{{ $vehiculo->cliente->documento }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:20px;color:#888;">
                                No se encontraron vehículos.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Resultados de paginación --}}
        <div class='paginacion'>
            {{ $vehiculos->links('vendor.pagination.default') }}
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/scriptVehiculo.js') }}"></script>
@endpush
