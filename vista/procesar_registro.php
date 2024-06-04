<?php
// Conectar a la base de datos
include 'db_connection.php';

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
$tarjeta = $_POST['tarjeta'];

// Insertar nuevo usuario en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellidos, dni, email, clave, tarjeta, rol) VALUES (?, ?, ?, ?, ?, ?, 'cliente')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nombre, $apellidos, $dni, $email, $clave, $tarjeta);

if ($stmt->execute()) {
    header("Location: registro_exitoso.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
