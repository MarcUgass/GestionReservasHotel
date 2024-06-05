<?php
function registrar($conn, $nombre, $apellidos, $dni, $email, $clave, $tarjeta) {
    $sql = "INSERT INTO usuario (email, clave, nombre, apellido, dni, tarjeta, rol) VALUES (?, ?, ?, ?, ?, ?, 'cliente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $email, $clave, $nombre, $apellidos, $dni, $tarjeta);

    if ($stmt->execute()) {
        header("Location: ../vista/registro_exitoso.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

function login($conn, $email, $clave) { //almacenar
    $sql = "SELECT rol, clave FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparando la declaración: " . $conn->error;
        return;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if (contarUsuarios($conn) > 0) {
        $row = $result -> fetch_assoc();
        $hashed_clave = $row['clave'];
        $rol = $row['rol'];

        if (password_verify($clave, $hashed_clave)) {
            return $rol;
        } else {
            echo "Error: Clave incorrecta.";
            echo "num_rows: " . $stmt->num_rows;
            echo $clave;
            return null;
        }
    } else {
        echo "Error: No se encontró el usuario con ese correo electrónico.";
        return null;
    }
    $stmt->close();
    $conn->close();
}

function contarUsuarios($conn) {
    $sql = "SELECT COUNT(*) as total FROM usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}

function mostrar_usuario($conn, $sesion) {
    $consulta = "SELECT nombre, apellido, email, rol FROM usuario WHERE email = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $usuario['id']);
    $stmt->execute();
    $resultado = $stmt->get_result();
}

function obtenerRolUsuario($email) {
    // Consulta SQL para obtener el rol del usuario
    $sql = "SELECT rol FROM usuario WHERE email = ?";
    $stmt = $conexion->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("s", $email);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con ese correo electrónico
    if ($result->num_rows > 0) {
        // Obtener el rol
        $row = $result->fetch_assoc();
        $rol = $row['rol'];

        // Cerrar la conexión y devolver el rol
        $stmt->close();
        $conexion->close();
        return $rol;
    } else {
        // Si no se encuentra ningún usuario con ese correo electrónico, devolver NULL
        $stmt->close();
        $conexion->close();
        return NULL;
    }
}
function obtenerInformacionHotel($conexion) {
    $sql = "SELECT 
                (SELECT COUNT(*) FROM habitacion) AS total_habitaciones,
                (SELECT COUNT(*) FROM habitacion h WHERE NOT EXISTS (SELECT 1 FROM reserva r WHERE r.num_hab = h.numero AND r.Estado IN ('Operativa'))) AS habitaciones_libres,
                (SELECT SUM(capacidad) FROM habitacion) AS capacidad_total,
                (SELECT COUNT(*) FROM reserva WHERE Estado IN ('Operativa', 'Confirmada')) AS huespedes_alojados";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


function obtenerTotalHabitaciones() {
    global $conexion;
    $query = "SELECT COUNT(*) AS total_habitaciones FROM habitacion";
    $resultado = $conexion->query($query);
    return $resultado;#->fetch(PDO::FETCH_ASSOC)['total_habitaciones'];
}

function obtenerHabitacionesLibres() {
    global $conexion;
    $query = "SELECT COUNT(*) AS habitaciones_libres 
              FROM habitacion h 
              WHERE NOT EXISTS (
                  SELECT 1 
                  FROM reserva r 
                  WHERE r.num_hab = h.numero 
                  AND r.Estado IN ('Operativa')
              )";
    $resultado = $conexion->query($query);
    return $resultado;  #->fetch(PDO::FETCH_ASSOC)['habitaciones_libres'];
}

function obtenerCapacidadTotal() {
    global $conexion;
    $query = "SELECT SUM(capacidad) AS capacidad_total FROM habitacion";
    $resultado = $conexion->query($query);
    return $resultado; #->fetch(PDO::FETCH_ASSOC)['capacidad_total'];
}

function obtenerHuespedesAlojados() {
    global $conexion;
    $query = "SELECT COUNT(*) AS huespedes_alojados 
              FROM reserva 
              WHERE Estado IN ('Operativa', 'Confirmada')";
    $resultado = $conexion->query($query);
    return $resultado;#->fetch(PDO::FETCH_ASSOC)['huespedes_alojados'];
?>