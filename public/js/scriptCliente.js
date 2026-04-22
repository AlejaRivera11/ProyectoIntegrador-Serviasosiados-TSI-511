// Seleccionar cliente de la tabla y llenar el formulario
function seleccionarCliente(id, tipo, doc, nombre, tel, correo, dir) {
    document.getElementById('cliente_id').value = id;
    document.getElementById('tipo_documento').value = tipo;
    document.getElementById('documento').value = doc;
    document.getElementById('nombre_cliente').value = nombre;
    document.getElementById('telefono_cliente').value = tel;
    document.getElementById('correo_cliente').value = correo;
    document.getElementById('direccion_cliente').value = dir;

    document.getElementById('form-cliente').action = '/cliente/' + id;
    document.getElementById('form-method').value   = 'PUT';
}


// Registrar nuevo cliente
function submitRegistrar() {
    document.getElementById('form-cliente').action = '/cliente';
    document.getElementById('form-method').value   = 'POST';
    document.getElementById('form-cliente').submit();
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


// Limpiar formulario Cliente
function limpiarFormulario() {
    document.getElementById('form-cliente').reset();
    document.getElementById('cliente_id').value  = '';
    document.getElementById('form-cliente').action = '/cliente';
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


// Buscar en tiempo real mientras escribe (clientes)
document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('input-busqueda');
    if (inputBusqueda) {
        inputBusqueda.addEventListener('keyup', buscarCliente);
    }
});
