@extends('layouts.plantilla')

@section('titulomain', 'Usuarios de Acceso')

@section('contenido')

    <div class="card">
        <div class="form-actions">
            <button class="btn btn-refresh" onclick="limpiarFormularioUsuario()" title="Limpiar">↺</button>
            <button class="btn btn-primary" onclick="submitRegistrarUsuario()">
                <i class="fa-solid fa-plus"></i> Registrar </button>
            <button class="btn btn-warning" onclick="submitActualizarUsuario()">
                <i class="fa-solid fa-pen-to-square"></i> Actualizar</button>
        </div>

        <form id="form-usuario" method="POST" action="{{ route('usuario.store') }}">
            @csrf
            <input type="hidden" name="_method" id="form-method-usuario" value="POST">
            <input type="hidden" name="usuario_id" id="usuario_id">

            <div class="form-grid">

                <div class="form-group">
                    <label>Documento</label>
                    <input type="text" name="documento" id="documento" placeholder="Numero de documento">
                </div>

                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo_cliente" id="correo_cliente" placeholder="Correo electronico">
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <div style="flex:1; position:relative;">
                        <input type="password" name="password" id="password" placeholder="Contraseña" style="width:100%;">
                        <span onclick="togglePassword()"
                            style="position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:16px;">
                            👁
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Rol</label>
                    <select name="rol" id="rol">
                        <option value="">Seleccionar...</option>
                        <option value="administrador">Administrador</option>
                        <option value="recepcionista">Recepcionista</option>
                        <option value="cliente">Cliente</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" id="estado">
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

            </div>
        </form>

        <div style="margin-top:16px;">
            <input type="text" id="input-busqueda-usuario" placeholder="Buscar por documento..."
                style="height:30px;border:1px solid #ccc;border-radius:4px;padding:0 10px;font-size:12px;width:280px;">
        </div>
    </div>

    {{-- Tabla --}}
    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Documento</th>
                        <th>Correo</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="tabla-usuarios">
                    @forelse($usuarios as $usuario)
                        <tr
                            onclick="seleccionarUsuario(
                        '{{ $usuario->id }}',
                        '{{ $usuario->documento }}',
                        '{{ $usuario->correo_cliente }}',
                        '{{ $usuario->password }}',
                        '{{ $usuario->rol }}',
                        '{{ $usuario->estado }}'
                    )">
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->documento }}</td>
                            <td>{{ $usuario->correo_cliente }}</td>
                            <td>{{ $usuario->password }}</td>
                            <td>{{ $usuario->rol }}</td>
                            <td>{{ $usuario->estado }}</td>
                            <td>
                                <span
                                    class="badge {{ $usuario->estado === 'activo' ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $usuario->estado }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:20px;color:#888;">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="paginacion">
            {{ $usuarios->links('vendor.pagination.default') }}
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/scriptUsuario.js') }}"></script>
@endpush
