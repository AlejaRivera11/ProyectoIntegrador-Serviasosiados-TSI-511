// Seleccionar cliente de la tabla y llenar el formulario
function seleccionarCliente(id, tipo, doc, nombre, tel, correo, dir) {
    document.getElementById('cliente_id').value = id;
    document.getElementById('tipo_documento').value = tipo;
    document.getElementById('documento').value = doc;
    document.getElementById('nombre_cliente').value = nombre;
    document.getElementById('telefono_cliente').value = tel;
    document.getElementById('correo_cliente').value = correo;
    document.getElementById('direccion_cliente').value = dir;

    // Cambiar el action del formulario para actualizar
    document.getElementById('form-cliente').action = '/cliente/' + id;
    document.getElementById('form-method').value   = 'PUT';
}

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


    // Cambiar el action del formulario para actualizar
    document.getElementById('form-vehiculo').action = '/vehiculo/' + id;
    document.getElementById('form-method').value   = 'PUT';
}

// Registrar nuevo cliente
function submitRegistrar() {
    document.getElementById('form-cliente').action = '/cliente';
    document.getElementById('form-method').value   = 'POST';
    document.getElementById('form-cliente').submit();
}

// Registrar nuevo vehiculo
function submitRegistrarVehiculo() {
    document.getElementById('form-vehiculo').action = '/vehiculo';
    document.getElementById('form-method').value   = 'POST';
    document.getElementById('form-vehiculo').submit();
}

// Actualizar cliente seleccionado
function submitActualizar() {
    const id = document.getElementById('cliente_id').value;
    if (!id) {
        alert('Selecciona un cliente de la tabla primero.');
        return;
    }
    document.getElementById('form-cliente').action = '/cliente/' + id;
    document.getElementById('form-method').value   = 'PUT';
    document.getElementById('form-cliente').submit();
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

// Limpiar formulario
function limpiarFormulario() {
    document.getElementById('form-cliente').reset();
    document.getElementById('cliente_id').value  = '';
    document.getElementById('form-cliente').action = '/cliente';
    document.getElementById('form-method').value = 'POST';
}

// Limpiar formulario de vehiculo
function limpiarFormularioVehiculo() {
    document.getElementById('form-vehiculo').reset();
    document.getElementById('vehiculo_id').value  = '';
    document.getElementById('form-vehiculo').action = '/vehiculo';
    document.getElementById('form-method').value = 'POST';
}

// Buscar cliente
function buscarCliente() {
    const busqueda = document.getElementById('input-busqueda').value.toLowerCase();
    const filas    = document.querySelectorAll('#tabla-clientes tr');

    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(busqueda) ? '' : 'none';
    });
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

// Buscar en tiempo real mientras escribe (solo para clientes por ahora)
document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('input-busqueda');
    if (inputBusqueda) {
        inputBusqueda.addEventListener('keyup', buscarCliente);
    }
});

// Buscar en tiempo real mientras escribe (solo para vehiculos por ahora)
document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('input-busqueda');
    if (inputBusqueda) {
        inputBusqueda.addEventListener('keyup', buscarVehiculo);
    }
});