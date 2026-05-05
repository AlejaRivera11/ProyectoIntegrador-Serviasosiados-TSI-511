<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Mecánicos</title>
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
                    <h1>Reporte de Mecánicos</h1>
                </td>
            </tr>
        </table>
    </div>

    <section class="container-tabla pdf">
        <table>
            <thead>
                <tr>
                    <th>Mecánico</th>
                    <th>Documento</th>
                    <th>Agendadas</th>
                    <th>En curso</th>
                    <th>Completadas</th>
                    <th>Canceladas</th>
                    <th>Total citas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mecanicos as $mecanico)
                    <tr>
                        <td>{{ $mecanico->nombre_mecanico }}</td>
                        <td>{{ $mecanico->documento_mecanico }}</td>
                        <td>{{ $mecanico->agendadas }}</td>
                        <td>{{ $mecanico->en_curso }}</td>
                        <td>{{ $mecanico->completadas }}</td>
                        <td>{{ $mecanico->canceladas }}</td>
                        <td>{{ $mecanico->total_citas }}</td>
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
