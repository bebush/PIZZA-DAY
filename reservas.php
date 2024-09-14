<?php
include 'conexion.php';
session_start();

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['phone']);
    $fecha = $conn->real_escape_string($_POST['date']);
    $hora = $conn->real_escape_string($_POST['time']);
    $personas = $conn->real_escape_string($_POST['guests']);
    $comentario = $conn->real_escape_string($_POST['comment']); // Capturamos el comentario

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO reservas (nombre, email, telefono, fecha, hora, personas, comentario)
            VALUES ('$nombre', '$email', '$telefono', '$fecha', '$hora', '$personas', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        echo "Reserva realizada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/scrypt.js">
    <link rel="stylesheet" href="reservas.css">
    <title>Reservas - Pizza Day</title>
</head>
<body>
   <div class="top-r">
     <h2>Pizza Day</h2>
     <h3>Reservas</h3>
     <a href="/index.html">Home</a>
   </div>
   <div class="form-container">
    <h3>Reservar Mesa</h3>
    <form id="reservation-form" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Teléfono:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Hora:</label>
        <input type="time" id="time" name="time" required>

        <label for="guests">Número de Personas:</label>
        <input type="number" id="guests" name="guests" required>

        <!-- Sección de comentarios -->
        <label for="comment">Comentario:</label>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea>

        <button type="submit">Reservar</button>
    </form>
</div>
</body>
</html>
