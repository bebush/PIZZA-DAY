<?php
session_start();
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleCarrito.css">
    <title>Carrito</title>
    <script src="carrito.js" defer></script>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <div class="contenedor-carrito">
        <?php if (!empty($carrito)): ?>
        <ul>
            <?php foreach ($carrito as $key => $item): ?>
            <li>
                <?php echo $item['nombre']; ?> - 
                <?php echo $item['cantidad']; ?> x $<?php echo $item['precio']; ?> = $<?php echo $item['cantidad'] * $item['precio']; ?>
               
            </li>
            <?php endforeach; ?>
        </ul>
        <p>Total: $
            <?php
            $total = 0;
            foreach ($carrito as $item) {
                $total += $item['cantidad'] * $item['precio'];
            }
            echo $total;
            ?>
        </p>

        <!-- Formulario para realizar el pago -->
        <form action="procesar_pago.php" method="post">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button type="submit" name="pagar" onclick="return confirm('¿Estás seguro de que quieres realizar el pago?');">Pagar</button>
        </form>

        <!-- Formulario para limpiar el carrito -->
        <form action="limpiar_carrito.php" method="post">
            <button type="submit" name="limpiar" onclick="return confirm('¿Estás seguro de que quieres limpiar el carrito?');">Limpiar carrito</button>
        </form>

        <?php else: ?>
        <p>Tu carrito está vacío.</p>
        <?php endif; ?>
    </div>
</body>
</html>
