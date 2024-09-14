<?php
session_start();

if (isset($_POST['pagar'])) {
    // Simulamos el proceso de pago
    $total = $_POST['total'];
    
    // Aquí podrías integrar una pasarela de pago real (como PayPal, Stripe, etc.)
    // Si el pago es exitoso, vaciamos el carrito
    unset($_SESSION['carrito']);

    // Redirigimos a una página de éxito
    header("Location: pago_exitoso.php?total=$total");
    exit();
} else {
    // Si no hay intento de pago, redirigimos de nuevo al carrito
    header("Location: carrito.php");
    exit();
}
?>

