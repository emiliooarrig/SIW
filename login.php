<?php 

include 'conf/connection.php';

$nombre = $_POST["usuario"];
$password = $_POST["password"];

$sql = "SELECT * FROM usuarios WHERE nombre = '$nombre' ";


?>