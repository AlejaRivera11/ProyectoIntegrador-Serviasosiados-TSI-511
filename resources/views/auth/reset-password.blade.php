<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña — Serviasociados</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

    <div class="auth-card">

        {{-- LOGO --}}
        <div class="auth-logo">
            <img src="{{ asset('img/Logo2.png') }}" alt="Logo Serviasociados">
            <h1>SERVIASOCIADOS</h1>
            <p>Experiencia y Responsabilidad</p>
        </div>

        <div class="auth-title">Restablecer contraseña</div>

        {{-- ERRORES --}}
        @if ($errors->any())
            <div class="auth-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            {{-- TOKEN --}}
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- EMAIL --}}
            <div class="auth-group">
                <label>Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email', $request->email) }}"
                    placeholder="correo@email.com" required autofocus>
            </div>

            {{-- PASSWORD --}}
            <div class="auth-group">
                <label>Nueva contraseña</label>
                <input type="password" name="password" placeholder="Nueva contraseña" required>
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="auth-group">
                <label>Confirmar contraseña</label>
                <input type="password" name="password_confirmation" placeholder="Repite la contraseña" required>
            </div>

            <button type="submit" class="auth-btn">
                Restablecer contraseña
            </button>
        </form>

        <div class="auth-links">
            <a href="{{ route('login') }}">Volver al inicio de sesión</a>
        </div>

    </div>

</body>

</html>
