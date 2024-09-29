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

    <!-- SDK de Mercado Pago -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    <div class="logo">Logo</div>
    <h2>Resumen de tu compra</h2>
    <div class="contenedor-carrito">
        <?php if (!empty($carrito)): ?>
            <ul>
                <?php foreach ($carrito as $nombre => $item): ?>
                    <li><?php echo htmlspecialchars($nombre); ?> - <?php echo $item['cantidad']; ?> x $<?php echo number_format($item['precio'], 2); ?> = $<?php echo number_format($item['cantidad'] * $item['precio'], 2); ?></li>
                <?php endforeach; ?>
            </ul>
            <p class="total">Total: $<?php echo number_format($total, 2); ?></p>
        <?php else: ?>
            <p>Tu carrito está vacío.</p>
        <?php endif; ?>
    </div>

    <form id="payment-form" action="guardar_pedido.php" method="post">
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

        <button type="submit" id="submit-btn">Pagar</button>
    </form>

    <!-- Lógica para Mercado Pago -->
    <script>
        // Inicializamos Mercado Pago
        const mp = new MercadoPago('APP_USR-92da59e5-5ad8-435e-8582-f902df4fbd40', { locale: 'es-AR' });

        document.getElementById('payment-form').addEventListener('submit', function(event) {
            // Evitar el envío del formulario por defecto
            event.preventDefault();

            const metodoPago = document.getElementById('metodo_pago').value;

            // Si el método de pago es "transferencia", inicia Mercado Pago
            if (metodoPago === 'transferencia') {
                fetch('crear_transferencia.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        total: '<?php echo $total; ?>' // Total a pagar
                    })
                })
                .then(response => {
    // Verificar si la respuesta es exitosa
    if (!response.ok) {
        throw new Error('Error en la respuesta del servidor: ' + response.statusText);
    }
    return response.json();
})
                .then(preferencia => {
                    // Redirigir a Mercado Pago con la preferencia generada
                    if (preferencia.id) {
                        mp.checkout({
                            preference: {
                                id: preferencia.id
                            }
                        });
                    } else {
                        console.error('Preferencia no válida', preferencia);
                    }
                })
                .catch(error => console.error('Error:', error));
            } else {
                // Si no es transferencia, proceder con el formulario regular
                this.submit();
            }
        });
    </script>
</body>
</html>
