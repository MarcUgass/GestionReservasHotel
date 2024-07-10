<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Habitaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php 
        include 'header.php'; 
        require_once '../modelos/funcionesdb.php';
        require_once '../controlador/controlador.php';
    ?>
    <?php
    require_once '../controlador/controlador.php';
    if (isset($_COOKIE['rol']) && ($_COOKIE['rol'] === 'cliente' || $_COOKIE['rol'] === 'recepcionista' || $_COOKIE['rol'] === 'admin')) {
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
    //session_start();

    // Comprobar si el usuario está logueado
    if (!isset($_SESSION['rol'])) {
        // Si no está logueado, redirigirlo a la página de inicio
        header("Location: ../index.php");
        exit();
    }

    // Si el usuario confirma la salida
    if (isset($_POST['logout'])) {
        // Limpiar la sesión y destruir la sesión actual
        $_SESSION['rol'] = NULL;
        $controlador = new ControladorSolicitud();
        logEvento($controlador->getBD(), $_SESSION['email'] , 'logout');
        session_destroy();
        setcookie('usuario', 'otro', time() - 3600, '/');
        setcookie('rol', 'otro', time() - 3600, '/');
        
        // Redirigir a la página de inicio
        header("Location: ../index.php");
        exit();
    }
    ?>
    <h1>Cerrar Sesión</h1>
    <p>¿Estás seguro de que quieres cerrar sesión?</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" name="logout" value="Sí">
        <button type="button" onclick="location.href='../index.php';" class="btn">No</button>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>