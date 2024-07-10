<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Habitaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    //session_start();
    require_once '../modelos/conectbd.php';
    require_once '../modelos/funcionesdb.php';
    require_once 'header.php';

    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['accion'])) {
            $email = $_SESSION['email'];
            $num_hab = $_SESSION['num_hab'];
            $entrada = $_POST['fecha_entrada'];
            $salida = $_POST['fecha_salida'];

            $conn = conectarBD();

            // Insertar la reserva en la base de datos
            $sql_insert = "INSERT INTO reserva (comentarios, email, entrada, Estado, Marca, num_hab, personas, salida) VALUES ('', ?, ?, 'Confirmada', NOW(), ?, 1, ?)";
            $stmt_insert = $conn->prepare($sql_insert);

            if ($stmt_insert) {
                $stmt_insert->bind_param("ssis", $email, $entrada, $num_hab, $salida);
                if ($stmt_insert->execute()) {
                    echo "Reserva realizada con éxito.";
                } else {
                    echo "Error al realizar la reserva: " . $stmt_insert->error;
                }
                $stmt_insert->close();
            } else {
                echo "Error en la preparación de la consulta: " . $conn->error;
            }
            
            $conn->close();
        } elseif (isset($_POST['cancelar'])) {
            echo "La reserva ha sido cancelada.";
        }
    }
    require_once 'footer.php';
    ?>

</body>
</html>


