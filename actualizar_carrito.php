<?php
session_start();

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Recibir datos POST
$accion = $_POST['accion'] ?? null; // Evita errores si no se define

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
    $nombre = $_POST['nombre'] ?? '';
    $precio = (float) ($_POST['precio'] ?? 0); // Asegurarnos de que el precio es float
    
    if ($nombre && $precio > 0) { // Validación
        agregarProducto($nombre, $precio);
    } else {
        echo json_encode(['error' => 'Nombre o precio inválido.']);
        exit;
    }
} elseif ($accion === 'restar') {
    $nombre = $_POST['nombre'] ?? '';
    
    if ($nombre) { // Validación
        restarProducto($nombre);
    } else {
        echo json_encode(['error' => 'Nombre inválido.']);
        exit;
    }
} elseif ($accion === 'obtener') {
    // Retorna el carrito actualizado sin hacer cambios
    echo json_encode($_SESSION['carrito']);
    exit;
}

// Retorna el carrito actualizado
echo json_encode($_SESSION['carrito']);
?>
