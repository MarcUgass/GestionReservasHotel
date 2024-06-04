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

function login($conn, $email, $clave) {
    $sql = "SELECT clave FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparando la declaración: " . $conn->error;
        return;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if (contarUsuarios($conn) > 0) {
        $stmt->bind_result($hashed_clave);
        $stmt->fetch();

        if (password_verify($clave, $hashed_clave)) {
            header("Location: ../vista/login_exitoso.php");
        } else {
            echo "Error: Clave incorrecta.";
            echo "num_rows: " . $stmt->num_rows;
            echo $clave;
        }
    } else {
        echo "Error: No se encontró el usuario con ese correo electrónico.";
    }
    echo contarUsuarios($conn);
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
?>