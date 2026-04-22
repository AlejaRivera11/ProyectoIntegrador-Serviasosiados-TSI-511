@extends('layouts.plantilla')

@section('titulomain', 'Mecanicos')

@section('contenido')

    <div class="card">
        {{-- Botones de acción --}}
        <div class="form-actions">
            <button class="btn btn-refresh" onclick="limpiarFormularioMecanico()" title="Limpiar">↺</button>
            <button class="btn btn-primary" onclick="submitRegistrarMecanico()">
                <i class="fa-solid fa-plus"></i> Registrar</button>
            <button class="btn btn-warning" onclick="submitActualizarMecanico()">
                <i class="fa-solid fa-pen-to-square"></i> Actualizar</button>
        </div>

        {{-- Formulario --}}
        <form id="form-mecanico" method="POST" action="{{ route('mecanico.store') }}">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">
            <input type="hidden" name="mecanico_id" id="mecanico_id">
            <div class="form-grid">

                <div class="form-group">
                    <label>Tipo Doc.</label>
                    <select name="tipo_documento" id="tipo_documento">
                        <option value="">Seleccionar</option>
                        <option value="CC">CC-Cedula de ciudadanía</option>
                        <option value="TI">TI-Tarjeta de identidad</option>
                        <option value="CE">CE-Cedula de extranjería</option>
                        <option value="PT">PT-Pasaporte</option>
                        <option value="PE">PE-Permiso especial</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Documento</label>
                    <input type="text" name="documento_mecanico" id="documento_mecanico"
                        placeholder="Numero de documento">
                </div>

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre_mecanico" id="nombre_mecanico" placeholder="Nombre completo">
                </div>


                <div class="form-group">
                    <label>Telefono</label>
                    <input type="text" name="telefono_mecanico" id="telefono_mecanico" placeholder="Telefono">
                </div>

                <div class="form-group">
                    <label>Direccion</label>
                    <input type="text" name="direccion_mecanico" id="direccion_mecanico" placeholder="Direccion">
                </div>
            </div>
        </form>

        {{-- Buscador --}}
        <div class="buscador">
            <input type="text" id="input-busqueda" placeholder="Buscar por documento o nombre..." class="input-buscador">
        </div>
    </div>

    {{-- Tabla --}}
    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Tipo Doc.</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                    </tr>
                </thead>
                <tbody id="tabla-mecanicos">
                    @forelse($mecanicos as $mecanico)
                        <tr
                            onclick="seleccionarMecanico(
            '{{ $mecanico->id }}',
            '{{ $mecanico->tipo_documento }}',
            '{{ $mecanico->documento_mecanico }}',
            '{{ $mecanico->nombre_mecanico }}',
            '{{ $mecanico->telefono_mecanico }}',
            '{{ $mecanico->direccion_mecanico }}'
          )">
                            <td>{{ $mecanico->tipo_documento }}</td>
                            <td>{{ $mecanico->documento_mecanico }}</td>
                            <td>{{ $mecanico->nombre_mecanico }}</td>
                            <td>{{ $mecanico->telefono_mecanico }}</td>
                            <td>{{ $mecanico->direccion_mecanico }}</td>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:20px;color:#888;">
                                No hay mecanicos registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- resultados de paginacion --}}
        <div class='paginacion'>
            {{ $mecanicos->links('vendor.pagination.default') }}
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/scriptMecanico.js') }}"></script>
@endpush
