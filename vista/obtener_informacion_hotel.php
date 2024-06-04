<?php
// Conectar a la base de datos
include 'db_connection.php';

// Obtener la información del hotel
$sql = "SELECT 
    (SELECT COUNT(*) FROM habitacion) AS total_habitaciones, 
    (SELECT COUNT(*) FROM habitacion WHERE estado = 'libre') AS habitaciones_libres, 
    (SELECT SUM(capacidad) FROM habitacion) AS capacidad_total, 
    (SELECT COUNT(*) FROM reserva WHERE estado = 'Operativo') AS huespedes_alojados";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No se encontró información del hotel.']);
}

$conn->close();
?>
