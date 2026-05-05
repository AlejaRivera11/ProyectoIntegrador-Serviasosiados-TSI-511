<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Mecanico;
use App\Models\Servicio;
use App\Models\Vehiculo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

    public function pdfCitas(Request $request)
    {
        $query = Cita::with([
            'vehiculo.cliente',
            'servicioCita.servicio',
            'servicioCita.citaMecanicos.mecanico',
            'estado',
            'user',
        ]);

        if ($request->fecha_inicio) {
            $query->whereDate('fecha_cita', '>=', $request->fecha_inicio);
        }

        if ($request->fecha_fin) {
            $query->whereDate('fecha_cita', '<=', $request->fecha_fin);
        }

        if ($request->estado) {
            $query->whereHas('estado', function ($q) use ($request) {
                $q->where('nombre_estado', $request->estado);
            });
        }

        if ($request->buscar) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('vehiculo', function ($q2) use ($request) {
                    $q2->where('placa', 'like', '%'.$request->buscar.'%');
                })
                    ->orWhereHas('vehiculo.cliente', function ($q3) use ($request) {
                        $q3->where('documento', 'like', '%'.$request->buscar.'%');
                    });
            });
        }

        $citas = $query->orderBy('fecha_cita', 'DESC')->get();

        $pdf = Pdf::loadView('pdf.citas', compact('citas'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('reporte_citas.pdf');
    }

    public function pdfMecanicos()
    {
        $mecanicos = Mecanico::withCount([
            'citasMecanico as total_citas',
            'citasMecanico as en_curso' => function ($q) {
                $q->whereHas('servicioCita.cita.estado', function ($q) {
                    $q->where('nombre_estado', 'En curso');
                });
            },

            'citasMecanico as completadas' => function ($q) {
                $q->whereHas('servicioCita.cita.estado', function ($q) {
                    $q->where('nombre_estado', 'Completada');
                });
            },

            'citasMecanico as canceladas' => function ($q) {
                $q->whereHas('servicioCita.cita.estado', function ($q) {
                    $q->where('nombre_estado', 'Cancelada');
                });
            },

            'citasMecanico as agendadas' => function ($q) {
                $q->whereHas('servicioCita.cita.estado', function ($q) {
                    $q->where('nombre_estado', 'Agendada');
                });
            },

        ])->orderBy('total_citas', 'DESC')->get();

        $pdf = Pdf::loadView('pdf.mecanicos', compact('mecanicos'));

        $pdf->setPaper('carta', 'A4');

        return $pdf->stream();
    }

    public function pdfServicios()
    {
        $servicios = Servicio::withCount('servicioCitas as total_citas')
            ->orderBy('total_citas', 'DESC')
            ->get();

        $pdf = Pdf::loadView('pdf.servicios', compact('servicios'));

        $pdf->setPaper('carta', 'A4');

        return $pdf->stream();
    }
}
