<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Estado;
use App\Models\Mecanico;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        $estados = Estado::all();

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

        $citas = $query->orderBy('fecha_cita', 'DESC')->paginate(6);

        $servicios = Servicio::withCount('servicioCitas as total_citas')
            ->orderBy('total_citas', 'DESC')
            ->get();

        $mecanicos = Mecanico::withCount([
            'citasMecanico as total_citas',
            'citasMecanico as completadas' => fn ($q) => $q->whereHas('servicioCita.cita.estado', fn ($q) => $q->where('nombre_estado', 'Completada')),
            'citasMecanico as canceladas' => fn ($q) => $q->whereHas('servicioCita.cita.estado', fn ($q) => $q->where('nombre_estado', 'Cancelada')),
            'citasMecanico as en_curso' => fn ($q) => $q->whereHas('servicioCita.cita.estado', fn ($q) => $q->where('nombre_estado', 'En curso')),
            'citasMecanico as agendadas' => fn ($q) => $q->whereHas('servicioCita.cita.estado', fn ($q) => $q->where('nombre_estado', 'Agendada')),
        ])->get();

        return view('reportes.index', compact('citas', 'servicios', 'mecanicos', 'estados'));
    }
}
