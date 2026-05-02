@extends('layouts.plantilla')

@section('titulomain', 'Datos Personales')

@section('contenido')

    <main class="main-content">
        <div class="card-perfil">
            <div class="form-actions">
                <button class="btn btn-warning" onclick="document.getElementById('form-perfil').submit()">
                    <i class="fas fa-pen-to-square"></i> Actualizar
                </button>
            </div>

            <form id="form-perfil" method="POST" action="{{ route('perfilCliente.datosPersonales') }}">
                @csrf
                @method('PUT')

                <div class="form-grid-perfil">

                    <div class="form-group-perfil">
                        <label>Tipo de documento</label>
                        <input type="text" value="{{ $cliente->tipo_documento }}" disabled>
                    </div>

                    <div class="form-group-perfil">
                        <label>Documento</label>
                        <input type="text" value="{{ $cliente->documento }}" disabled>
                    </div>

                    <div class="form-group-perfil">
                        <label>Nombre</label>
                        <input type="text" value="{{ $cliente->nombre_cliente }}" disabled>
                    </div>

                    <div class="form-group-perfil">
                        <label>Telefono</label>
                        <input type="text" name="telefono_cliente"
                            value="{{ old('telefono_cliente', $cliente->telefono_cliente) }}">
                    </div>

                    <div class="form-group-perfil">
                        <label>Direccion</label>
                        <input type="text" name="direccion_cliente"
                            value="{{ old('direccion_cliente', $cliente->direccion_cliente) }}">
                    </div>

                    <div class="form-group-perfil">
                        <label>Correo electronico</label>
                        <input type="email" name="correo_cliente"
                            value="{{ old('correo_cliente', $cliente->correo_cliente) }}">
                    </div>

                    <div class="form-group-perfil">
                        <label>Contraseña</label>
                        <div style="flex:1; position:relative;">
                            <input type="password" name="password" id="password" placeholder="Contraseña"
                                style="width:460px;">
                            <span onclick="togglePassword()"
                                style="position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:16px;">
                                👁
                            </span>
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </main>


@endsection

@push('scripts')
    <script src="{{ asset('js/scriptUsuario.js') }}"></script>
@endpush
