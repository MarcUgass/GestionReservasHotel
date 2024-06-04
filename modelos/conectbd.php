<?php

require_once('definiciones.php');
function conectarBD() {
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($connection->connect_error) {
     die("Connection failed: " . $connection->connect_error);
    }
    echo "Connected successfully";

    return $connection;
}

?>