// seleccionar vehiculo de la tabla y llenar el formulario
function seleccionarMiVehiculo(id,placa, marca, referencia, modelo, color, kilometraje) {
    document.getElementById('vehiculo_id').value  = id;
    document.getElementById('placa').value       = placa;
    document.getElementById('marca').value       = marca;
    document.getElementById('referencia').value   = referencia;
    document.getElementById('modelo').value      = modelo;
    document.getElementById('color').value       = color;
    document.getElementById('kilometraje').value   = kilometraje;

    document.getElementById('form-vehiculo').action = '/misVehiculos/' + id;
    document.getElementById('form-method').value   = 'PUT';

}

// Registrar nuevo vehiculo
function submitRegistrarMiVehiculo() {
    document.getElementById('form-vehiculo').action = '/misVehiculos';
    document.getElementById('form-method').value   = 'POST';
    document.getElementById('form-vehiculo').submit();
}

// Actualizar vehiculo seleccionado
function submitActualizarMiVehiculo() {
    const id = document.getElementById('vehiculo_id').value;
    if (!id) {
        alert('Selecciona un vehículo de la tabla primero.');
        return;
    }
    document.getElementById('form-vehiculo').action = '/misVehiculos/' + id;
    document.getElementById('form-method').value   = 'PUT';
    document.getElementById('form-vehiculo').submit();
}

// Limpiar formulario de vehiculo
function limpiarFormularioVehiculo() {
    document.getElementById('form-vehiculo').reset();
    document.getElementById('vehiculo_id').value  = '';
    document.getElementById('form-vehiculo').action = '/misVehiculos';
    document.getElementById('form-method').value = 'POST';
}
