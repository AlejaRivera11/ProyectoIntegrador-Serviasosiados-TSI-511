function seleccionarServicio(id, nombre, descripcion, tiempo) {
    document.getElementById('servicio_id').value        = id;
    document.getElementById('nombre').value    = nombre;
    document.getElementById('descripcion').value = descripcion;
    document.getElementById('tiempo').value    = tiempo;

    document.getElementById('form-servicio').action = '/servicio/' + id;
    document.getElementById('form-method').value    = 'PUT';
}

function submitRegistrarServicio() {
    document.getElementById('form-servicio').action = '/servicio';
    document.getElementById('form-method').value    = 'POST';
    document.getElementById('form-servicio').submit();
}

function submitActualizarServicio() {
    const id = document.getElementById('servicio_id').value;
    if (!id) {
        alert('Selecciona un servicio de la tabla primero.');
        return;
    }
    document.getElementById('form-servicio').action = '/servicio/' + id;
    document.getElementById('form-method').value    = 'PUT';
    document.getElementById('form-servicio').submit();
}

function limpiarFormularioServicio() {
    document.getElementById('form-servicio').reset();
    document.getElementById('servicio_id').value    = '';
    document.getElementById('form-servicio').action = '/servicio';
    document.getElementById('form-method').value    = 'POST';
}

document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-busqueda');
    if (input) {
        input.addEventListener('keyup', function() {
            const busqueda = input.value.toLowerCase();
            document.querySelectorAll('#tabla-servicios tr').forEach(fila => {
                fila.style.display = fila.textContent.toLowerCase().includes(busqueda) ? '' : 'none';
            });
        });
    }
});