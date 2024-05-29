<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$number = $_POST['number'];

$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbname = "proyectoTW";

//create connection

$connection = new mysqli($serverName, $userName, $userPassword, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    $stmt = $connection->prepare("insert into registration(firstName, lastName, gender, email, password, number) values(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $firstName, $lastName, $gender, $email, $password, $number);
    $stmt->execute();
    echo"Data inserted successfully";
    $stmt->close();
    $connection->close();
}

//$query1 = "insert into registration (firstName, lastName, gender, email, password, number) 
  //           VALUES ('$firstName', '$lastName', '$gender', '$email', '$password', '$number')";
 // $res1 = mysqli_query($db, $query1);
echo "Connected successfully";



?>