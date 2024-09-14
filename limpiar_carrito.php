<?php
session_start();

// Vaciar el carrito
$_SESSION['carrito'] = [];

// Redirigir al carrito después de limpiar
header("Location: carrito.php");
exit();
?>