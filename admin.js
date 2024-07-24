function showContent(tab) {
    var pedidosContent = document.getElementById('pedidos');
    var reservasContent = document.getElementById('reservas');

    if (tab === 'pedidos') {
        pedidosContent.style.display = 'block';
        reservasContent.style.display = 'none';
    } else if (tab === 'reservas') {
        pedidosContent.style.display = 'none';
        reservasContent.style.display = 'block';
    }
}
