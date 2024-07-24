let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

function agregarAlCarrito(nombre, precio) {
    const producto = { nombre, precio };
    carrito.push(producto);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    actualizarContadorCarrito();
    mostrarCarrito();
}

function mostrarCarrito() {
    const carritoDiv = document.getElementById('carrito');
    if (!carritoDiv) return; // Si no estamos en la página del carrito, no hacemos nada.
    carritoDiv.innerHTML = '';
    let total = 0;

    carrito.forEach((producto, index) => {
        carritoDiv.innerHTML += `<p>${producto.nombre} - $${producto.precio.toFixed(2)} 
        <button onclick="eliminarDelCarrito(${index})">Eliminar</button></p>`;
        total += producto.precio;
    });

    carritoDiv.innerHTML += `<p>Total: $${total.toFixed(2)}</p>`;
}

function eliminarDelCarrito(index) {
    carrito.splice(index, 1);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    actualizarContadorCarrito();
    mostrarCarrito();
}

function actualizarContadorCarrito() {
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
        cartCount.textContent = carrito.length;
    }
}

window.onload = () => {
    actualizarContadorCarrito();
    mostrarCarrito();
};
