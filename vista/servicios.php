<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Servicios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Servicios del Hotel M&A</h1>
        <ul>
            <li>Restaurante</li>
            <li>Gimnasio</li>
            <li>Piscina</li>
            <li>Spa</li>
            <li>Salón de eventos</li>
            <li>Parking</li>
            <li>Wi-Fi gratuito</li>
        </ul>
    </div>
    <?php
    require_once '../controlador/controlador.php';
    if (isset($_COOKIE['rol']) && ($_COOKIE['rol'] === 'cliente' || $_COOKIE['rol'] === 'recepcionista')) {
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
    <?php include 'footer.php'; ?>
</body>
</html>


<?php /*
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Servicios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Servicios del Hotel M&A</h1>
        <ul>
            <li>Restaurante</li>
            <li>Gimnasio</li>
            <li>Piscina</li>
            <li>Spa</li>
            <li>Salón de eventos</li>
            <li>Parking</li>
            <li>Wi-Fi gratuito</li>
        </ul>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
*/ ?>

