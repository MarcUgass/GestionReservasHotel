<?php
#session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel XYZ - Habitaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Listado de Habitaciones</h1>
        <?php
        // Conectar a la base de datos
        include 'db_connection.php';

        // Obtener las habitaciones de la base de datos
        $sql = "SELECT * FROM habitaciones";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Habitación</th><th>Capacidad</th><th>Precio por Noche</th><th>Descripción</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['numero'] . "</td>";
                echo "<td>" . $row['capacidad'] . "</td>";
                echo "<td>" . $row['precio_noche'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay habitaciones disponibles.</p>";
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
