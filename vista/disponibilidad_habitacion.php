<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilidad habitacion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <?php
    require_once '../controlador/controlador.php';
    $controlador = new ControladorSolicitud();
    $fechasDisponibles = $controlador->obtener30dias();

    $email = $_SESSION['email'];
    ?>
    <div class="container">
        <h1>Seleccione las fechas para su reserva</h1>
        <form action="confirmar_reserva.php" method="post">
            <input type="hidden" name="num_hab" value="<?php echo $_GET['num_hab']; ?>">
            <table border="1">
                <tr>
                    <th>Fecha de Entrada</th>
                    <th>Fecha de Salida</th>
                </tr>
                <tr>
                    <td>
                        <select name="entrada">
                            <?php
                            foreach ($fechasDisponibles as $fecha) {
                                echo "<option value=\"$fecha\">$fecha</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="salida">
                            <?php
                            foreach ($fechasDisponibles as $fecha) {
                                echo "<option value=\"$fecha\">$fecha</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Continuar">
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
