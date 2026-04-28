// seleccionar vehiculo de la tabla y llenar el formulario
function seleccionarVehiculo(id, placa, marca, modelo, referencia, color, kilometraje, cliente_id) {
    document.getElementById('vehiculo_id').value = id;
    document.getElementById('placa').value       = placa;
    document.getElementById('marca').value       = marca;
    document.getElementById('referencia').value   = referencia;
    document.getElementById('modelo').value      = modelo;
    document.getElementById('color').value       = color;
    document.getElementById('kilometraje').value   = kilometraje;
    document.getElementById('cliente_id').value  = cliente_id;

    document.getElementById('form-vehiculo').action = '/vehiculo/' + id;
    document.getElementById('form-method').value   = 'PUT';

}

// Registrar nuevo vehiculo
function submitRegistrarVehiculo() {
    document.getElementById('form-vehiculo').action = '/vehiculo';
    document.getElementById('form-method').value   = 'POST';
    document.getElementById('form-vehiculo').submit();
}

// Actualizar vehiculo seleccionado
function submitActualizarVehiculo() {
    const id = document.getElementById('vehiculo_id').value;
    if (!id) {
        alert('Selecciona un vehículo de la tabla primero.');
        return;
    }
    document.getElementById('form-vehiculo').action = '/vehiculo/' + id;
    document.getElementById('form-method').value   = 'PUT';
    document.getElementById('form-vehiculo').submit();
}

// Limpiar formulario de vehiculo
function limpiarFormularioVehiculo() {
    document.getElementById('form-vehiculo').reset();
    document.getElementById('vehiculo_id').value  = '';
    document.getElementById('form-vehiculo').action = '/vehiculo';
    document.getElementById('form-method').value = 'POST';
}

// Buscar vehiculo
function buscarVehiculo() {
    const busqueda = document.getElementById('input-busqueda').value.toLowerCase();
    const filas    = document.querySelectorAll('#tabla-vehiculos tr');

    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(busqueda) ? '' : 'none';
    });
}

// Buscar en tiempo real mientras escribe (vehiculos)
document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('input-busqueda');
    if (inputBusqueda) {
        inputBusqueda.addEventListener('keyup', buscarVehiculo);
    }
});

//