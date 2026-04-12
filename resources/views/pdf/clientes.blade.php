<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Clientes</title>
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
                <h1>Reporte de Clientes</h1>
            </td>
        </tr>
    </table>
    </div>

    <section class="container-tabla pdf">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo documento</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                </tr>
            </thead>
            <tbody class="tabla-clientes">
                @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->tipo_documento }}</td>
                    <td>{{ $cliente->documento }}</td>
                    <td>{{ $cliente->nombre_cliente }}</td>
                    <td>{{ $cliente->telefono_cliente }}</td>
                    <td>{{ $cliente->correo_cliente }}</td>
                    <td>{{ $cliente->direccion_cliente }}</td>
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
 