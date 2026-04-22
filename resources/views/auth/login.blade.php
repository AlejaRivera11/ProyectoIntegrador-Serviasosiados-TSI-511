<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — Serviasociados</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

    <div class="auth-card">

        {{-- Logo --}}
        <div class="auth-logo">
            <img src="{{ asset('img/Logo2.png') }}" alt="Logo Serviasociados">
            <h1>SERVIASOCIADOS</h1>
            <p>Experiencia y Responsabilidad</p>
        </div>

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
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="auth-group">
                <label>Numero de documento</label>
                <input type="text" name="documento" value="{{ old('documento') }}" placeholder="Ingresa tu documento"
                    required autofocus>
            </div>

            <div class="auth-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>

            <button type="submit" class="auth-btn">Iniciar Sesión</button>

        </form>

        <div class="auth-links">
            <a href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
        </div>

    </div>

</body>

</html>
