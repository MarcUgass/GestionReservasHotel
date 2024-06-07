<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Habitaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php require '../modelos/funcionesdb.php';
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

    <?php include 'footer.php';?>

</body>
</html>