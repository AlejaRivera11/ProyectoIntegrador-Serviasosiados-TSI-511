<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cita_mecanico;
use App\Models\Estado;
use App\Models\mecanico;
use App\Models\servicio;
use App\Models\Servicio_cita;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    /* METODO PARA MOSTRAR LAS CITAS */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasAnyRole(['administrador', 'recepcionista'])) {
            $vehiculos = Vehiculo::all();
        } else {
            $vehiculos = Vehiculo::where('cliente_id', $user->cliente->id)->get();
        }

        $servicios = servicio::all();
        $citas = Cita::all();

        return view('cita.index', compact('citas', 'vehiculos', 'servicios'));
    }

    /* METODO PARA GUARDAR LA CITA */
    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'servicio_id' => 'required|exists:servicios,id',
            'fecha_cita' => 'required|date|after_or_equal:today',
            'hora_cita' => 'required',
        ]);

        $user = Auth::user();

        /* VALIDAR VEHÍCULO SEGÚN ROL */
        if ($user->hasAnyRole(['administrador', 'recepcionista'])) {

            $vehiculo = Vehiculo::find($request->vehiculo_id);

            if (! $vehiculo) {
                return back()->with('error', 'Vehículo no válido.');
            }

        } else {

            if (! $user->cliente) {
                return back()->with('error', 'El usuario no tiene perfil de cliente.');
            }

            $vehiculo = Vehiculo::where('id', $request->vehiculo_id)
                ->where('cliente_id', $user->cliente->id)
                ->first();

            if (! $vehiculo) {
                return back()->with('error', 'El vehículo no pertenece al cliente.');
            }
        }

        /* SERVICIO Y DURACIÓN */
        $servicio = servicio::findOrFail($request->servicio_id);
        $duracion = (int) $servicio->tiempo;

        $inicio = Carbon::parse($request->fecha_cita.' '.$request->hora_cita);
        $fin = $inicio->copy()->addMinutes($duracion);

        /* MECÁNICOS DISPONIBLES */
        $mecanico = mecanico::whereDoesntHave('citasMecanico.servicioCita', function ($q) use ($inicio, $fin) {
            $q->where('fecha_inicio', '<', $fin)
                ->where('fecha_final', '>', $inicio);
        })->first();

        if (! $mecanico) {
            return back()->with('error', 'No hay mecánicos disponibles.');
        }

        /* ESTADO INICIAL */
        $estado = Estado::where('nombre_estado', 'Agendada')->firstOrFail();

        /* CREAR CITA */
        $cita = Cita::create([
            'fecha_cita' => $request->fecha_cita,
            'hora_cita' => $request->hora_cita,
            'estado_id' => $estado->id,
            'vehiculo_id' => $vehiculo->id,
            'user_id' => $user->id,
        ]);

        /* SERVICIO CITA */
        $servicioCita = Servicio_cita::create([
            'fecha_inicio' => $inicio,
            'fecha_final' => $fin,
            'servicio_id' => $servicio->id,
            'cita_id' => $cita->id,
        ]);

        /* ASIGNAR MECÁNICO */
        Cita_mecanico::create([
            'mecanico_id' => $mecanico->id,
            'servicio_cita_id' => $servicioCita->id,
        ]);

        return redirect()->route('cita.index')
            ->with('success', 'Cita agendada correctamente.');
    }

    /* METODO PARA CANCELAR CITA (CLIENTE + ADMINISTRADOR + RECEPCIÓN) */
    public function destroy(Cita $cita)
    {
        $estado = Estado::where('nombre_estado', 'Cancelada')->firstOrFail();

        $cita->update([
            'estado_id' => $estado->id,
        ]);

        return back()->with('success', 'Cita cancelada.');
    }

    /* METODO PARA CAMBIO DE ESTADO (SOLO ADMINISTRADOR Y RECEPCIÓN) */
    public function actualizarEstado(Request $request, Cita $cita)
    {
        if (! auth()->user()->hasAnyRole(['administrador', 'recepcion', 'recepcionista'])) {
            abort(403);
        }

        $request->validate([
            'estado_id' => 'required|exists:estados,id',
        ]);

        $cita->update([
            'estado_id' => $request->estado_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente',
        ]);
    }

    /* METODO PARA VALIDAR HORAS DISPONIBLES */
    public function horasDisponibles(Request $request)
    {
        $servicio = servicio::find($request->servicio_id);
        $duracion = (int) $servicio->tiempo;

        $fecha = $request->fecha;

        $horasDisponibles = [];

        for ($h = 8; $h <= 17; $h++) {

            $inicio = Carbon::parse($fecha.' '.str_pad($h, 2, '0', STR_PAD_LEFT).':00');
            $fin = $inicio->copy()->addMinutes($duracion);

            $hay = mecanico::whereDoesntHave('citasMecanico.servicioCita', function ($q) use ($inicio, $fin) {
                $q->where('fecha_inicio', '<', $fin)
                    ->where('fecha_final', '>', $inicio);
            })->exists();

            if ($hay) {
                $horasDisponibles[] = $inicio->format('H:i');
            }
        }

        return response()->json($horasDisponibles);
    }

    /* ------------ METODOS PARA LAS CITAS PROGRAMADAS --------- */
    public function citasProgramadas()
    {
        $estados = Estado::all();

        $estadosVisibles = Estado::whereIn('nombre_estado', ['Agendada', 'En curso'])
            ->pluck('id');

        $citas = Cita::with([
            'vehiculo.cliente',
            'servicioCita.servicio',
            'servicioCita.citaMecanicos.mecanico',
            'estado',
            'user',
        ])
            ->whereIn('estado_id', $estadosVisibles)
            ->orderBy('fecha_cita', 'ASC')
            ->paginate(5);

        return view('cita.citasProgramadas', compact('citas', 'estados'));
    }

    /* ------------ METODOS PARA LAS CITAS POR CLIENTE --------- */
    public function misCitas()
    {
        $user = auth()->user();

        $citas = Cita::with(['vehiculo', 'servicioCita.servicio', 'estado'])
            ->whereHas('vehiculo.cliente', function ($query) use ($user) {
                $query->where('id', $user->cliente->id);
            })
            ->orderBy('fecha_cita', 'ASC')
            ->get();

        return view('perfilCliente.misCitas', compact('citas'));
    }

    public function cancelarCliente(Request $request, Cita $cita)
    {

        $user = auth()->user();

        /* Validar que la cita sea del cliente logueado */
        if (! $user->cliente || $cita->vehiculo->cliente_id != $user->cliente->id) {
            abort(403, 'No tienes permiso para cancelar esta cita.');
        }

        /* Validar que esté en estado Agendada */
        if ($cita->estado->nombre_estado != 'Agendada') {
            return back()->with('error', 'Solo puedes cancelar citas agendadas.');
        }

        /* Validar 24 horas antes de la cita */
        $fechaCita = Carbon::parse($cita->fecha_cita.' '.$cita->hora_cita);

        /* horas que faltan desde ahora hasta la cita */
        $horasRestantes = now()->diffInHours($fechaCita, false);

        if ($horasRestantes < 24) {
            return back()->with('error', 'Solo puedes cancelar con mínimo 24 horas de anticipación.');
        }

        /* Cambiar estado a Cancelada */
        $estado = Estado::where('nombre_estado', 'Cancelada')->first();

        $cita->update([
            'estado_id' => $estado->id,
        ]);

        return redirect()->route('perfilCliente.misCitas')
            ->with('success', 'Cita cancelada correctamente.');
    }
}
