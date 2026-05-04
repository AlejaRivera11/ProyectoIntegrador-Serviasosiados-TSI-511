@extends('layouts.plantilla')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cita.css') }}">
@endpush

@section('titulomain', 'Agendar Cita')

@section('contenido')

    <main class="main-content">
        <div class="cita-card">

            @if (session('error'))
                <div class="cita-alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="cita-actions">
                <button class="cita-btn cita-btn-refresh" onclick="limpiarFormulario()" title="Limpiar">↺</button>

                <button class="cita-btn cita-btn-primary" onclick="document.getElementById('form-cita').submit()">
                    <i class="fa-solid fa-calendar-plus"></i> Agendar
                </button>
            </div>

            <form id="form-cita" method="POST" action="{{ route('cita.store') }}">
                @csrf

                <div class="cita-grid">

                    <div class="cita-group">
                        <label>Vehiculo</label>
                        <select name="vehiculo_id" id="vehiculo_id" required>
                            <option value="">Seleccionar</option>
                            @foreach ($vehiculos as $vehiculo)
                                <option value="{{ $vehiculo->id }}">
                                    {{ $vehiculo->placa }} - {{ $vehiculo->marca }} - {{ $vehiculo->referencia }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="cita-group">
                        <label>Servicio</label>
                        <select name="servicio_id" id="servicio" required>
                            <option value="">Seleccionar</option>
                            @foreach ($servicios as $servicio)
                                <option value="{{ $servicio->id }}">
                                    {{ $servicio->nombre }} ({{ $servicio->tiempo }} hora)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="cita-group">
                        <label>Fecha</label>
                        <input type="date" name="fecha_cita" id="fecha" required>
                    </div>

                    <div class="cita-group">
                        <label>Hora</label>
                        <select name="hora_cita" id="hora" required>
                            <option value="">Seleccionar</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                        </select>
                    </div>

                </div>
            </form>

        </div>
    </main>

@endsection

@push('scripts')
    <script src="{{ asset('js/scriptCita.js') }}"></script>
@endpush
