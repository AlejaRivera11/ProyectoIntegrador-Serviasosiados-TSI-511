@extends('layouts.plantilla')

@section('titulomain', 'Citas Programadas')

@section('contenido')

    <div class="card">

        <div class="buscador">
            <input type="text" id="input-busqueda" placeholder="Buscar por placa o documento..." class="input-buscador">
        </div>

    </div>

    <div class="card">
        <div class="table-wrap">
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
                        <th>Mecánico</th>
                        <th>Agendado por</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody id="tabla-citas">
                    @forelse($citas as $cita)
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
                                @php $user = $cita->user; @endphp

                                @if ($user && $user->cliente)
                                    {{ $user->cliente->nombre_cliente }}
                                @elseif($user)
                                    {{ $user->getRoleNames()->first() }}
                                @else
                                    —
                                @endif
                            </td>

                            <td>
                                @php
                                    $estadoClase = strtolower(
                                        str_replace(' ', '-', $cita->estado->nombre_estado ?? 'default'),
                                    );
                                @endphp
                                <select class="estado-select estado-{{ $estadoClase }}" id="estado_{{ $cita->id }}">
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->id }}"
                                            {{ $cita->estado_id == $estado->id ? 'selected' : '' }}>
                                            {{ $estado->nombre_estado }}
                                        </option>
                                    @endforeach
                                </select>

                                <button class="btn-guardar" onclick="actualizarEstado({{ $cita->id }})">
                                    Guardar
                                </button>
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" style="text-align:center;padding:20px;color:#888;">
                                No hay citas programadas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="paginacion">
            {{ $citas->links('vendor.pagination.default') }}
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/scriptCita.js') }}"></script>
@endpush
