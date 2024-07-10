<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Habitaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
    require_once '../controlador/controlador.php';
    if (isset($_COOKIE['rol']) &&  $_COOKIE['rol'] === 'admin') {
        $controlador = new ControladorSolicitud();
        $infoususario = $controlador->obtenerDatosUsuario($_COOKIE['usuario']);
        echo '
        <div class="info-usuario">
            <h2>Información del Usuario</h2>
            <p>Nombre: '. htmlspecialchars($infoususario['nombre']) .'</p>
            <p>Apellidos: '. htmlspecialchars($infoususario['apellido']) .' </p>
            <p>Email: '. htmlspecialchars($infoususario['email']) .' </p>
            <p>Rol: '. htmlspecialchars($infoususario['rol']) .' </p>
        </div>';
    }
    ?>
    <?php
        include 'header.php'; ?>

    <form id="backup" action="backup.php" method="POST">
        <button>Hacer Backup</button>
    </form>
    <form id="logs" action="logs.php" method="POST">
        <button>Mostrar logs</button>
    </form>
    <form id="restore" action="restore.php" method="POST">
        <button>Restaurar base de datos</button>
    </form>
    <form id="gestionar_habitaciones" action="gestionar_habitaciones.php" method="GET" style="margin-bottom: 30px;">
        <button >Subir Imágenes de Habitaciones</button>
    </form>

    <?php include 'footer.php';?>

</body>
</html>