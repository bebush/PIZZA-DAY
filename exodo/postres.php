<?php
include 'conexion.php';

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
function obtenerDato($conn, $tabla, $columna, $condicion = "1", $limite = 1, $offset = 0) {
    $sql = "SELECT $columna FROM $tabla WHERE $condicion LIMIT $limite OFFSET $offset";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row[$columna];
    } else {
        return "No hay datos disponibles";
    }
}

// Usar la función para obtener el segundo producto
$nombre_postre = obtenerDato($conn, "postres", "producto", "1", 1, 3);
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
       <div class="slot">

            <div class="productoDescripcion">
            <p class="producto">Producto</p>
            <p class="descripcion">descipcion</p>  
            </div>

            <div class="precioBotones">
            <div class="precio">Precio $</div>
            <div class="botones">
                <button class="mas">mas</button>
                <button class="menos">menos</button>
            </div>

          </div>
       </div>
       <div class="slot">

            <div class="productoDescripcion">
            <p class="producto"><?php echo $nombre_postre; ?></p>

            <p class="descripcion"></p>  
            </div>

            <div class="precioBotones">
            <div class="precio"></div>
            <div class="botones">
                <button class="mas"></button>
                <button class="menos"></button>
            </div>

          </div>
       </div>
       <div class="slot">

            <div class="productoDescripcion">
            <p class="producto"></p>
            <p class="descripcion"></p>  
            </div>

            <div class="precioBotones">
            <div class="precio"></div>
            <div class="botones">
                <button class="mas"></button>
                <button class="menos"></button>
            </div>

          </div>
       </div>

       <div class="slot">

            <div class="productoDescripcion">
            <p class="producto"></p>
            <p class="descripcion"></p>  
            </div>

            <div class="precioBotones">
            <div class="precio"></div>
            <div class="botones">
                <button class="mas"></button>
                <button class="menos"></button>
            </div>

          </div>
       </div>

       <div class="slot">

            <div class="productoDescripcion">
            <p class="producto"></p>
            <p class="descripcion"></p>  
            </div>

            <div class="precioBotones">
            <div class="precio"></div>
            <div class="botones">
                <button class="mas"></button>
                <button class="menos"></button>
            </div>

          </div>
       </div>

       <div class="slot">

            <div class="productoDescripcion">
            <p class="producto"></p>
            <p class="descripcion"></p>  
            </div>

            <div class="precioBotones">
            <div class="precio"></div>
            <div class="botones">
                <button class="mas"></button>
                <button class="menos"></button>
            </div>

          </div>
       </div>
       
    </div>



        
  <!-- <h1><?php echo $nombre_postre; ?></h1> -->
    

    <div class="p-pie"> all righ reserv</div>
    <script src="/scrypt.js"></script>
</body>
</html>
