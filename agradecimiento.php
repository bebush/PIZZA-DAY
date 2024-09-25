<?php
session_start();

// Verificar si el carrito ha sido limpiado, lo que indica que se realizó un pedido
if (!isset($_SESSION['nombre']) || !isset($_SESSION['total'])) {
    // Puedes redirigir a la página de inicio si no hay un carrito activo
    header("Location: index.php");
    exit();
}

// Recuperar datos del pedido
$nombre = htmlspecialchars($_SESSION['nombre']); // Nombre del cliente
$total = htmlspecialchars($_SESSION['total']); // Total del pedido
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleAgradecimiento.css">
    <title>Agradecimiento</title>
</head>
<body>
    <div class="agradecimiento-container">
        <h1>¡Gracias por tu pedido, <?php echo $nombre; ?>!</h1>
        <p>Hemos recibido tu pedido y lo estamos procesando.</p>
        <p>Total a pagar: <strong>$<?php echo $total; ?></strong></p>
        
        <h2>Detalles del pedido:</h2>
        <p>Recibirás un correo de confirmación en breve con los detalles de tu pedido.</p>
        
        <a href="index.php" class="boton">Volver a la tienda</a>
    </div>
</body>
</html>
