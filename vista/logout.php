<?php
session_start();

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
    session_destroy();
    
    // Redirigir a la página de inicio
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesión</title>
</head>
<body>
    <h1>Cerrar Sesión</h1>
    <p>¿Estás seguro de que quieres cerrar sesión?</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" name="logout" value="Sí">
        <a href="../index.php">No</a>
    </form>
</body>
</html>
