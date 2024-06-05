<?php
#session_start();
?>
<header>
    <h1>Hotel XYZ</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="servicios.php">Servicios</a></li>
            <li><a href="habitaciones.php">Habitaciones</a></li>
            <?php if (isset($_SESSION['usuario'])): ?>
                <?php if ($_SESSION['rol'] == 'cliente'): ?>
                    <li><a href="reservas.php">Reservas</a></li>
                    <li><a href="reservas_usuario.php">Mis Reservas</a></li>
                <?php elseif ($_SESSION['rol'] == 'recepcionista' || $_SESSION['rol'] == 'administrador'): ?>
                    <li><a href="reservas_admin.php">Gestión de Reservas</a></li>
                    <li><a href="reservas_usuario.php">Mis Reservas</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            <?php else: ?>
                <li><a href="registro.php">Registro</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
