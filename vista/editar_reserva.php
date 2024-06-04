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
    $reserva_id = $_POST['reserva_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $num_personas = $_POST['num_personas'];

    // Actualizar la reserva en la base de datos
    $sql = "UPDATE reservas SET fecha_inicio = ?, fecha_fin = ?, num_personas = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $fecha_inicio, $fecha_fin, $num_personas, $reserva_id);

    if ($stmt->execute()) {
        header("Location: reservas_admin.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Obtener la información de la reserva actual
$reserva_id = $_GET['id'];
$sql = "SELECT * FROM reservas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $reserva_id);
$stmt->execute();
$result = $stmt->get_result();
$reserva = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva - Hotel XYZ</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Editar Reserva</h1>
        <form action="editar_reserva.php" method="post">
            <input type="hidden" name="reserva_id" value="<?php echo $reserva['id']; ?>">
            
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $reserva['fecha_inicio']; ?>" required>
            
            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $reserva['fecha_fin']; ?>" required>
            
            <label for="num_personas">Número de Personas:</label>
            <input type="number" id="num_personas" name="num_personas" value="<?php echo $reserva['num_personas']; ?>" required>
            
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
