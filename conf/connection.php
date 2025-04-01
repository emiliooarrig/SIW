<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user = "eguzman";
$password = "contrasena123";
$db = "reportes";
$host = "127.0.0.1";
$port = "5432";

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$password");

if (!$conn) {
    echo "❌ Conexión fallida: " . pg_last_error();
} else {
    echo "✅ Conexión exitosa gg papa";
}




?>