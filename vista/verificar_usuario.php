<?php
// verificar_usuario.php
session_start();
include '../modelos/funcionesdb.php';

$email = $_POST['email'];
$clave = $_POST['clave'];

$usuario = verificar_usuario($email, $clave);
if ($usuario) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php");
} else {
    echo "Credenciales incorrectas.";
}

?>