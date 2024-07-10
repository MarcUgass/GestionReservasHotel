<?php
include '../modelos/funcionesdb.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num_hab = $_POST['num_hab'];
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

    // Verificar si se subió la imagen correctamente
    if ($imagen === false) {
        echo "Error al leer el archivo de imagen.";
        exit();
    }

    // Añadir un mensaje de depuración
    echo "Imagen leída correctamente.<br>";

    if (subir_imagen_habitacion($num_hab, $imagen)) {
        echo "Imagen subida exitosamente.";
        header("Location: gestionar_habitaciones.php");
    } else {
        echo "Error al subir la imagen.";
    }
    exit(); // Añadir exit() para detener el script aquí y ver el mensaje
} else {
    echo "Método de solicitud no permitido.";
    exit();
}
?>
