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