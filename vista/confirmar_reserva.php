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
    //session_start();
    require_once '../modelos/conectbd.php';
    require_once '../modelos/funcionesdb.php';
    //require_once 'disponibilidad_habitacion.php';
    include 'header.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_SESSION['email'];
        $num_hab = $_POST['num_hab'];
        $entrada = $_POST['entrada'];
        $salida = $_POST['salida'];

        // Mostrar resumen de la reserva
        echo "<h1>Confirmar Reserva</h1>";
        echo "<p>Habitación: $num_hab</p>";
        echo "<p>Fecha de Entrada: $entrada</p>";
        echo "<p>Fecha de Salida: $salida</p>";
        echo "<form action='procesar_reserva.php' method='post'>";
        echo "<input type='hidden' name='num_hab' value='$num_hab'>";
        echo "<input type='hidden' name='entrada' value='$entrada'>";
        echo "<input type='hidden' name='salida' value='$salida'>";
        echo "<input type='submit' name='confirmar' value='Confirmar'>";
        echo "<input type='submit' name='cancelar' value='Cancelar'>";
        echo "</form>";
    }

    include 'footer.php';
    ?>

</body>
</html>


