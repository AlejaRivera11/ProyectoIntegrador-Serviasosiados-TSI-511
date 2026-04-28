@extends('layouts.plantilla')

@section('titulomain', 'Mis Vehiculos')

@section('contenido')

    <div class="card">
        <div class="form-actions">
            <button class="btn btn-refresh" onclick="limpiarFormularioMiVehiculo()" title="Limpiar">↺</button>
            <button class="btn btn-primary" onclick="submitRegistrarMiVehiculo()">
                <i class="fas fa-plus"></i> Registrar
            </button>
            <button class="btn btn-warning" onclick="submitActualizarMiVehiculo()">
                <i class="fas fa-pen-to-square"></i> Actualizar
            </button>
        </div>

        <form id="form-vehiculo" method="POST" action="{{ route('perfilCliente.misVehiculos') }}">
            @csrf
            <input type="hidden" name="cliente_id" value="{{ auth()->user()->cliente->documento }}">
            <input type="hidden" name="_method" id="form-method" value="POST">
            <input type="hidden" name="vehiculo_id" id="vehiculo_id">

            <div class="form-grid">
                <div class="form-group">
                    <label>Placa</label>
                    <input type="text" name="placa" id="placa" placeholder="Placa del vehiculo">
                </div>
                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" name="marca" id="marca" placeholder="Marca">
                </div>
                <div class="form-group">
                    <label>Referencia</label>
                    <input type="text" name="referencia" id="referencia" placeholder="Referencia">
                </div>

                <div class="form-group">
                    <label>Modelo</label>
                    <input type="text" name="modelo" id="modelo" placeholder="Modelo">
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="color" id="color" placeholder="Color">
                </div>
                <div class="form-group">
                    <label>Kilometraje</label>
                    <input type="number" name="kilometraje" id="kilometraje" placeholder="Kilometraje">
                </div>
            </div>
        </form>
    </div>

    {{-- Tabla --}}
    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Referencia</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Kilometraje</th>
                    </tr>
                </thead>
                <tbody id="tabla-vehiculos">
                    @forelse($vehiculos as $vehiculo)
                        <tr
                            onclick="seleccionarMiVehiculo(
                        '{{ $vehiculo->id }}',
                        '{{ $vehiculo->placa }}',
                        '{{ $vehiculo->marca }}',
                        '{{ $vehiculo->referencia }}',
                        '{{ $vehiculo->modelo }}',
                        '{{ $vehiculo->color }}',
                        '{{ $vehiculo->kilometraje }}'
                    )">
                            <td>{{ $vehiculo->placa }}</td>
                            <td>{{ $vehiculo->marca }}</td>
                            <td>{{ $vehiculo->referencia }}</td>
                            <td>{{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->color }}</td>
                            <td>{{ $vehiculo->kilometraje }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:20px;color:#888;">
                                No tienes vehiculos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="paginacion">
            {{ $vehiculos->links('vendor.pagination.default') }}
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/scriptMiVehiculo.js') }}"></script>
@endpush
