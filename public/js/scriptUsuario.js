// Mostrar/ocultar contraseña
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}

// Seleccionar usuario de la tabla
function seleccionarUsuario(id, documento, rol, estado) {
    document.getElementById('usuario_id').value  = id;
    document.getElementById('documento').value   = documento;
    document.getElementById('password').value    = password;
    document.getElementById('rol').value         = rol;
    document.getElementById('estado').value      = estado;

    document.getElementById('form-usuario').action = '/usuario/' + id;
    document.getElementById('form-method-usuario').value = 'PUT';
}

// Registrar usuario
function submitRegistrarUsuario() {
    document.getElementById('form-usuario').action = '/usuario';
    document.getElementById('form-method-usuario').value = 'POST';
    document.getElementById('form-usuario').submit();
}

// Actualizar usuario
function submitActualizarUsuario() {
    const id = document.getElementById('usuario_id').value;
    if (!id) {
        alert('Selecciona un usuario de la tabla primero.');
        return;
    }
    document.getElementById('form-usuario').action = '/usuario/' + id;
    document.getElementById('form-method-usuario').value = 'PUT';
    document.getElementById('form-usuario').submit();
}

// Limpiar formulario
function limpiarFormularioUsuario() {
    document.getElementById('form-usuario').reset();
    document.getElementById('usuario_id').value = '';
    document.getElementById('form-usuario').action = '/usuario';
    document.getElementById('form-method-usuario').value = 'POST';
}

// Buscar en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-busqueda-usuario');
    if (input) {
        input.addEventListener('keyup', function() {
            const busqueda = input.value.toLowerCase();
            document.querySelectorAll('#tabla-usuarios tr').forEach(fila => {
                fila.style.display = fila.textContent.toLowerCase().includes(busqueda) ? '' : 'none';
            });
        });
    }
});