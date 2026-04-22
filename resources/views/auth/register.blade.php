<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta — Serviasociados</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

    <div class="auth-card">

        {{-- Título --}}
        <div class="auth-title">Crear Cuenta</div>

        {{-- Errores --}}
        @if ($errors->any())
            <div class="auth-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="auth-group">
                <label>Tipo de documento</label>
                <select name="tipo_documento">
                    <option value="">Seleccionar...</option>
                    <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>CC</option>
                    <option value="TI" {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}>TI</option>
                    <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>CE</option>
                    <option value="PT" {{ old('tipo_documento') == 'PT' ? 'selected' : '' }}>PT</option>
                    <option value="PE" {{ old('tipo_documento') == 'PE' ? 'selected' : '' }}>PE</option>
                </select>
            </div>

            <div class="auth-group">
                <label>Documento</label>
                <input type="text" name="documento" value="{{ old('documento') }}" placeholder="Numero de documento"
                    required>
            </div>

            <div class="auth-group">
                <label>Nombre completo</label>
                <input type="text" name="nombre_cliente" value="{{ old('nombre_cliente') }}"
                    placeholder="Nombre completo" required>
            </div>

            <div class="auth-group">
                <label>Telefono</label>
                <input type="text" name="telefono_cliente" value="{{ old('telefono_cliente') }}"
                    placeholder="Numero de telefono" required>
            </div>

            <div class="auth-group">
                <label>Direccion</label>
                <input type="text" name="direccion_cliente" value="{{ old('direccion_cliente') }}"
                    placeholder="Direccion" required>
            </div>

            <div class="auth-group">
                <label>Correo electronico</label>
                <input type="email" name="correo_cliente" value="{{ old('correo_cliente') }}"
                    placeholder="correo@email.com" required>
            </div>

            <div class="auth-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Minimo 8 caracteres" required>
            </div>

            <div class="auth-group">
                <label>Confirmar contraseña</label>
                <input type="password" name="password_confirmation" placeholder="Repite la contraseña" required>
            </div>

            <button type="submit" class="auth-btn">Registrarse</button>

        </form>

        <div class="auth-links">
            <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
        </div>

    </div>

</body>

</html>
