<?php
include 'conexion.php';
session_start();

// Obtener el carrito de la sesión
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

// Calcular el total
$total = 0;
foreach ($carrito as $item) {
    $total += $item['cantidad'] * $item['precio'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="stylepago.css">
    <title>Pago - Pizza Day</title>
</head>
<body>
    <div class="logo">Logo</div>
    <h2>Resumen de tu compra</h2>
    <div class="contenedor-carrito">
        <?php if (!empty($carrito)): ?>
            <ul>
                <?php foreach ($carrito as $nombre => $item): ?>
                    <li><?php echo htmlspecialchars($nombre); ?> - <?php echo $item['cantidad']; ?> x $<?php echo $item['precio']; ?> = $<?php echo ($item['cantidad'] * $item['precio']); ?></li>
                <?php endforeach; ?>
            </ul>
            <p class="total">Total: $<?php echo $total; ?></p>
        <?php else: ?>
            <p>Tu carrito está vacío.</p>
        <?php endif; ?>
    </div>

    <form action="guardar_pedido.php" method="post">
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="celular">Celular:</label>
        <input type="text" id="celular" name="celular" required>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>

        
        <label for="metodo_entrega">Método de entrega:</label>
        <select id="metodo_entrega" name="metodo_entrega" required>
            <option value="local">Retirar en el local</option>
            <option value="delivery">Delivery</option>
        </select>

        <label for="comentario">Comentario (opcional):</label>
        <textarea id="comentario" name="comentario" rows="4"></textarea>

        <label for="metodo_pago">Método de pago:</label>
        <select id="metodo_pago" name="metodo_pago" required>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia</option>
        </select>

        <button type="submit">Pagar</button>
    </form>
</body>
</html>
