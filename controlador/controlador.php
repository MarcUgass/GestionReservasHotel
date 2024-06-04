<?php
require_once('../modelos/conectbd.php');
require_once('../modelos/funcionesdb.php');
$conn = conectarBD();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); // Asegurarse de hash la clave antes de almacenarla
    $tarjeta = $_POST['tarjeta'];
    
    // Llamar a la función registrar
    registrar($conn, $nombre, $apellidos, $dni, $email, $clave, $tarjeta);
} else {
    header("Location: ../vista/registro.php");
    exit();
}
?>
