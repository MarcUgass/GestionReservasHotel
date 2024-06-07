<?php
session_start();
?>
<header>
    <h1>Hotel M&A</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="servicios.php">Servicios</a></li>
            <li><a href="habitaciones.php">Habitaciones</a></li>
            <?php
                    if (!isset($_SESSION['rol'])) {
                        echo '<li><a href="registro.php">Registro</a></li>
                            <li><a href="login.php">Iniciar Sesión</a></li>';
                    }
                    elseif ($_SESSION['rol'] == 'cliente'){
                        echo '<li><a href="reservas.php">Reservas</a></li>';
                        echo '<li><a href="logout.php">Cerrar Sesión</a></li>';
                    } 
                    elseif ($_SESSION['rol'] == 'admin'){ 
                        echo '<li><a href="gestion_admin.php">Gestión de Base de Datos</a></li>';
                        echo '<li><a href="reserva_recepcionista.php">Gestión de Reservas</a></li>';
                        echo '<li><a href="logout.php">Cerrar Sesión</a></li>';
                    } 
                    elseif ($_SESSION['rol'] == 'recepcionista') {
                        echo '<li><a href="reserva_recepcionista.php">Gestión de Reservas</a></li>';
                        echo '<li><a href="logout.php">Cerrar Sesión</a></li>';
                    }
            ?>
        </ul>
    </nav>
</header>