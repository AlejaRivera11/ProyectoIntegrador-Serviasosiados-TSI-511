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


//-----------------------------Para citas programadas----------------------------------------//

function actualizarEstado(id) {

    const estado = document.getElementById('estado_' + id).value;

    fetch(`/cita/${id}/estado`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            estado_id: estado
        })
    })
    .then(response => {

        if (!response.ok) {
            throw new Error('Error en el servidor');
        }

        return response.json();
    })
    .then(data => {

        alert('Estado actualizado correctamente');
        window.location.href = window.location.href;

    })
    .catch(error => {
        console.error(error);
        alert('No se pudo actualizar el estado');
    });
}