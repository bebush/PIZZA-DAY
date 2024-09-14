document.addEventListener('DOMContentLoaded', () => {
    // Función para enviar la solicitud AJAX al backend
    function enviarSolicitud(accion, nombre, precio) {
        fetch('actualizar_carrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `accion=${accion}&nombre=${encodeURIComponent(nombre)}&precio=${precio}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            // Actualiza el carrito en la página
            location.reload(); // Recarga la página para actualizar el carrito
        });
    }

    // Evento para los botones "+"
    document.querySelectorAll('.mas').forEach(boton => {
        boton.addEventListener('click', () => {
            const nombre = boton.dataset.nombre;
            const precio = boton.dataset.precio;
            enviarSolicitud('agregar', nombre, precio);
        });
    });

    // Evento para los botones "-"
    document.querySelectorAll('.menos').forEach(boton => {
        boton.addEventListener('click', () => {
            const nombre = boton.dataset.nombre;
            const precio = boton.dataset.precio;
            enviarSolicitud('restar', nombre, precio);
        });
    });
});
