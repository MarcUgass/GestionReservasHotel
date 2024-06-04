<?php
 require_once('definiciones.php');

class Conexion {
    private $con;
    public function __contruct() {
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
        }
        echo "Connected successfully";
    }

    public function mostrar_habitaciones(){
        $query = $this -> con -> query("SELECT * FROM habitaciones");

    }


}
?>