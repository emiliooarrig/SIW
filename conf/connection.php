<?php 

$user = "root";
$password="";
$db = "sito-taxis";
$host = "localhost";

$sql_connect = "host=localhost port=5432 dbname=$db user=$user password=$password";
$conn = pg_connect($sql_connect);

if(!$conn){
    echo "Conexion fallida: ";
}



?>