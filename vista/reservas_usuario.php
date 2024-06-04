<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel XYZ - Mis Reservas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Mis Reservas</h1>
        <?php
        session_start();
        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['usuario'])) {
            header("Location: login.html");
            exit();
        }

        // Conectar a la base de datos
        include 'db_connection.php';

        // Obtener las reservas del usuario
        $usuario_id = $_SESSION['usuario_id'];
        $sql = "SELECT * FROM reservas WHERE usuario_id = ? AND estado = 'activa'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Fecha de Inicio</th><th>Fecha de Fin</th><th>Número de Personas</th><th>Estado</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['fecha_inicio'] . "</td>";
                echo "<td>" . $row['fecha_fin'] . "</td>";
                echo "<td>" . $row['num_personas'] . "</td>";
                echo "<td>" . $row['estado'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No tienes reservas activas.</p>";
        }

        $stmt->close();
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
