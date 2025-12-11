<?php
$username ="";
$password="";
$database="teste_entrevista'";
$host="localhost";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>