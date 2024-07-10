<?php
function modificarUsuariopagina($email) {
    
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar Usuario</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <?php include 'header.php'; ?>
        <div class="container">
            <h1>Modificar Usuario</h1>
            <?php
            require_once '../controlador/controlador.php';
            $controlador = new ControladorSolicitud();
            
            $usuario = $controlador->obtenerUsuarioPorEmail($email);
            ?>
            <form method="post">
                <input type="hidden" name="email_original" value="<?php echo htmlspecialchars($usuario['email']); ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required><br>

                <label for="apellidos">Apellido:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required><br>

                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" value="<?php echo htmlspecialchars($usuario['dni']); ?>" required><br>

                <label for="tarjeta">Tarjeta:</label>
                <input type="text" id="tarjeta" name="tarjeta" value="<?php echo htmlspecialchars($usuario['tarjeta']); ?>" required><br>

                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="cliente" <?php echo $usuario['rol'] == 'cliente' ? 'selected' : ''; ?>>Cliente</option>
                    <option value="admin" <?php echo $usuario['rol'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="recepcionista" <?php echo $usuario['rol'] == 'recepcionista' ? 'selected' : ''; ?>>Recepcionista</option>
                </select><br>

                <button type="submit" name="guardar">Guardar Cambios</button>
                <a href="crudusuario.php"><button>Cancelar</button></a>
            </form>
        </div>
        <?php include 'footer.php'; ?>
    </body>
    </html>
<?php
}

?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Usuarios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        require_once '../controlador/controlador.php';
        if (isset($_COOKIE['rol']) && ($_COOKIE['rol'] === 'cliente' || $_COOKIE['rol'] === 'recepcionista' || $_COOKIE['rol'] === 'admin')) {
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controlador->manejarUsuario();
        }
    ?>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Listado de Usuarios</h1>
        <?php
        require_once '../controlador/controlador.php';
        // Conectar a la base de datos
        $controlador = new ControladorSolicitud();
        // Obtener los usuarios de la base de datos
        $result = $controlador->obtenerlistaUsuarios();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Email</th><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Tarjeta</th><th>Rol</th><th>Acciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellido'] . "</td>";
                echo "<td>" . $row['dni'] . "</td>";
                echo "<td>" . $row['tarjeta'] . "</td>";
                echo "<td>" . $row['rol'] . "</td>";
                echo '<td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="email" value="' . $row['email'] . '">
                            <button type="submit" name="modificar">Modificar</button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="email" value="' . $row['email'] . '">
                            <button type="submit" name="borrar">Borrar</button>
                        </form>
                      </td>';
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay usuarios disponibles.</p>";
        }
        ?>

        <!-- Formulario para crear un nuevo usuario -->
        <h2>Crear Usuario</h2>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellidos">Apellido:</label>
            <input type="text" id="apellidos" name="apellidos" required><br>

            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" required><br>

            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required><br>

            <label for="tarjeta">Tarjeta:</label>
            <input type="text" id="tarjeta" name="tarjeta" required><br>

            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="cliente">Cliente</option>
                <option value="admin">Admin</option>
                <option value="recepcionista">Recepcionista</option>
            </select><br>

            <button type="submit" name="crear">Crear</button>
        </form>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>