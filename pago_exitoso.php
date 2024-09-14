<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
</head>
<body>
    <h1>¡Gracias por tu compra!</h1>
    <p>Tu pago por un total de $<?php echo htmlspecialchars($_GET['total']); ?> ha sido procesado con éxito.</p>
    <a href="index.php">Volver a la tienda</a>
</body>
</html>
