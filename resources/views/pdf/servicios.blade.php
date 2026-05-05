<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Servicios</title>
    <link rel="stylesheet" href="{{ public_path('css/tabla-pdf.css') }}">
</head>

<body>

    <div class="header">
        <table width="100%">
            <tr>
                <td class="header-left">
                    <img src="{{ public_path('img/logo_taller.png') }}" width="60">
                </td>
                <td class="header-right">
                    <h1>Reporte de Servicios</h1>
                </td>
            </tr>
        </table>
    </div>

    <section class="container-tabla pdf">
        <table>
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Descripción</th>
                    <th>Tiempo</th>
                    <th>Total citas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{ $servicio->descripcion }}</td>
                        <td>{{ $servicio->tiempo }} Hora</td>
                        <td>{{ $servicio->total_citas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <div class="footer">
        Fecha del reporte: {{ date('d/m/Y H:i') }}
    </div>

</body>

</html>
