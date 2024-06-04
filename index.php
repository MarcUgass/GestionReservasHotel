<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel XYZ - Página Inicial</title>
    <link rel="stylesheet" href="vista/styles.css">
</head>
<body>
    <!--?php include 'vista/header.php'; ?>-->
    <header>
    <h1>Hotel XYZ</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="vista/servicios.php">Servicios</a></li>
            <li><a href="vista/habitaciones.php">Habitaciones</a></li>
            <?php if (isset($_SESSION['usuario'])): ?>
                <?php if ($_SESSION['rol'] == 'cliente'): ?>
                    <li><a href="vista/reservas.php">Reservas</a></li>
                    <li><a href="vista/reservas_usuario.php">Mis Reservas</a></li>
                <?php elseif ($_SESSION['rol'] == 'recepcionista' || $_SESSION['rol'] == 'administrador'): ?>
                    <li><a href="vista/reservas_admin.php">Gestión de Reservas</a></li>
                    <li><a href="vista/reservas_usuario.php">Mis Reservas</a></li>
                <?php endif; ?>
                <li><a href="vista/logout.php">Cerrar Sesión</a></li>
            <?php else: ?>
                <li><a href="vista/registro.php">Registro</a></li>
                <li><a href="vista/login.php">Iniciar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    </header>
    <div class="container">
        <h1>Bienvenido al Hotel XYZ</h1>
        <p>Disfruta de una experiencia única en nuestro hotel con los mejores servicios y comodidades.</p>
        <div class="info-hotel">
            <h2>Información del Hotel</h2>
            <p>Número total de habitaciones: <span id="total_habitaciones"></span></p>
            <p>Número de habitaciones libres: <span id="habitaciones_libres"></span></p>
            <p>Capacidad total del hotel: <span id="capacidad_total"></span></p>
            <p>Número de huéspedes alojados: <span id="huespedes_alojados"></span></p>
        </div>
    </div>
    <?php include 'vista/footer.php'; ?>
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
