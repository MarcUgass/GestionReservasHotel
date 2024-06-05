<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos
include 'db_connection.php';

// Obtener datos del formulario
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$num_personas = $_POST['num_personas'];
$usuario_id = $_SESSION['usuario_id'];

// Insertar nueva reserva en la base de datos
$sql = "INSERT INTO reservas (usuario_id, fecha_inicio, fecha_fin, num_personas, estado) VALUES (?, ?, ?, ?, 'activa')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssi", $usuario_id, $fecha_inicio, $fecha_fin, $num_personas);

if ($stmt->execute()) {
    header("Location: reserva_exitosa.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
