<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña — Serviasociados</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="auth-card">

        <div class="auth-logo">
            <img src="{{ asset('img/Logo2.png') }}" alt="Logo Serviasociados">
            <h1>SERVIASOCIADOS</h1>
            <p>Experiencia y Responsabilidad</p>
        </div>

        <div class="auth-title">Recuperar contraseña</div>

        <p style="font-size:13px;color:#555;text-align:center;margin-bottom:16px;">
            Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.
        </p>

        @if (session('status'))
            <div class="auth-error" style="background:#EAF3DE;border-color:#97C459;color:#3B6D11;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="auth-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="auth-group">
                <label>Correo electronico</label>
                <input type="email" name="correo_cliente" value="{{ old('correo_cliente') }}"
                    placeholder="correo@email.com" required autofocus>
            </div>
            <button type="submit" class="auth-btn">Enviar enlace de recuperacion</button>
        </form>

        <div class="auth-links">
            <a href="{{ route('login') }}">Volver al inicio de sesion</a>
        </div>

    </div>
</body>

</html>
