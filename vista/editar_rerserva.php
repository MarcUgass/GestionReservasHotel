<?php
include '../modelos/reservas.php';
$id = $_GET['id'];
$reserva = obtenerReservaPorId($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Editar Reserva</h1>
    
    <form action="../controlador/controlador.php" method="POST">
        <input type="hidden" name="accion" value="modificar">
        <input type="hidden" name="id" value="<?php echo $reserva['id']; ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $reserva['email']; ?>" required>
        <label for="num_hab">Número de Habitación:</label>
        <input type="number" id="num_hab" name="num_hab" value="<?php echo $reserva['num_hab']; ?>" required>
        <label for="entrada">Fecha de Entrada:</label>
        <input type="date" id="entrada" name="entrada" value="<?php echo $reserva['entrada']; ?>" required>
        <label for="salida">Fecha de Salida:</label>
        <input type="date" id="salida" name="salida" value="<?php echo $reserva['salida']; ?>" required>
        <label for="personas">Número de Personas:</label>
        <input type="number" id="personas" name="personas" value="<?php echo $reserva['personas']; ?>" required>
        <label for="Estado">Estado:</label>
        <select id="Estado" name="Estado" required>
            <option value="confirmada" <?php if ($reserva['Estado'] == 'confirmada') echo 'selected'; ?>>Confirmada</option>
            <option value="pendiente" <?php if ($reserva['Estado'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="cancelada" <?php if ($reserva['Estado'] == 'cancelada') echo 'selected'; ?>>Cancelada</option>
        </select>
        <label for="comentarios">Comentarios:</label>
        <input type="text" id="comentarios" name="comentarios" value="<?php echo $reserva['comentarios']; ?>">
        <button type="submit">Modificar Reserva</button>
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>
