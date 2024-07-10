<?php
include '../modelos/funcionesdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $num_hab = $_POST['num_hab'];

    if (eliminar_reserva($email, $num_hab)) {
        echo "Reserva eliminada exitosamente.";
    } else {
        echo "Error al eliminar la reserva.";
    }
}
header("Location: reserva_recepcionista.php");
exit();
?>
