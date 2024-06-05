<?php
function paginaAnonimo() {
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel XYZ - Página Inicial</title>
        <link rel="stylesheet" href="vista/styles.css">
    </head>
    <body>
        <header>
            <h1>Hotel XYZ</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="vista/servicios.php">Servicios</a></li>
                    <li><a href="vista/habitaciones.php">Habitaciones</a></li>
                    <li><a href="vista/registro.php">Registro</a></li>
                    <li><a href="vista/login.php">Iniciar Sesión</a></li>
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
        <?php include \'footer.php\'; ?>
    </body>
    </html>';
}
?>