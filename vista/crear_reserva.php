<?php
include '../modelos/funcionesdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $num_hab = $_POST['num_hab'];
    $entrada = $_POST['entrada'];
    $salida = $_POST['salida'];

    if (crear_reserva($email, $num_hab, $entrada, $salida)) {
        echo "Reserva creada exitosamente.";
    } else {
        echo "Error al crear la reserva. La habitación no está disponible en las fechas seleccionadas.";
    }
}
header("Location: ../vista/reserva_recepcionista.php");
exit();
?>
