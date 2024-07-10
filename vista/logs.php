<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel M&A - Habitaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php 
        include 'header.php';
        require_once '../modelos/funcionesdb.php';
        require_once '../controlador/controlador.php';

        $result = getLogs();
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Descripcion</th><th>Fecha</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay logs disponibles.</p>";
        }

        include 'footer.php';
    ?>
</body>
</html>