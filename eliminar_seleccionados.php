<?php
session_start();

// Verificar si se enviaron productos para eliminar
if (isset($_POST['productos'])) {
    $productos_a_eliminar = $_POST['productos'];
    
    // Obtener el carrito actual
    $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

    // Eliminar los productos seleccionados
    foreach ($productos_a_eliminar as $key) {
        unset($carrito[$key]);
    }

    // Actualizar el carrito en la sesión
    $_SESSION['carrito'] = $carrito;
}

// Redirigir al carrito después de eliminar los productos
header("Location: carrito.php");
exit();
