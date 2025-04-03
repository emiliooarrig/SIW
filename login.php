<?php 
include 'conf/connection.php';

// Obtener datos del formulario
$username = $_POST['user'] ?? '';
$pass = $_POST['password'] ?? '';

// Evitar SQL Injection
$username = pg_escape_string($conn, $username);

// Consulta a la base de datos (solo obtenemos el hash)
$query = "SELECT password FROM usuarios WHERE nombre = '$username'";
$result = pg_query($conn, $query);

// Validar si el usuario existe
if (pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
    $hashed_password = $row['password'];

    // Verificar la contraseña
    if (password_verify($pass, $hashed_password)) {
        $_SESSION['user'] = $username; // Guardar sesión
        header("Location: dashboard/dashboard.php"); // Redirigir a dashboard
        exit();
    }
}

// Si llega aquí, es porque falló la autenticación
echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.php';</script>";

// Cerrar conexión
pg_close($conn);

?>