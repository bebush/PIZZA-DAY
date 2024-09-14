<?php
session_start();

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Recibir datos POST
$accion = $_POST['accion'];
$nombre = $_POST['nombre'];
$precio = (float) $_POST['precio']; // Asegurarnos de que el precio es float

// Función para agregar producto
function agregarProducto($nombre, $precio) {
    if (isset($_SESSION['carrito'][$nombre])) {
        $_SESSION['carrito'][$nombre]['cantidad'] += 1;
    } else {
        $_SESSION['carrito'][$nombre] = [
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => 1
        ];
    }
}

// Función para restar producto
function restarProducto($nombre) {
    if (isset($_SESSION['carrito'][$nombre])) {
        if ($_SESSION['carrito'][$nombre]['cantidad'] > 1) {
            $_SESSION['carrito'][$nombre]['cantidad'] -= 1;
        } else {
            unset($_SESSION['carrito'][$nombre]); // Eliminar si la cantidad es 0
        }
    }
}

// Lógica para agregar o restar productos
if ($accion === 'agregar') {
    agregarProducto($nombre, $precio);
} elseif ($accion === 'restar') {
    restarProducto($nombre);
}

// Opcional: Imprimir el contenido del carrito para depurar
echo json_encode($_SESSION['carrito']);
?>
