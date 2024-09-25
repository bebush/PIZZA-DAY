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

// Obtener datos de las reservas
$columnas = ['nombre', 'telefono', 'hora', 'fecha', 'personas', 'comentario', 'fechareserva'];
$reservas = obtenerDatos($conn, "reservas", $columnas, 6);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <style>
        /* General */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Encabezado del logo */
        .logo {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            font-size: 1.8em;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Contenedor principal */
        div > div {
            margin: 20px auto;
            max-width: 1200px;
            padding: 0 20px;
        }

        /* Botones */
        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Estilo de las reservas */
        .reserva {
            border: 1px solid #ddd;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .reserva h2 {
            margin: 0 0 10px;
            font-size: 1.6em;
            color: #333;
        }

        .reserva p {
            margin: 8px 0;
            font-size: 1em;
        }

        .reserva strong {
            color: #555;
        }

        .reserva .comentario {
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="logo">Logo</div>
    <div>
        <div>
            <button>Pedidos</button>
            <button>Reservas</button>
        </div>
        <div>
            <?php foreach ($reservas as $reserva): ?>
                <div class="reserva">
                    <h2><?php echo htmlspecialchars($reserva['nombre']); ?></h2>
                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($reserva['telefono']); ?></p>
                    <p><strong>Hora:</strong> <?php echo htmlspecialchars($reserva['hora']); ?></p>
                    <p><strong>Fecha:</strong> <?php echo htmlspecialchars($reserva['fecha']); ?></p>
                    <p><strong>Personas:</strong> <?php echo htmlspecialchars($reserva['personas']); ?></p>
                    <p class="comentario"><?php echo htmlspecialchars($reserva['comentario']); ?></p>
                    <p><strong>Fecha de Reserva:</strong> <?php echo htmlspecialchars($reserva['fechareserva']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
