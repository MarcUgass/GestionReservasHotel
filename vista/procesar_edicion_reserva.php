<?php
include '../modelos/funcionesdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $num_hab = $_POST['num_hab'];
    $entrada = $_POST['entrada'];
    $salida = $_POST['salida'];

    if (editar_reserva($email, $num_hab, $entrada, $salida)) {
        echo "Reserva actualizada exitosamente.";
    } else {
        echo "Error al actualizar la reserva.";
    }
}
header("Location: reserva_recepcionista.php");
exit();
?>
