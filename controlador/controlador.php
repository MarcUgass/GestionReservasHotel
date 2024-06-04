<?php
require_once('../modelos/conectbd.php');
require_once('../modelos/funcionesdb.php');

$conn = conectarBD();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    
    if ($accion === 'registro') {
        // Datos para el registro
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); // Asegurarse de hash la clave antes de almacenarla
        $tarjeta = $_POST['tarjeta'];

        if (!$nombre || !$apellidos || !$dni || !$email || !$clave || !$tarjeta) {
            echo "Error: Uno o más campos están vacíos.";
            exit();
        }
        
        // Llamar a la función registrar
        registrar($conn, $nombre, $apellidos, $dni, $email, $clave, $tarjeta);
    } elseif ($accion === 'login') {
        // Datos para el login
        $email = $_POST['email'];
        $clave = $_POST['clave'];
        //$clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); // Asegurarse de hash la clave antes de almacenarla

        if (!$email || !$clave) {
            echo "Error: El correo electrónico o la clave están vacíos.";
            exit();
        }

        // Llamar a la función login
        login($conn, $email, $clave);
    } else {
        echo "Acción no válida.";
    }
} else {
    header("Location: ../vista/index.php");
    exit();
}
?>
