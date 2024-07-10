<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Reservas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php require 'header.php' ?>
    <main>
        <section>
            <h2>Gestión de Reservas</h2>
            <?php
                require_once '../controlador/controlador.php';
                if (isset($_COOKIE['rol']) && ($_COOKIE['rol'] === 'cliente' || $_COOKIE['rol'] === 'recepcionista' || $_COOKIE['rol'] === 'admin')) {
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
            <?php
            require_once '../controlador/controlador.php';
            $controlador = new ControladorSolicitud();
            $resultado = $controlador->obtenerReservasPorEmail($_COOKIE['usuario']);
            
            if ($resultado->num_rows > 0) {
                echo "<ul>";
                while($fila = $resultado->fetch_assoc()) {
                    echo "<li>";
                    //echo "<h3>Reserva ID: " . $fila["id"] . "</h3>";
                    echo "<p>Habitación: " . $fila["num_hab"] . "</p>";
                    echo "<p>Usuario: " . $fila["email"] . "</p>";
                    echo "<p>Fecha de entrada: " . $fila["entrada"] . "</p>";
                    echo "<p>Fecha de salida: " . $fila["salida"] . "</p>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No hay reservas disponibles.</p>";
            }

            ?>
        </section>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
