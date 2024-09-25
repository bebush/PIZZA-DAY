<?php
include 'conexion.php';
session_start();

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function obtenerDatos($conn, $tabla, $columnas, $limite = 6, $offset = 0) {
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
$productos = obtenerDatos($conn, "postres", $columnas, 6);

// Obtener el carrito de la sesión
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylePostre.css">
    <title>Pizza Day - Postres</title>
    <script src="carrito.js" defer></script>
</head>
<body>
    <a href="#" class="div-carrito-logo" id="carrito-toggle">
        <img src="https://imgs.search.brave.com/YTMltGz-gA7Tl3n8S55llzBxTrU71GXA8kAejh69gcE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMudmV4ZWxzLmNv/bS9tZWRpYS91c2Vy/cy8zLzIwMDA5Ny9p/c29sYXRlZC9wcmV2/aWV3Lzk0MjgyMDgz/NjI0NmYwOGMyZDZi/ZTIwYTQ1YTg0MTM5/LWljb25vLWRlLWNh/cnJpdG8tZGUtY29t/cHJhcy1jYXJyaXRv/LWRlLWNvbXByYXMu/cG5n" alt="carrito" class="carrito-logo">
    </a>

    <div class="menu-carrito" id="menu-carrito">
        <div class="contenedor-carrito">
       


        </div>

        <button class="boton-footer" id="seguir-comprando">Seguir comprando</button>
        <form action="pago.php" method="post">
    <input type="hidden" name="total" value="<?php echo $total; ?>">
    <button class="boton-footer" name="pagar">Realizar compra</button>
</form>

    </div>

    <div class="logo">Logo</div>
    <div class="contenedor">
        <?php foreach ($productos as $index => $producto): ?>
        <div class="slot">
            <div class="productoDescripcion">
                <p class="producto"><?php echo htmlspecialchars($producto['producto']); ?></p>
                <p class="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            </div>
            <div class="precioBotones">
                <div class="precio"><?php echo $producto['precio']; ?> $</div>
                <div class="botones">
                    <button class="mas" data-nombre="<?php echo htmlspecialchars($producto['producto']); ?>" data-precio="<?php echo $producto['precio']; ?>">+</button>
                    <button class="menos" data-nombre="<?php echo htmlspecialchars($producto['producto']); ?>" data-precio="<?php echo $producto['precio']; ?>">-</button>
                </div>
            </div>
            <div class="contador" data-nombre="<?php echo htmlspecialchars($producto['producto']); ?>">
                <?php echo isset($carrito[$producto['producto']]) ? $carrito[$producto['producto']]['cantidad'] : 0; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="p-pie">All rights reserved</div>

    <script>
   document.getElementById('carrito-toggle').addEventListener('click', function(event) {
    event.preventDefault();
    const menuCarrito = document.getElementById('menu-carrito');
    const carritoLogo = document.querySelector('.div-carrito-logo');
    menuCarrito.classList.toggle('active');

    if (menuCarrito.classList.contains('active')) {
        carritoLogo.style.transform = 'translateX(300px)'; // Mueve el logo a la derecha
    } else {
        carritoLogo.style.transform = 'translateX(0)'; // Vuelve a la posición original
    }
});

document.getElementById('seguir-comprando').addEventListener('click', function() {
    const menuCarrito = document.getElementById('menu-carrito');
    const carritoLogo = document.querySelector('.div-carrito-logo');
    menuCarrito.classList.remove('active');
    carritoLogo.style.transform = 'translateX(0)'; // Vuelve a la posición original
});


    </script>
</body>
</html>
