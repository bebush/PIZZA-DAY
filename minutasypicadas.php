<?php
include 'conexion.php';

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function obtenerDatos($conn, $tabla, $columnas, $limite = 5, $offset = 0) {
    $columnas_str = implode(", ", $columnas);
    $sql = "SELECT $columnas_str FROM $tabla LIMIT $limite OFFSET $offset";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $datos = [];
        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }
        return $datos;
    } else {
        return [];
    }
}

// Obtener datos de los productos
$columnas = ['producto', 'descripcion', 'precio'];
$productos = obtenerDatos($conn, "minutaspicadas", $columnas, 5);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylePostre.css">
    <title>pizzaday</title>
</head>
<body>
    <div class="logo">logo</div>
    <div class="contenedor">
        <?php foreach ($productos as $index => $producto): ?>
        <div class="slot">
            <div class="productoDescripcion">
                <p class="producto"><?php echo $producto['producto']; ?></p>
                <p class="descripcion"><?php echo $producto['descripcion']; ?></p>  
            </div>
            <div class="precioBotones">
                <div class="precio"><?php echo $producto['precio']; ?> $</div>
                <div class="botones">
                    <button class="mas" data-index="<?php echo $index; ?>" data-precio="<?php echo $producto['precio']; ?>" data-nombre="<?php echo $producto['producto']; ?>">+</button>
                    <button class="menos" data-index="<?php echo $index; ?>" data-precio="<?php echo $producto['precio']; ?>" data-nombre="<?php echo $producto['producto']; ?>">-</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <a href="carrito.php">Ver carrito</a>
    </div>

    <div class="p-pie"> all right reserved</div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Funciones para agregar o restar productos al carrito y enviarlos a carrito.php
        document.querySelectorAll('.mas').forEach(boton => {
            boton.addEventListener('click', () => {
                const index = boton.dataset.index;
                const nombre = boton.dataset.nombre;
                const precio = boton.dataset.precio;

                // Enviar la información al carrito usando AJAX
                fetch('actualizar_carrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `accion=agregar&index=${index}&nombre=${nombre}&precio=${precio}`
                });
            });
        });

        document.querySelectorAll('.menos').forEach(boton => {
            boton.addEventListener('click', () => {
                const index = boton.dataset.index;
                const precio = boton.dataset.precio;

                // Enviar la información al carrito usando AJAX
                fetch('actualizar_carrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `accion=restar&index=${index}&precio=${precio}`
                });
            });
        });
    });
    </script>
</body>
</html>
