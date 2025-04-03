<?php
include '../../conf/connection.php'; // Incluir la conexión

// Obtener el ID del equipo
$id_equipo = $_GET['id'] ?? '';

// Obtener la información del equipo
$query = "SELECT * FROM equipos WHERE id_equipo = $id_equipo";
$result = pg_query($conn, $query);
$equipo = pg_fetch_assoc($result);

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = pg_escape_string($conn, $_POST['nombre']);
    $descripcion = pg_escape_string($conn, $_POST['descripcion']);
    $ubicacion = pg_escape_string($conn, $_POST['ubicacion']);

    // Actualizar equipo
    $updateQuery = "UPDATE equipos SET nombre = '$nombre', descripcion = '$descripcion', ubicacion = '$ubicacion' WHERE id_equipo = $id_equipo";
    $updateResult = pg_query($conn, $updateQuery);

    if ($updateResult) {
        echo "<script>alert('✅ Equipo actualizado correctamente'); window.location.href='../dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Error al actualizar el equipo');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
    <link rel="stylesheet" href="../agregar_equipo/agregar_equipo.css">
</head>
<body>

<h2>Editar Equipo</h2>

<form action="editar_equipo.php?id=<?= $id_equipo ?>" method="POST" class="formulario">
    <label for="nombre">Nombre del Equipo</label>
    <input type="text" name="nombre" id="nombre" class="input-form" value="<?= $equipo['nombre']; ?>" required>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion" class="input-form" rows="3"><?= $equipo['descripcion']; ?></textarea>

    <label for="ubicacion">Ubicación</label>
    <input type="text" name="ubicacion" id="ubicacion" class="input-form" value="<?= $equipo['ubicacion']; ?>">

    <button type="submit" class="btn">Actualizar Equipo</button>
    <a href="../dashboard.php" class="btn cancelar">Cancelar</a>
</form>

</body>
</html>
