<?php
include 'conexion.php'; // Asegúrate de que la conexión esté establecida aquí
session_start();

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : ''; // Hacer el comentario opcional
    $total = $_POST['total'];
    $metodo_pago = $_POST['metodo_pago'];
    $metodo_entrega = $_POST['metodo_entrega']; // Recuperar el método de entrega (RoD)

    // Preparar la consulta para insertar el pedido
    $sql = "INSERT INTO pedidos (nombre, celular, direccion, comentario, total, metodo_pago, RoD) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación fue exitosa
    if ($stmt) {
        // Asociar los parámetros a la consulta
        $stmt->bind_param("sssssss", $nombre, $celular, $direccion, $comentario, $total, $metodo_pago, $metodo_entrega);

        // Ejecutar la consulta y manejar el resultado
        if ($stmt->execute()) {
            // Guardar información del pedido en la sesión
            $_SESSION['nombre'] = $nombre; // Guardar el nombre del cliente
            $_SESSION['total'] = $total; // Guardar el total del pedido

            unset($_SESSION['carrito']); // Limpiar el carrito
            
            // Redirigir a una página de agradecimiento
            header("Location: agradecimiento.php");
            exit(); // Asegúrate de salir después de la redirección
        } else {
            echo "Error al realizar el pedido: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error; // Mensaje de error si la consulta falla
    }
}

// Cerrar la conexión
$conn->close();
?>
