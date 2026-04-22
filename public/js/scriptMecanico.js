
// Seleccionar Mecanico de la tabla y llenar el formulario
function seleccionarMecanico(id, tipo, doc, nombre, tel, dir) {
    document.getElementById('mecanico_id').value = id;
    document.getElementById('tipo_documento').value = tipo;
    document.getElementById('documento_mecanico').value = doc;
    document.getElementById('nombre_mecanico').value = nombre;
    document.getElementById('telefono_mecanico').value = tel;
    document.getElementById('direccion_mecanico').value = dir;

    document.getElementById('form-mecanico').action = '/mecanico/' + id;
    document.getElementById('form-method').value   = 'PUT';
}


// Registrar nuevo Mecanico
function submitRegistrarMecanico() {
    document.getElementById('form-mecanico').action = '/mecanico';
    document.getElementById('form-method').value   = 'POST';
    document.getElementById('form-mecanico').submit();
}


// Actualizar mecanico seleccionado
function submitActualizarMecanico() {
    const id = document.getElementById('mecanico_id').value;
    if (!id) {
        alert('Selecciona un mecanico de la tabla primero.');
        return;
    }
    document.getElementById('form-mecanico').action = '/mecanico/' + id;
    document.getElementById('form-method').value   = 'PUT';
    document.getElementById('form-mecanico').submit();
}


// Limpiar formulario Mecanico
function limpiarFormulario() {
    document.getElementById('form-mecanico').reset();
    document.getElementById('mecanico_id').value  = '';
    document.getElementById('form-mecanico').action = '/mecanico';
    document.getElementById('form-method').value = 'POST';
}


// Buscar Mecanico
function buscarMecanico() {
    const busqueda = document.getElementById('input-busqueda').value.toLowerCase();
    const filas    = document.querySelectorAll('#tabla-mecanicos tr');

    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(busqueda) ? '' : 'none';
    });
}

// Buscar en tiempo real mientras escribe (Mecanico)
document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('input-busqueda');
    if (inputBusqueda) {
        inputBusqueda.addEventListener('keyup', buscarMecanico);
    }
});