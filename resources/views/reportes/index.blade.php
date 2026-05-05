@extends('layouts.plantilla')

@section('titulomain', 'Reportes')

@section('contenido')

    <div class="card">
        <div class="tabs">
            <div class="tab active" onclick="switchTab('citas', this)">
                <i class="fas fa-calendar-check"></i> Citas
            </div>
            <div class="tab" onclick="switchTab('servicios', this)">
                <i class="fas fa-wrench"></i> Servicios
            </div>
            <div class="tab" onclick="switchTab('mecanicos', this)">
                <i class="fas fa-user-cog"></i> Mecanicos
            </div>
        </div>
    </div>

    {{-- PANEL CITAS --}}
    <div class="panel active" id="panel-citas">

        <form method="GET" action="{{ route('reportes.index') }}">

            <div class="card">
                <div class="form-grid" style="margin-bottom:16px;">

                    <div class="form-group">
                        <label>Fecha inicio</label>
                        <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
                    </div>

                    <div class="form-group">
                        <label>Fecha fin</label>
                        <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}">
                    </div>

                    <div class="form-group">
                        <label>Estado</label>
                        <select name="estado">
                            <option value="">Todos</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->nombre_estado }}"
                                    {{ request('estado') == $estado->nombre_estado ? 'selected' : '' }}>
                                    {{ $estado->nombre_estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-actions">

                    <div class="buscador">
                        <input type="text" name="buscar" value="{{ request('buscar') }}"
                            placeholder="Buscar por placa o documento..." class="input-buscador">

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>

                        <a href="{{ route('reportes.index') }}" class="btn btn-warning">
                            Limpiar
                        </a>

                        <a href="{{ route('pdf.citas', request()->query()) }}" target="_blank" class="btn btn-secondary">
                            <i class="fas fa-file-pdf"></i> Exportar PDF
                        </a>
                    </div>
                </div>
            </div>

        </form>

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
                            <th>Mecanico</th>
                            <th>Agendado por</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody id="tabla-reporte-citas">
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
                                    @if ($cita->user && $cita->user->cliente)
                                        {{ $cita->user->cliente->nombre_cliente }}
                                    @elseif($cita->user)
                                        {{ $cita->user->getRoleNames()->first() }}
                                    @else
                                        —
                                    @endif
                                </td>

                                <td>
                                    <span
                                        class="badge badge-{{ strtolower(str_replace(' ', '-', $cita->estado->nombre_estado ?? '')) }}">
                                        {{ $cita->estado->nombre_estado ?? '—' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="text-align:center;padding:20px;color:#888;">
                                    No hay citas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="paginacion">
                {{ $citas->appends(request()->query())->links('vendor.pagination.default') }}
            </div>
        </div>

    </div>

    {{-- PANEL SERVICIOS --}}
    <div class="panel" id="panel-servicios">
        <div class="card">
            <div class="form-actions">
                <div class="buscador">
                    <input type="text" id="busqueda-servicios" placeholder="Buscar servicio..." class="input-buscador">
                    <a href="{{ route('pdf.servicios') }}" target="_blank" class="btn btn-secondary">
                        <i class="fas fa-file-pdf"></i> Exportar PDF
                    </a>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Descripcion</th>
                            <th>Tiempo</th>
                            <th>Total citas</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-reporte-servicios">
                        @forelse($servicios as $servicio)
                            <tr>
                                <td>{{ $servicio->nombre }}</td>
                                <td>{{ $servicio->descripcion }}</td>
                                <td>{{ $servicio->tiempo }} Hora</td>
                                <td>{{ $servicio->total_citas }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;padding:20px;color:#888;">
                                    No hay servicios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--  PANEL MECANICOS  --}}
    <div class="panel" id="panel-mecanicos">
        <div class="card">
            <div class="form-actions">
                <div class="buscador">
                    <input type="text" id="busqueda-mecanicos" placeholder="Buscar mecanico..." class="input-buscador">
                    <a href="{{ route('pdf.mecanicos') }}" target="_blank" class="btn btn-secondary">
                        <i class="fas fa-file-pdf"></i> Exportar PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Mecanico</th>
                            <th>Documento</th>
                            <th>Telefono</th>
                            <th>Agendadas</th>
                            <th>En curso</th>
                            <th>Completadas</th>
                            <th>Canceladas</th>
                            <th>Total citas</th>

                        </tr>
                    </thead>
                    <tbody id="tabla-reporte-mecanicos">
                        @forelse($mecanicos as $mecanico)
                            <tr>
                                <td>{{ $mecanico->nombre_mecanico }}</td>
                                <td>{{ $mecanico->documento_mecanico }}</td>
                                <td>{{ $mecanico->telefono_mecanico }}</td>
                                <td>{{ $mecanico->agendadas }}</td>
                                <td>{{ $mecanico->en_curso }}</td>
                                <td>{{ $mecanico->completadas }}</td>
                                <td>{{ $mecanico->canceladas }}</td>
                                <td>{{ $mecanico->total_citas }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;padding:20px;color:#888;">
                                    No hay mecanicos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
