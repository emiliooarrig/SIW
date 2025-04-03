<?php
include '../conf/connection.php'; // Conexión a PostgreSQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol = $_POST['rol'] ?? '';

    // Validaciones
    if (empty($nombre) || empty($email) || empty($password) || empty($rol)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.location.href='../register.html';</script>";
        exit();
    }

    // Escapar datos para evitar SQL Injection
    $nombre = pg_escape_string($conn, $nombre);
    $email = pg_escape_string($conn, $email);
    $password = pg_escape_string($conn, $password);
    $rol = pg_escape_string($conn, $rol);

    //Hash de la contraseña
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO usuarios (nombre, email, password, rol) VALUES ('$nombre', '$email', '$hashed_password', '$rol')";

    $result = pg_query($conn, $query);

    if ($result) {
        echo "<script>alert('Registro exitoso'); window.location.href='../dashboard/dashboard.php';</script>";
    } else {
        echo $query;

 //       echo "<script>alert('Error al registrar usuario'); window.location.href='registro.php';</script>";
    }

    pg_close($conn);
} else {
    echo "Método no permitido.";
}
?>
