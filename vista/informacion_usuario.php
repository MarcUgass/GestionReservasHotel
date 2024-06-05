<?php
#session_start();
include '../controlador/controlador.php';

function mostrarInformacionUsuario() {
    if(isset($_SESSION['usuario'])) {
        $email = $_SESSION['usuario'];
        $usuario = obtenerInformacionUsuario($email);

        if($usuario) {
            echo "<div style='text-align: right;'>";
            echo "Nombre: " . $usuario['nombre'] . "<br>";
            echo "Apellido: " . $usuario['apellido'] . "<br>";
            echo "Email: " . $usuario['email'] . "<br>";
            echo "Rol: " . $usuario['rol'] . "<br>";
            echo "</div>";
        } else {
            echo "No se encontró información del usuario.";
        }
    } else {
        echo "No hay ningún usuario conectado.";
    }
}


// Llamamos a la función para mostrar la información del usuario
mostrarInformacionUsuario();
?>
