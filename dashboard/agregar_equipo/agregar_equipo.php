<?php
include '../../conf/connection.php'; // Incluir la conexión a la BD

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = pg_escape_string($conn, $_POST['nombre']);
    $descripcion = pg_escape_string($conn, $_POST['descripcion']);
    $ubicacion = pg_escape_string($conn, $_POST['ubicacion']);

    // Insertar en la base de datos
    $query = "INSERT INTO equipos (nombre, descripcion, ubicacion) VALUES ('$nombre', '$descripcion', '$ubicacion')";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "<script>alert('✅ Equipo agregado correctamente'); window.location.href='../dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Error al agregar el equipo'); window.location.href='agregar_equipo.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Equipo</title>
    <link rel="stylesheet" href="agregar_equipo.css">
</head>
<body>

<h2>Agregar Nuevo Equipo</h2>
<form action="agregar_equipo.php" method="POST" class="formulario">
    <label for="nombre">Nombre del Equipo</label>
    <input type="text" name="nombre" id="nombre" class="input-form" required>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion" class="input-form" rows="3"></textarea>

    <label for="ubicacion">Ubicación</label>
    <input type="text" name="ubicacion" id="ubicacion" class="input-form">

    <button type="submit" class="btn">Agregar Equipo</button>
    <a href="index.php" class="btn cancelar">Cancelar</a>
</form>

</body>
</html>
