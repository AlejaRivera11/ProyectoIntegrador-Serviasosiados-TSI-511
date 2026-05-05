<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Citas</title>
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
                    <h1>Reporte de Citas</h1>
                </td>
            </tr>
        </table>
    </div>

    <section class="container-tabla pdf">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Placa</th>
                    <th>Doc. Cliente</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Mecanico</th>
                    <th>Agendado por</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>
                        <td>{{ $cita->id }}</td>
                        <td>{{ $cita->fecha_cita }}</td>
                        <td>{{ $cita->hora_cita }}</td>
                        <td>{{ $cita->vehiculo->placa ?? '—' }}</td>
                        <td>{{ $cita->vehiculo->cliente->documento ?? '—' }}</td>
                        <td>{{ $cita->vehiculo->cliente->nombre_cliente ?? '—' }}</td>
                        <td>{{ $cita->servicioCita->servicio->nombre ?? '—' }}</td>
                        <td>{{ $cita->servicioCita->citaMecanicos->mecanico->nombre_mecanico ?? '—' }}</td>
                        <td>
                            @if ($cita->user && $cita->user->cliente)
                                {{ $cita->user->cliente->nombre_cliente }}
                            @elseif($cita->user)
                                {{ $cita->user->getRoleNames()->first() }}
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $cita->estado->nombre_estado ?? '—' }}</td>
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
