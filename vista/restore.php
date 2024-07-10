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
        include 'header.php';
        require_once '../modelos/funcionesdb.php';
        require_once '../controlador/controlador.php';

        $conn = new ControladorSolicitud();
        DB_restore($conn->getBD(), '../backup.sql');
        header("Location: gestion_admin.php");

        include 'footer.php';
    ?>
</body>
</html>