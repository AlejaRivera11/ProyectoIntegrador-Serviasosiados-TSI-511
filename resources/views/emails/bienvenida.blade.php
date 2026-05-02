<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        .header {
            background: #1F4E79;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            color: #fff;
            font-size: 22px;
            margin: 0;
            letter-spacing: 2px;
        }

        .header p {
            color: #B5D4F4;
            font-size: 12px;
            margin: 6px 0 0;
        }

        .body {
            padding: 30px;
        }

        .body p {
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        .credenciales {
            background: #F4F6F9;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .credenciales p {
            margin: 8px 0;
            font-size: 14px;
        }

        .credenciales strong {
            color: #1F4E79;
        }

        .btn {
            display: inline-block;
            background: #1F4E79;
            color: #fff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 16px;
        }

        .btn a {
            color: #fff;
            text-decoration: none;
        }

        .footer {
            background: #f4f6f9;
            padding: 16px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>SERVIASOCIADOS</h1>
            <p>Experiencia y Responsabilidad</p>
        </div>
        <div class="body">
            <p>Hola, <strong>{{ $nombreCliente }}</strong>.</p>
            <p>Tu cuenta en el sistema de Serviasociados ha sido creada exitosamente. A continuación encontrarás tus
                credenciales de acceso:</p>

            <div class="credenciales">
                <p><strong>Usuario:</strong> {{ $documento }}</p>
                <p><strong>Contraseña temporal:</strong> {{ $passwordTemporal }}</p>
            </div>

            <p>Por seguridad, te recomendamos cambiar tu contraseña la primera vez que ingreses al sistema.</p>

            <a href="{{ url('/login') }}" class="btn">Ir al sistema</a>

            <p style="margin-top:24px; font-size:13px; color:#888;">
                Si no solicitaste esta cuenta, puedes ignorar este correo.
            </p>
        </div>
        <div class="footer">
            © 2026 Serviasociados · Calle 44 #12-29, Barrio El Troncal, Cali
        </div>
    </div>
</body>

</html>
