<?php
#session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Habitaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Listado de Habitaciones</h1>
        <?php
        // Conectar a la base de datos
        require_once '../controlador/controlador.php';
        $controlador = new ControladorSolicitud();

        // Obtener las habitaciones de la base de datos
        $result = $controlador->obtenerlistaHabitaciones();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Habitación</th><th>Capacidad</th><th>Precio por Noche</th><th>Descripción</th><th>Disponibilidad</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['numero'] . "</td>";
                echo "<td>" . $row['capacidad'] . "</td>";
                echo "<td>" . $row['precio'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo '<td> <a href="disponibilidad_habitacion.php?num_hab=' . $row['numero'].'">Disponibilidad</a> </td>';
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay habitaciones disponibles.</p>";
        }
        ?>
    </div>
    <?php
    require_once '../controlador/controlador.php';
    if (isset($_COOKIE['rol']) && ($_COOKIE['rol'] === 'cliente' || $_COOKIE['rol'] === 'recepcionista')) {
        $controlador = new ControladorSolicitud();
        $infoususario = $controlador->obtenerDatosUsuario($_COOKIE['usuario']);
        echo '
        <div class="info-usuario">
            <h2>Información del Usuario</h2>
            <p>Nombre: '. htmlspecialchars($infoususario['nombre']) .'</p>
            <p>Apellidos: '. htmlspecialchars($infoususario['apellido']) .' </p>
            <p>Email: '. htmlspecialchars($infoususario['email']) .' </p>
            <p>Rol: '. htmlspecialchars($infoususario['rol']) .' </p>
        </div>';
    }
    ?>
    <?php include 'footer.php'; ?>
</body>
</html>
