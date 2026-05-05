// Menú hamburguesa
document.addEventListener('DOMContentLoaded', function() {
    const toggle  = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('slidebar') ?? document.querySelector('.sidebar');
    const overlay = document.getElementById('overlay');

    if (toggle) {
        toggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    }
});

// ------------------- Para los reportes --------------------//

function switchTab(tab, el) {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('panel-' + tab).classList.add('active');
        }

        ['citas', 'servicios', 'mecanicos'].forEach(panel => {
            const input = document.getElementById('busqueda-' + panel);
            if (input) {
                input.addEventListener('keyup', function() {
                    const busqueda = input.value.toLowerCase();
                    document.querySelectorAll('#tabla-reporte-' + panel + ' tr').forEach(fila => {
                        fila.style.display = fila.textContent.toLowerCase().includes(busqueda) ?
                            '' : 'none';
                    });
                });
            }
        });