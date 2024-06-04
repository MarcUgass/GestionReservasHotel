<?php
session_start();

// Verificar si el usuario ha iniciado sesión y es administrador o recepcionista
if (!isset($_SESSION['usuario']) || ($_SESSION['rol'] != 'administrador' && $_SESSION['rol'] != 'recepcionista')) {
    header("Location: login.html");
    exit();
}

// Conectar a la base de datos
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $usuario_id = $_POST['usuario_id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    // Actualizar el usuario en la base de datos
    $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, email = ?, rol = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $nombre, $apellidos, $email, $rol, $usuario_id);

    if ($stmt->execute()) {
        header("Location: reservas_admin.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Obtener la información del usuario actual
$usuario_id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - Hotel XYZ</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Editar Usuario</h1>
        <form action="editar_usuario.php" method="post">
            <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
            
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $usuario['apellidos']; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
            
            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="cliente" <?php if ($usuario['rol'] == 'cliente') echo 'selected'; ?>>Cliente</option>
                <option value="recepcionista" <?php if ($usuario['rol'] == 'recepcionista') echo 'selected'; ?>>Recepcionista</option>
                <option value="administrador" <?php if ($usuario['rol'] == 'administrador') echo 'selected'; ?>>Administrador</option>
            </select>
            
            <button type="submit">Guardar Cambios</button>
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
