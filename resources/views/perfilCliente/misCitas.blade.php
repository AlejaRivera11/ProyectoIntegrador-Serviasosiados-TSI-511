@extends('layouts.plantilla')

@section('titulomain', 'Mis Citas')

@section('contenido')

    <div class="info-box">
        <p><strong>ℹ Información importante</strong></p>
        <p>
            Puedes cancelar tu cita únicamente si faltan más de <b>24 horas</b> para su programación.
            Si el tiempo ya es menor, no será posible realizar cambios.
        </p>
        <p>
            Para casos urgentes, comunícate con nuestro soporte:
            <b>+57 XXX XXX XXXX</b>
        </p>
    </div>

    <div class="card">


        <div class="table-wrap">
            <table>

                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Placa</th>
                        <th>Servicio</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($citas as $cita)

                        <tr>

                            <td>{{ $cita->fecha_cita }}</td>
                            <td>{{ $cita->hora_cita }}</td>
                            <td>{{ $cita->vehiculo->placa ?? '—' }}</td>
                            <td>{{ $cita->servicioCita->servicio->nombre ?? '—' }}</td>
                            <td>@php
                                $estado = strtolower(str_replace(' ', '-', $cita->estado->nombre_estado ?? ''));
                            @endphp

                                <span class="badge estado-{{ $estado }}">
                                    {{ $cita->estado->nombre_estado }}
                                </span>
                            </td>

                            <td>

                                @if ($cita->estado->nombre_estado == 'Agendada')
                                    @php
                                        $fechaCita = \Carbon\Carbon::parse($cita->fecha_cita . ' ' . $cita->hora_cita);
                                    @endphp

                                    @if (now()->diffInHours($fechaCita, false) >= 48)
                                        <form method="POST"
                                            action="{{ route('perfilCliente.misCitas.cancelar', $cita->id) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="btn-cancelar">
                                                Cancelar
                                            </button>

                                        </form>
                                    @else
                                        <span class="badge badge-danger">
                                            Cancelación no disponible
                                        </span>
                                    @endif
                                @else
                                    <span class="badge badge-muted">
                                        -
                                    </span>
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">No tienes citas registradas</td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

@endsection
