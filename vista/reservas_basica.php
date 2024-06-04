<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel XYZ - Reservas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Reservas</h1>
        <form action="procesar_reserva.php" method="post">
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>
            
            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required>
            
            <label for="num_personas">Número de Personas:</label>
            <input type="number" id="num_personas" name="num_personas" required>
            
            <button type="submit">Reservar</button>
        </form>
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
