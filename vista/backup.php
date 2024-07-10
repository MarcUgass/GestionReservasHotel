<?php 
    require_once '../modelos/conectbd.php';
    require_once '../modelos/funcionesdb.php';
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = conectarBD();
        $resultado = crearBackup($conexion);
        if($resultado){
            $descripcion = "Creación de backup de la base de datos";
            //instertarLog($conexion, $descripcion, "Creación de backup");
            $backup = true;
            // Encabezado para descargar el archivo
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="backup.sql"');

            // Imprimimos el archivo
            echo $resultado['backup_content'];

            // Si no lo pongo descarga HTML también
            exit();
        } else {
            $backup = false;
        }
    }
?>