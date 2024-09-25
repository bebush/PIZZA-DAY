document.addEventListener('DOMContentLoaded', () => {
    // Recupera la posición de desplazamiento almacenada
    const scrollPos = sessionStorage.getItem('scrollPos');
    if (scrollPos) {
        window.scrollTo(0, parseInt(scrollPos, 10));
        sessionStorage.removeItem('scrollPos'); // Limpia la posición después de usarla
    }

    // Función para enviar la solicitud AJAX al backend
    function enviarSolicitud(accion, nombre, precio) {
        // Guarda la posición actual de desplazamiento
        sessionStorage.setItem('scrollPos', window.scrollY);

        fetch('actualizar_carrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `accion=${accion}&nombre=${encodeURIComponent(nombre)}&precio=${precio}`
        })
        .then(response => response.json())
        .then(data => {
            // Actualiza el contador en la página
            const contador = document.querySelector(`.contador[data-nombre="${nombre}"]`);
            if (contador) {
                contador.textContent = data[nombre] ? data[nombre].cantidad : 0; // Actualiza la cantidad
            }

            // Actualiza el listado de items en el menú desplegable
            actualizarCarrito(data);
        })
        .catch(error => console.error('Error:', error));
    }

    // Evento para los botones "+"
    document.querySelectorAll('.mas').forEach(boton => {
        boton.addEventListener('click', (event) => {
            event.preventDefault(); // Previene el comportamiento predeterminado
            const nombre = boton.dataset.nombre;
            const precio = boton.dataset.precio;
            enviarSolicitud('agregar', nombre, precio);
        });
    });

    // Evento para los botones "-"
    document.querySelectorAll('.menos').forEach(boton => {
        boton.addEventListener('click', (event) => {
            event.preventDefault(); // Previene el comportamiento predeterminado
            const nombre = boton.dataset.nombre;
            const precio = boton.dataset.precio;
            enviarSolicitud('restar', nombre, precio);
        });
    });

    // Función para obtener el carrito actualizado
    function obtenerCarritoActualizado() {
        fetch('actualizar_carrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'accion=obtener' // Nueva acción para obtener el carrito
        })
        .then(response => response.json())
        .then(data => {
            // Actualiza el listado de items en el menú desplegable
            actualizarCarrito(data);
        })
        .catch(error => console.error('Error:', error));
    }

    // Llama a la función cada 1 segundos (1000 ms) para mantener el carrito actualizado
    setInterval(obtenerCarritoActualizado, 1000);
});

// Función para actualizar el carrito visualmente
function actualizarCarrito(carrito) {
    const contenedorCarrito = document.querySelector('.contenedor-carrito');
    contenedorCarrito.innerHTML = ''; // Limpia el contenedor del carrito

    if (Object.keys(carrito).length > 0) {
        let total = 0;
        const ul = document.createElement('ul');

        for (const key in carrito) {
            const item = carrito[key];
            const li = document.createElement('li');
            li.setAttribute('data-nombre', key);
            li.innerHTML = `${item.nombre} - <span class="cantidad">${item.cantidad}</span> x $${item.precio} = $${(item.cantidad * item.precio).toFixed(2)}`;
            ul.appendChild(li);
            total += item.cantidad * item.precio;
        }

        contenedorCarrito.appendChild(ul);
        const totalP = document.createElement('p');
        totalP.className = 'total-carrito';
        totalP.innerHTML = `Total: $${total.toFixed(2)}`;
        contenedorCarrito.appendChild(totalP);
    } else {
        contenedorCarrito.innerHTML = '<p>Tu carrito está vacío.</p>';
    }
}
