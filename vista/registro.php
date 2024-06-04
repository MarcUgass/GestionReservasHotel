<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel XYZ - Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Registro de Usuarios</h1>
        <form action="../controlador/controlador.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
            
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required>
            
            <label for="tarjeta">Número de tarjeta de crédito:</label>
            <input type="text" id="tarjeta" name="tarjeta" required>
            
            <button type="submit">Registrarse</button>
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
