<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vehiculo;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function pdfClientes()
    {
        $clientes = Cliente::select('id', 'tipo_documento', 'documento', 'nombre_cliente', 'telefono_cliente', 'correo_cliente', 'direccion_cliente')
            ->orderBy('id', 'ASC')
            ->get();
        $pdf = Pdf::loadView('pdf.clientes', compact('clientes'));
        $pdf->setPaper('carta', 'A4');

        return $pdf->stream();
    }

    public function pdfVehiculo()
    {
        $vehiculos = Vehiculo::select('id', 'placa', 'marca', 'modelo', 'referencia', 'color', 'kilometraje', 'cliente_id')
            ->orderBy('id', 'ASC')
            ->get();
        $pdf = Pdf::loadView('pdf.vehiculos', compact('vehiculos'));
        $pdf->setPaper('carta', 'A4');

        return $pdf->stream();
    }
}
