<?php
include '../modelos/funcionesdb.php';

// Obtener reservas y habitaciones
$reservas = obtener_reservas();
$habitaciones = obtener_habitaciones();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Reservas</title>
    <link rel="stylesheet" href="styles.css">
    <script>
    function obtenerFechasReservadas(num_hab) {
        fetch(`../vista/obtener_fechas_reservadas.php?num_hab=${num_hab}`)
            .then(response => response.json())
            .then(data => {
                deshabilitarFechas(data);
            });
    }

    function deshabilitarFechas(fechas) {
        const entradaInput = document.getElementById('entrada');
        const salidaInput = document.getElementById('salida');

        entradaInput.disabledDates = fechas;
        salidaInput.disabledDates = fechas;

        entradaInput.onfocus = function() {
            this.type = 'date';
            disableReservedDates(this);
        };
        salidaInput.onfocus = function() {
            this.type = 'date';
            disableReservedDates(this);
        };
    }

    function disableReservedDates(input) {
        const disabledDates = input.disabledDates || [];
        input.onchange = function() {
            const selectedDate = new Date(this.value);
            disabledDates.forEach(range => {
                const start = new Date(range.entrada);
                const end = new Date(range.salida);
                if (selectedDate >= start && selectedDate <= end) {
                    alert('Esta fecha está reservada. Por favor, selecciona otra fecha.');
                    this.value = '';
                }
            });
        };
    }
    </script>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <section>
        <h2>Gestión de Reservas</h2>
        <button onclick="document.getElementById('crear-reserva-form').style.display='block'">Crear reserva</button>
        
        <div id="crear-reserva-form" style="display:none;">
            <h3>Nueva Reserva</h3>
            <form method="POST" action="crear_reserva.php">
                <label for="email">Email del Usuario:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="num_hab">Número de Habitación:</label>
                <select id="num_hab" name="num_hab" required onchange="obtenerFechasReservadas(this.value)">
                    <option value="">Seleccione una habitación</option>
                    <?php foreach ($habitaciones as $habitacion): ?>
                        <option value="<?php echo htmlspecialchars($habitacion); ?>"><?php echo htmlspecialchars($habitacion); ?></option>
                    <?php endforeach; ?>
                </select><br>
                <label for="entrada">Fecha de Entrada:</label>
                <input type="text" id="entrada" name="entrada" required><br>
                <label for="salida">Fecha de Salida:</label>
                <input type="text" id="salida" name="salida" required><br>
                <button type="submit">Crear Reserva</button>
                <button type="button" onclick="document.getElementById('crear-reserva-form').style.display='none'">Cancelar</button>
            </form>
        </div>
        <?php
            require_once '../controlador/controlador.php';
            if (isset($_COOKIE['rol']) && ($_COOKIE['rol'] === 'recepcionista' || $_COOKIE['rol'] === 'admin')) {
                $controlador = new ControladorSolicitud();
                $infoususario = $controlador->obtenerDatosUsuario($_COOKIE['usuario']);
                echo '
                <div class="info-usuario">
                    <h2>Información del Usuario</h2>
                    <p>Nombre: '. htmlspecialchars($infoususario['nombre']) .'</p>
                    <p>Apellidos: '. htmlspecialchars($infoususario['apellido']) .' </p>
                    <p>Email: '. htmlspecialchars($infoususario['email']) .' </p>
                    <p>Rol: '. htmlspecialchars($infoususario['rol']) .' </p>
                </div>';
            }
        ?>

        <?php
        if (count($reservas) > 0) {
            echo "<ul>";
            foreach ($reservas as $fila) {
                echo "<li>";
                echo "<h3>Reserva de: " . htmlspecialchars($fila["email"]) . "</h3>";
                echo "<p>Habitación: " . htmlspecialchars($fila["num_hab"]) . "</p>";
                echo "<p>Fecha de entrada: " . htmlspecialchars($fila["entrada"]) . "</p>";
                echo "<p>Fecha de salida: " . htmlspecialchars($fila["salida"]) . "</p>";
                echo "<form method='POST' action='eliminar_reserva.php' style='display:inline;'>";
                echo "<input type='hidden' name='email' value='" . htmlspecialchars($fila["email"]) . "'>";
                echo "<input type='hidden' name='num_hab' value='" . htmlspecialchars($fila["num_hab"]) . "'>";
                echo "<button type='submit'>Eliminar reserva</button>";
                echo "</form>";
                echo "<form method='POST' action='procesar_edicion_reserva.php' style='display:inline;'>";
                echo "<input type='hidden' name='email' value='" . htmlspecialchars($fila["email"]) . "'>";
                echo "<input type='hidden' name='num_hab' value='" . htmlspecialchars($fila["num_hab"]) . "'>";
                echo "<label for='entrada'>Fecha de entrada:</label>";
                echo "<input type='date' id='entrada' name='entrada' value='" . htmlspecialchars($fila["entrada"]) . "'>";
                echo "<label for='salida'>Fecha de salida:</label>";
                echo "<input type='date' id='salida' name='salida' value='" . htmlspecialchars($fila["salida"]) . "'>";
                echo "<button type='submit'>Guardar cambios</button>";
                echo "</form>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No hay reservas disponibles.</p>";
        }
        ?>
    </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
