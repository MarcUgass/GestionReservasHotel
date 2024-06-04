<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel XYZ - Gestión de Reservas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Gestión de Reservas</h1>
        <?php
        session_start();
        // Verificar si el usuario ha iniciado sesión y es administrador o recepcionista
        if (!isset($_SESSION['usuario']) || ($_SESSION['rol'] != 'administrador' && $_SESSION['rol'] != 'recepcionista')) {
            header("Location: login.html");
            exit();
        }

        // Conectar a la base de datos
        include 'db_connection.php';

        // Obtener todas las reservas
        $sql = "SELECT reservas.*, usuarios.nombre, usuarios.apellidos FROM reservas JOIN usuarios ON reservas.usuario_id = usuarios.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de Inicio</th><th>Fecha de Fin</th><th>Número de Personas</th><th>Estado</th><th>Acciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellidos'] . "</td>";
                echo "<td>" . $row['fecha_inicio'] . "</td>";
                echo "<td>" . $row['fecha_fin'] . "</td>";
                echo "<td>" . $row['num_personas'] . "</td>";
                echo "<td>" . $row['estado'] . "</td>";
                echo "<td><a href='editar_reserva.php?id=" . $row['id'] . "'>Editar</a> | <a href='borrar_reserva.php?id=" . $row['id'] . "'>Borrar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay reservas activas.</p>";
        }

        $conn->close();
        ?>
    </div>
    <?php include 'footer.php'; ?>
    <script>
        function cargarInformacionHotel() {
            fetch('obtener_informacion_hotel.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total_habitaciones').innerText = data.total_habitaciones;
                    document.getElementById('habitaciones_libres').innerText = data.habitaciones_libres;
                    document.getElementById('capacidad_total').innerText = data.capacidad_total;
                    document.getElementById('huespedes_alojados').innerText = data.huespedes_alojados;
                });
        }

        document.addEventListener('DOMContentLoaded', cargarInformacionHotel);
    </script>
</body>
</html>
