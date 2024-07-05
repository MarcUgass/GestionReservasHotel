<?php
require_once(__DIR__ .'/../controlador/controlador.php');
function paginaAnonimo() {
    $controlador = new ControladorSolicitud();
    $totalHabitaciones = $controlador->obtenerDatosHabitaciones();

    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel M&A - Página Inicial</title>
        <link rel="stylesheet" href="vista/styles.css">
    </head>
    <body>
        <header>
            <h1>Hotel M&A</h1>
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
            <h1>Bienvenido al Hotel M&A</h1>
            <p>Disfruta de una experiencia única en nuestro hotel con los mejores servicios y comodidades.</p>
            <div class="info-hotel">
                <h2>Información del Hotel</h2>
                <p>Número total de habitaciones: '. htmlspecialchars($totalHabitaciones['total_habitaciones']) .'</p>
                <p>Número de habitaciones libres:'. htmlspecialchars($totalHabitaciones['habitaciones_libres']) .' </p>
                <p>Capacidad total del hotel:'. htmlspecialchars($totalHabitaciones['capacidad_total']) .' </p>
                <p>Número de huéspedes alojados:'. htmlspecialchars($totalHabitaciones['huespedes_alojados']) .' </p>
            </div>
        </div>
        <?php include \'footer.php\'; ?>
    </body>
    </html>';
}

function paginaCliente() {
    $controlador = new ControladorSolicitud();
    $totalHabitaciones = $controlador->obtenerDatosHabitaciones();
    $infoususario = $controlador->obtenerDatosUsuario($_COOKIE['usuario']);

    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel M&A - Página del Cliente</title>
        <link rel="stylesheet" href="vista/styles.css">
    </head>
    <body>
        <header>
            <h1>Hotel M&A</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="vista/servicios.php">Servicios</a></li>
                    <li><a href="vista/habitaciones.php">Habitaciones</a></li>
                    <li><a href="vista/reservas.php">Reservas</a></li>
                    <li><a href="vista/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <h1>Bienvenido al Hotel M&A</h1>
            <p>Disfruta de una experiencia única en nuestro hotel con los mejores servicios y comodidades.</p>
            <div class="info-hotel">
                <h2>Información del Hotel</h2>
                <p>Número total de habitaciones: '. htmlspecialchars($totalHabitaciones['total_habitaciones']) .'</p>
                <p>Número de habitaciones libres:'. htmlspecialchars($totalHabitaciones['habitaciones_libres']) .' </p>
                <p>Capacidad total del hotel:'. htmlspecialchars($totalHabitaciones['capacidad_total']) .' </p>
                <p>Número de huéspedes alojados:'. htmlspecialchars($totalHabitaciones['huespedes_alojados']) .' </p>
            </div>
            <div class="info-usuario">
                <h2>Información del Usuario</h2>
                <p>Nombre: '. htmlspecialchars($infoususario['nombre']) .'</p>
                <p>Apellidos:'. htmlspecialchars($infoususario['apellido']) .' </p>
                <p>Email:'. htmlspecialchars($infoususario['email']) .' </p>
                <p>Rol:'. htmlspecialchars($infoususario['rol']) .' </p>
            </div>
        </div>
        <?php include \'footer.php\'; ?>
    </body>
    </html>';
}

function paginaAdmin() {
    $controlador = new ControladorSolicitud();
    $totalHabitaciones = $controlador->obtenerDatosHabitaciones();
    $infoususario = $controlador->obtenerDatosUsuario($_COOKIE['usuario']);

    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel M&A - Página del Cliente</title>
        <link rel="stylesheet" href="vista/styles.css">
    </head>
    <body>
        <header>
            <h1>Hotel M&A</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="vista/servicios.php">Servicios</a></li>
                    <li><a href="vista/habitaciones.php">Habitaciones</a></li>
                    <li><a href="vista/gestion_admin.php">Gestión de Base de Datos</a></li>
                    <li><a href="vista/reserva_recepcionista.php">Gestión de Reservas</a></li>
                    <li><a href="vista/crudusuario.php">CRUD Usuarios</a></li>
                    <li><a href="vista/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <h1>Bienvenido al Hotel M&A</h1>
            <p>Disfruta de una experiencia única en nuestro hotel con los mejores servicios y comodidades.</p>
            <div class="info-hotel">
                <h2>Información del Hotel</h2>
                <p>Número total de habitaciones: '. htmlspecialchars($totalHabitaciones['total_habitaciones']) .'</p>
                <p>Número de habitaciones libres:'. htmlspecialchars($totalHabitaciones['habitaciones_libres']) .' </p>
                <p>Capacidad total del hotel:'. htmlspecialchars($totalHabitaciones['capacidad_total']) .' </p>
                <p>Número de huéspedes alojados:'. htmlspecialchars($totalHabitaciones['huespedes_alojados']) .' </p>
            </div>
            <div class="info-usuario">
                <h2>Información del Usuario</h2>
                <p>Nombre: '. htmlspecialchars($infoususario['nombre']) .'</p>
                <p>Apellidos:'. htmlspecialchars($infoususario['apellido']) .' </p>
                <p>Email:'. htmlspecialchars($infoususario['email']) .' </p>
                <p>Rol:'. htmlspecialchars($infoususario['rol']) .' </p>
            </div>
        </div>
        <?php include \'footer.php\'; ?>
    </body>
    </html>';
}

function paginaRecepcionista() {
    $controlador = new ControladorSolicitud();
    $totalHabitaciones = $controlador->obtenerDatosHabitaciones();
    $infoususario = $controlador->obtenerDatosUsuario($_COOKIE['usuario']);

    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel M&A - Página del Cliente</title>
        <link rel="stylesheet" href="vista/styles.css">
    </head>
    <body>
        <header>
            <h1>Hotel M&A</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="vista/servicios.php">Servicios</a></li>
                    <li><a href="vista/habitaciones.php">Habitaciones</a></li>
                    <li><a href="vista/reserva_recepcionista.php">Gestión de Reservas</a></li>
                    <li><a href="vista/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <h1>Bienvenido al Hotel M&A</h1>
            <p>Disfruta de una experiencia única en nuestro hotel con los mejores servicios y comodidades.</p>
            <div class="info-hotel">
                <h2>Información del Hotel</h2>
                <p>Número total de habitaciones: '. htmlspecialchars($totalHabitaciones['total_habitaciones']) .'</p>
                <p>Número de habitaciones libres:'. htmlspecialchars($totalHabitaciones['habitaciones_libres']) .' </p>
                <p>Capacidad total del hotel:'. htmlspecialchars($totalHabitaciones['capacidad_total']) .' </p>
                <p>Número de huéspedes alojados:'. htmlspecialchars($totalHabitaciones['huespedes_alojados']) .' </p>
            </div>
            <div class="info-usuario">
                <h2>Información del Usuario</h2>
                <p>Nombre: '. htmlspecialchars($infoususario['nombre']) .'</p>
                <p>Apellidos:'. htmlspecialchars($infoususario['apellido']) .' </p>
                <p>Email:'. htmlspecialchars($infoususario['email']) .' </p>
                <p>Rol:'. htmlspecialchars($infoususario['rol']) .' </p>
            </div>
        </div>
        <?php include \'footer.php\'; ?>
    </body>
    </html>';
}
?>