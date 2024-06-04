<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel XYZ - Reservas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Hotel XYZ</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="servicios.html">Servicios</a></li>
                <li><a href="habitaciones.php">Habitaciones</a></li>
                <li><a href="registro.html">Registro</a></li>
                <li><a href="reservas.php">Reservas</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Gestión de Reservas</h2>
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "usuario", "clave", "hotel");
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            // Consulta a la base de datos
            $sql = "SELECT * FROM reservas";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                echo "<ul>";
                while($fila = $resultado->fetch_assoc()) {
                    echo "<li>";
                    echo "<h3>Reserva ID: " . $fila["id"] . "</h3>";
                    echo "<p>Habitación: " . $fila["habitacion_id"] . "</p>";
                    echo "<p>Usuario: " . $fila["usuario_id"] . "</p>";
                    echo "<p>Fecha de entrada: " . $fila["fecha_entrada"] . "</p>";
                    echo "<p>Fecha de salida: " . $fila["fecha_salida"] . "</p>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No hay reservas disponibles.</p>";
            }

            $conexion->close();
            ?>
        </section>
    </main>
    <aside>
        <h3>Información del Hotel</h3>
        <ul>
            <li>Número total de habitaciones: 100</li>
            <li>Número de habitaciones libres: 20</li>
            <li>Capacidad total del hotel: 200 huéspedes</li>
            <li>Número de huéspedes alojados: 180</li>
        </ul>
    </aside>
    <footer>
        <p>&copy; 2023 Hotel XYZ. Todos los derechos reservados.</p>
        <p>Autor: [Tu Nombre]</p>
        <p><a href="documentacion.pdf">Documentación del Proyecto</a></p>
    </footer>
</body>
</html>
