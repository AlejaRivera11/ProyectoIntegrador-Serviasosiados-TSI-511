<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Vehículos</title>
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
                <h1>Reporte de Vehículos</h1>
            </td>
        </tr>
    </table>
    </div>

    <section class="container-tabla pdf">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Referencia</th>
                    <th>Color</th>
                    <th>Kilometraje</th>
                    <th>Documento Propietario</th>
                </tr>
            </thead>
            <tbody class="tabla-vehiculos">
                @foreach ($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->id }}</td>
                    <td>{{ $vehiculo->placa }}</td>
                    <td>{{ $vehiculo->marca }}</td>
                    <td>{{ $vehiculo->modelo }}</td>
                    <td>{{ $vehiculo->referencia }}</td>
                    <td>{{ $vehiculo->color }}</td>
                    <td>{{ $vehiculo->kilometraje }}</td>
                    <td>{{ $vehiculo->cliente->documento }}</td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    </section>

    <div class="footer">
        Fecha del reporte: {{ date('d/m/Y') }} <!-- Pie de página con la fecha -->
    </div>
</body>
</html>
 