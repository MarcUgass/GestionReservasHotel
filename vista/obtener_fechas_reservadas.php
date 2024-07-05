<?php
include '../modelos/funcionesdb.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['num_hab'])) {
    $num_hab = $_GET['num_hab'];
    $fechas_reservadas = obtener_fechas_reservadas($num_hab);
    echo json_encode($fechas_reservadas);
}
?>
