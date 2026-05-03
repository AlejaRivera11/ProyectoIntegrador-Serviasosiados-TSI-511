@extends('layouts.plantilla')

@section('titulomain', 'Clientes')

@section('contenido')

    <div class="card">
        {{-- Botones de acción --}}
        <div class="form-actions">
            <button class="btn btn-refresh" onclick="limpiarFormulario()" title="Limpiar">↺</button>
            <button class="btn btn-primary" onclick="submitRegistrar()">
                <i class="fa-solid fa-plus"></i> Registrar</button>
            <button class="btn btn-warning" onclick="submitActualizar()">
                <i class="fa-solid fa-pen-to-square"></i> Actualizar</button>
            <a href="{{ route('pdf.clientes') }}" target="_blank" class="btn btn-secondary" title="Exportar a PDF">
                <i class="fa-solid fa-file-export"></i> Exportar</a>
        </div>

        {{-- Formulario --}}
        <form id="form-cliente" method="POST" action="{{ route('cliente.store') }}">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">
            <input type="hidden" name="cliente_id" id="cliente_id">

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
                    <label>Nombre</label>
                    <input type="text" name="nombre_cliente" id="nombre_cliente" placeholder="Nombre completo">
                </div>

                <div class="form-group">
                    <label>Documento</label>
                    <input type="text" name="documento" id="documento" placeholder="Numero de documento">
                </div>

                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo_cliente" id="correo_cliente" placeholder="correo@email.com">
                </div>

                <div class="form-group">
                    <label>Telefono</label>
                    <input type="text" name="telefono_cliente" id="telefono_cliente" placeholder="Telefono">
                </div>

                <div class="form-group">
                    <label>Direccion</label>
                    <input type="text" name="direccion_cliente" id="direccion_cliente" placeholder="Direccion">
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
                        <th>Tipo Documento</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Correo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="tabla-clientes">
                    @forelse($clientes as $cliente)
                        <tr
                            onclick="seleccionarCliente(
            '{{ $cliente->id }}',
            '{{ $cliente->tipo_documento }}',
            '{{ $cliente->documento }}',
            '{{ $cliente->nombre_cliente }}',
            '{{ $cliente->telefono_cliente }}',
            '{{ $cliente->correo_cliente }}',
            '{{ $cliente->direccion_cliente }}'
          )">
                            <td>{{ $cliente->tipo_documento }}</td>
                            <td>{{ $cliente->documento }}</td>
                            <td>{{ $cliente->nombre_cliente }}</td>
                            <td>{{ $cliente->telefono_cliente }}</td>
                            <td>{{ $cliente->direccion_cliente }}</td>
                            <td>{{ $cliente->correo_cliente }}</td>
                            <td>
                                <span
                                    class="badge {{ $cliente->user->estado === 'activo' ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $cliente->user->estado }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:20px;color:#888;">
                                No hay clientes registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- resultados de paginacion --}}
        <div class='paginacion'>
            {{ $clientes->links('vendor.pagination.default') }}
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/scriptCliente.js') }}"></script>
@endpush
