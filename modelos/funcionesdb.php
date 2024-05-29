<?php
function registrar($connection, $firstName, $lastName, $gender, $email, $password, $number) {
    $stmt = $connection->prepare("insert into registration(firstName, lastName, gender, email, password, number) values(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $firstName, $lastName, $gender, $email, $password, $number);
    $stmt->execute();
    echo"Data inserted successfully";
    $stmt->close();
    $connection->close();
}

?>