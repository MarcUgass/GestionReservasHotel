<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php 
    // Si el usuario está logueado como cliente, mostrar la página de cliente
    if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'cliente') {
        header("Location: ../index.php");
    } else {
    //session_start();
    include 'header.php'; 
    ?>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="accion" value="login">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
    <?php 
    }
    include 'footer.php'; 
    
    // Llamar a la función login del controlador
    require_once('../controlador/controlador.php');
    $controlador = new ControladorSolicitud();
    $controlador->manejarSolicitud();
    if (isset($_SESSION['rol'])) {
        header("Location: ../index.php");
    }

    ?>
</body>
</html>
