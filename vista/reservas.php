<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Reservas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php require 'header.php' ?>
    <main>
        <section>
            <h2>Gestión de Reservas</h2>
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "root", "", "proyectotw");
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }
            
            // Consultar a la base de datos
            $email = $_SESSION['email'];
            $stmt = $conexion->prepare("SELECT * FROM reserva WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            
            if ($resultado->num_rows > 0) {
                echo "<ul>";
                while($fila = $resultado->fetch_assoc()) {
                    echo "<li>";
                    //echo "<h3>Reserva ID: " . $fila["id"] . "</h3>";
                    echo "<p>Habitación: " . $fila["num_hab"] . "</p>";
                    echo "<p>Usuario: " . $fila["email"] . "</p>";
                    echo "<p>Fecha de entrada: " . $fila["entrada"] . "</p>";
                    echo "<p>Fecha de salida: " . $fila["salida"] . "</p>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No hay reservas disponibles.</p>";
            }

            $conexion->close();
            ?>
        </section>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
