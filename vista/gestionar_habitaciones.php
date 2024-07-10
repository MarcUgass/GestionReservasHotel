<?php
include '../modelos/funcionesdb.php';


// Obtener habitaciones
$habitaciones = obtener_habitaciones();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Habitaciones</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <section>
        <h2>Gestión de Habitaciones</h2>
        
        <h3>Subir Imagen de Habitación</h3>
        <form method="POST" action="subir_imagen.php" enctype="multipart/form-data">
            <label for="num_hab">Número de Habitación:</label>
            <select id="num_hab" name="num_hab" required>
                <?php foreach ($habitaciones as $habitacion): ?>
                    <option value="<?php echo htmlspecialchars($habitacion); ?>"><?php echo htmlspecialchars($habitacion); ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required><br>
            <button type="submit">Subir Imagen</button>
        </form>

        <h3>Habitaciones</h3>
        <ul id="habitaciones-list">
            <?php foreach ($habitaciones as $habitacion): ?>
                <li class="habitacion-item">
                    <h4>Habitación <?php echo htmlspecialchars($habitacion); ?></h4>
                    <?php $imagen = obtener_imagen_habitacion($habitacion); ?>
                    <?php if ($imagen): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>" width="200" />
                    <?php else: ?>
                        <p>No hay imagen disponible.</p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
