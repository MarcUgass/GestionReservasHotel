<?php
include '../modelos/funcionesdb.php';
include 'header.php'; 

// Obtener el número de habitación de la URL
$num_hab = $_GET['num_hab'];
$_SESSION['num_hab'] = $num_hab;

// Obtener la imagen de la habitación
$imagen = obtener_imagen_habitacion($num_hab);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Disponibilidad habitación</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main>
    <section>
    <?php if ($_COOKIE['rol'] !== 'anonimo'): ?>
            <h2>Seleccione las fechas para su reserva</h2>
            <form action="procesar_reserva.php" method="POST">
                <input type="hidden" name="accion" value="habitacion">

                <label for="fecha_entrada">Fecha de Entrada</label>
                <input type="date" id="fecha_entrada" name="fecha_entrada" required>

                <label for="fecha_salida">Fecha de Salida</label>
                <input type="date" id="fecha_salida" name="fecha_salida" required>

                <button type="submit">Continuar</button>
            </form>
        <?php else: ?>
            <h2>No tiene permiso para hacer una reserva. </h2>
                <p> Para poder hacer una reserva tienes que <a href = 'login.php'>Iniciar Sesión.</a></p>
        <?php endif; ?>
        <?php if ($imagen): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>" alt="Imagen de Habitación">
        <?php else: ?>
            <p>No hay imagen disponible para la habitación <?php echo htmlspecialchars($num_hab); ?>.</p>
        <?php endif; ?>
        <?php
        // Mensaje de depuración
        if ($imagen === false) {
            echo "<p>Error al recuperar la imagen.</p>";
        } elseif ($imagen === null) {
            echo "<p>No se encontró ninguna imagen para la habitación $num_hab.</p>";
        }
        ?>
    </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>



<?php /*
<?php
include 'header.php';
require_once(__DIR__ .'/../modelos/funcionesdb.php');
require_once(__DIR__ .'/../controlador/controlador.php');

// Obtener el número de habitación de la URL
$num_hab = $_GET['num_hab'];

// Obtener la imagen de la habitación
$imagen = obtener_imagen_habitacion($num_hab);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Disponibilidad habitación</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main>
    <section>
        <?php if ($_COOKIE['rol'] !== 'anonimo'): ?>
            <h2>Seleccione las fechas para su reserva</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="accion" value="habitacion">

                <label for="fecha_entrada">Fecha de Entrada</label>
                <input type="date" id="fecha_entrada" name="fecha_entrada" required>

                <label for="fecha_salida">Fecha de Salida</label>
                <input type="date" id="fecha_salida" name="fecha_salida" required>

                <button type="submit">Continuar</button>
            </form>
        <?php else: ?>
            <h2>No tiene permiso para hacer una reserva. </h2>
                <p> Para poder hacer una reserva tienes que <a href = 'login.php'>Iniciar Sesión.</a></p>
        <?php endif; ?>

        <?php if ($imagen): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>" alt="Imagen de Habitación">
        <?php else: ?>
            <p>No hay imagen disponible para la habitación <?php echo htmlspecialchars($num_hab); ?>.</p>
        <?php endif; ?>
        <?php
        // Mensaje de depuración
        if ($imagen === false) {
            echo "<p>Error al recuperar la imagen.</p>";
        } elseif ($imagen === null) {
            echo "<p>No se encontró ninguna imagen para la habitación $num_hab.</p>";
        }
        ?>
    </section>
</main>
<?php include 'footer.php'; 

if ($_COOKIE['rol'] != 'anonimo'){

    $_SESSION['num_hab'] = $num_hab;
    
    $controlador = new ControladorSolicitud();
    $v = $controlador->manejarReserva();
    if ($v){
        header("Location: reservas.php?mensaje=" . urlencode("Reserva realizada con éxito"));
    }
    }
    ?>
</body>
</html>
*/?>