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
    /*
    LISTADO DE CITAS
    */
    public function index()
    {
        $user = Auth::user();

        $vehiculos = Vehiculo::where('cliente_id', optional($user->cliente)->id)->get();
        $servicios = servicio::all();

        $citas = Cita::all();

        return view('cita.index', compact('citas', 'vehiculos', 'servicios'));
    }

    /*
    FORMULARIO DE AGENDAR
    */
    public function create()
    {
        $user = Auth::user();

        // 🔥 AQUÍ ES DONDE VA TU LÓGICA
        if ($user->hasAnyRole(['administrador', 'recepcion'])) {
            $vehiculos = Vehiculo::all();
        } else {
            $vehiculos = $user->cliente->vehiculos ?? [];
        }

        $servicios = servicio::all();

        return view('cita.index', compact('vehiculos', 'servicios'));
    }

    /*
    GUARDAR CITA
    */
    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'servicio_id' => 'required|exists:servicios,id',
            'fecha_cita' => 'required|date|after_or_equal:today',
            'hora_cita' => 'required',
        ]);

        $user = Auth::user();

        if (! $user->cliente) {
            return back()->with('error', 'El usuario no tiene perfil de cliente.');
        }

        $cliente = $user->cliente;

        /*
        VALIDAR VEHÍCULO DEL CLIENTE
        */
        $vehiculo = Vehiculo::where('id', $request->vehiculo_id)
            ->where('cliente_id', $cliente->id)
            ->first();

        if (! $vehiculo) {
            return back()->with('error', 'El vehículo no pertenece al cliente.');
        }

        /*
        SERVICIO Y DURACIÓN
        */
        $servicio = servicio::findOrFail($request->servicio_id);
        $duracion = (int) $servicio->tiempo;

        $inicio = Carbon::parse($request->fecha_cita.' '.$request->hora_cita);
        $fin = $inicio->copy()->addMinutes($duracion);

        /*
        MECÁNICOS DISPONIBLES
        */
        $mecanicosDisponibles = mecanico::whereDoesntHave('citasMecanico.servicioCita', function ($query) use ($inicio, $fin) {
            $query->where('fecha_inicio', '<', $fin)
                ->where('fecha_final', '>', $inicio);
        })->get();

        if ($mecanicosDisponibles->isEmpty()) {
            return back()->with('error', 'No hay mecánicos disponibles en ese horario.');
        }

        $mecanico = $mecanicosDisponibles->random();

        /*
        ESTADO
        */
        $estado = Estado::where('nombre_estado', 'Agendada')->firstOrFail();

        /*
        CREAR CITA
        */

        $cita = Cita::create([
            'fecha_cita' => $request->fecha_cita,
            'hora_cita' => $request->hora_cita,
            'estado_id' => $estado->id,
            'vehiculo_id' => $vehiculo->id,
            'user_id' => $user->id,
        ]);

        /*
        CREAR SERVICIO_CITA
        */
        $servicioCita = Servicio_cita::create([
            'fecha_inicio' => $inicio,
            'fecha_final' => $fin,
            'servicio_id' => $servicio->id,
            'cita_id' => $cita->id,
        ]);

        /*
        ASIGNAR MECÁNICO
        */
        Cita_mecanico::create([
            'mecanico_id' => $mecanico->id,
            'servicio_cita_id' => $servicioCita->id,
        ]);

        return redirect()->route('cita.index')
            ->with('success', 'Cita agendada correctamente.');
    }

    /*
    CANCELAR (NO ELIMINA)
    */
    public function destroy(Cita $cita)
    {
        $estado = Estado::where('nombre_estado', 'Cancelada')->firstOrFail();

        $cita->estado_id = $estado->id;
        $cita->save();

        return back()->with('success', 'Cita cancelada.');
    }

    /*
    INICIAR CITA
    */
    public function iniciar($id)
    {
        $cita = Cita::findOrFail($id);

        $estado = Estado::where('nombre_estado', 'En curso')->firstOrFail();

        $cita->estado_id = $estado->id;
        $cita->save();

        return back()->with('success', 'Cita iniciada.');
    }

    /*
    COMPLETAR CITA
    */
    public function completar($id)
    {
        $cita = Cita::findOrFail($id);

        $estado = Estado::where('nombre_estado', 'Completada')->firstOrFail();

        $cita->estado_id = $estado->id;
        $cita->save();

        return back()->with('success', 'Cita completada.');
    }

    /*
    HORAS DISPONIBLES (AJAX)
    */
    public function horasDisponibles(Request $request)
    {
        $servicio = servicio::find($request->servicio_id);
        $duracion = (int) $servicio->tiempo;

        $fecha = $request->fecha;

        $horasDisponibles = [];

        for ($h = 8; $h <= 17; $h++) {

            $inicio = Carbon::parse($fecha.' '.str_pad($h, 2, '0', STR_PAD_LEFT).':00');
            $fin = $inicio->copy()->addMinutes($duracion);

            $hayDisponibles = mecanico::whereDoesntHave('citasMecanico.servicioCita', function ($q) use ($inicio, $fin) {
                $q->where('fecha_inicio', '<', $fin)
                    ->where('fecha_final', '>', $inicio);
            })->exists();

            if ($hayDisponibles) {
                $horasDisponibles[] = $inicio->format('H:i');
            }
        }

        return response()->json($horasDisponibles);
    }
}
