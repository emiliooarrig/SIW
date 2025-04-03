<?php
include '../../conf/connection.php'; // Conexión a la BD

// Obtener usuarios y equipos disponibles
$usuarios = pg_query($conn, "SELECT id_usuario, nombre FROM usuarios");
$equipos = pg_query($conn, "SELECT id_equipo, nombre FROM equipos");

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = pg_escape_string($conn, $_POST['id_usuario']);
    $id_equipo = pg_escape_string($conn, $_POST['id_equipo']);
    $titulo = pg_escape_string($conn, $_POST['titulo']);
    $descripcion = pg_escape_string($conn, $_POST['descripcion']);
    $estado = "Abierto"; // Estado inicial

    // Insertar reporte en la base de datos
    $query = "INSERT INTO reportes (id_usuario, id_equipo, titulo, descripcion, estado) 
              VALUES ('$id_usuario', '$id_equipo', '$titulo', '$descripcion', '$estado')";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "<script>alert('✅ Reporte agregado correctamente'); window.location.href='../dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Error al agregar el reporte'); window.location.href='agregar_reporte.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reporte</title>
    <link rel="stylesheet" href="../agregar_equipo/agregar_equipo.css">
</head>
<body>

<h2>Registrar Reporte de Falla</h2>

<form action="agregar_reporte.php" method="POST" class="formulario">
    <label for="id_usuario">Usuario</label>
    <select name="id_usuario" id="id_usuario" class="input-form" required>
        <option value="">Selecciona un usuario</option>
        <?php while ($row = pg_fetch_assoc($usuarios)) { ?>
            <option value="<?= $row['id_usuario']; ?>"><?= $row['nombre']; ?></option>
        <?php } ?>
    </select>

    <label for="id_equipo">Equipo</label>
    <select name="id_equipo" id="id_equipo" class="input-form" required>
        <option value="">Selecciona un equipo</option>
        <?php while ($row = pg_fetch_assoc($equipos)) { ?>
            <option value="<?= $row['id_equipo']; ?>"><?= $row['nombre']; ?></option>
        <?php } ?>
    </select>

    <label for="titulo">Título del Reporte</label>
    <input type="text" name="titulo" id="titulo" class="input-form" required>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion" class="input-form" rows="3" required></textarea>

    <button type="submit" class="btn">Registrar Reporte</button>
    <a href="index.php" class="btn cancelar">Cancelar</a>
</form>

</body>
</html>
