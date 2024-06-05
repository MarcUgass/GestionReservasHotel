<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel XYZ - Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php 
    session_start();
    // Si el usuario está logueado como cliente, redirigir a la página principal
    if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'cliente') {
        header("Location: ../index.php");
        exit();
    } else {
        include 'header.php'; 
    ?>
    <div class="container">
        <h1>Registro</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="accion" value="registro">
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
            
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required>
            
            <label for="tarjeta">Número de tarjeta de crédito:</label>
            <input type="text" id="tarjeta" name="tarjeta" required>
            
            <button type="submit">Registrarse</button>
        </form>
    </div>
    <?php 
        include 'footer.php'; 
        
        // Llamar a la función registro del controlador
        require_once('../controlador/controlador.php');
        $controlador = new ControladorSolicitud();
        $controlador->manejarSolicitud();
    }
    ?>
</body>
</html>
