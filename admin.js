function showContent(tab) {
    var pedidosContent = document.getElementById('pedidos');
    var reservasContent = document.getElementById('reservas');
    var pedidosTab = document.querySelector('.tab.pedidos');
    var reservasTab = document.querySelector('.tab.reservas');

    if (tab === 'pedidos') {
        pedidosContent.style.display = 'block';
        reservasContent.style.display = 'none';
        pedidosTab.classList.add('active');
        reservasTab.classList.remove('active');
    } else if (tab === 'reservas') {
        pedidosContent.style.display = 'none';
        reservasContent.style.display = 'block';
        pedidosTab.classList.remove('active');
        reservasTab.classList.add('active');
    }
}

// Establecer el botón de pedidos como activo por defecto
document.addEventListener('DOMContentLoaded', function() {
    showContent('pedidos');
});
