<?php
function registrar($conn, $firstName, $lastName, $gender, $email, $password, $number) {
    $sql = "INSERT INTO usuario (email, clave, nombre, apellido, dni, tarjeta, rol) VALUES (?, ?, ?, ?, ?, ?, 'cliente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $nombre, $apellidos, $dni, $email, $clave, $tarjeta);

    if ($stmt->execute()) {
        header("Location: registro_exitoso.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}


?>