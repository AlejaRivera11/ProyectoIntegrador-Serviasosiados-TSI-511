@extends('layouts.plantilla')

@section('titulomain', 'Agendar Cita')

@section('contenido')

    <div class="card">

        {{-- BOTONES --}}
        <div class="form-actions">
            <button class="btn btn-refresh" onclick="limpiarFormulario()" title="Limpiar">↺</button>

            <button class="btn btn-primary" onclick="document.getElementById('form-cita').submit()">
                <i class="fa-solid fa-calendar-plus"></i> Agendar
            </button>
        </div>

        {{-- FORMULARIO --}}
        <form id="form-cita" method="POST" action="{{ route('cita.store') }}">
            @csrf

            <div class="form-grid">

                {{-- VEHÍCULO --}}
                <div class="form-group">
                    <label>Placa</label>
                    <select name="vehiculo_id" id="vehiculo_id" required>
                        <option value="">Seleccionar</option>
                        @foreach ($vehiculos as $vehiculo)
                            <option value="{{ $vehiculo->id }}">
                                {{ $vehiculo->placa }} - {{ $vehiculo->marca }} - {{ $vehiculo->referencia }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SERVICIO --}}
                <div class="form-group">
                    <label>Servicio</label>
                    <select name="servicio_id" id="servicio" required>
                        <option value="">Seleccionar</option>
                        @foreach ($servicios as $servicio)
                            <option value="{{ $servicio->id }}">
                                {{ $servicio->nombre }} ({{ $servicio->tiempo }} min)
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FECHA --}}
                <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" name="fecha_cita" id="fecha" required>
                </div>

                {{-- HORA --}}

                <div class="form-group">
                    <label>Hora</label>
                    <select name="hora_cita" required>
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

@endsection

@push('scripts')
    <script>
        document.getElementById('fecha').addEventListener('change', cargarHoras);
        document.getElementById('servicio').addEventListener('change', cargarHoras);

        function cargarHoras() {

            let fecha = document.getElementById('fecha').value;
            let servicio = document.getElementById('servicio').value;

            if (!fecha || !servicio) return;

            fetch(`/horas-disponibles?fecha=${fecha}&servicio_id=${servicio}`)
                .then(res => res.json())
                .then(data => {

                    let select = document.getElementById('hora');
                    select.innerHTML = '<option value="">Seleccionar</option>';

                    if (data.length === 0) {
                        select.innerHTML = '<option value="">No hay disponibilidad</option>';
                        return;
                    }

                    data.forEach(hora => {
                        select.innerHTML += `<option value="${hora}">${hora}</option>`;
                    });

                });
        }

        function limpiarFormulario() {
            document.getElementById('form-cita').reset();

            let selectHora = document.getElementById('hora');
            selectHora.innerHTML = '<option value="">Seleccione fecha y servicio</option>';
        }
    </script>
@endpush
