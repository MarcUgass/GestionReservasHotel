<?php
session_start();

// Verificar si el usuario ha iniciado sesión y es administrador o recepcionista
if (!isset($_SESSION['usuario']) || ($_SESSION['rol'] != 'administrador' && $_SESSION['rol'] != 'recepcionista')) {
    header("Location: login.html");
    exit();
}

// Conectar a la base de datos
include 'db_connection.php';

// Obtener el ID de la reserva a borrar
$reserva_id = $_GET['id'];

// Borrar la reserva de la base de datos
$sql = "DELETE FROM reservas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $reserva_id);

if ($stmt->execute()) {
    header("Location: reservas_admin.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
