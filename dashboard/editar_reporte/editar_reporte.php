<?php
include '../../conf/connection.php'; // Incluir la conexión

// Obtener el ID del reporte
$id_reporte = $_GET['id'] ?? '';

// Obtener la información del reporte
$query = "SELECT * FROM reportes WHERE id_reporte = $id_reporte";
$result = pg_query($conn, $query);
$reporte = pg_fetch_assoc($result);

// Obtener lista de equipos
$queryEquipos = "SELECT id_equipo, nombre FROM equipos";
$resultEquipos = pg_query($conn, $queryEquipos);

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = pg_escape_string($conn, $_POST['titulo']);
    $descripcion = pg_escape_string($conn, $_POST['descripcion']);
    $estado = pg_escape_string($conn, $_POST['estado']);
    $id_equipo = pg_escape_string($conn, $_POST['id_equipo']);

    // Actualizar reporte
    $updateQuery = "UPDATE reportes SET titulo = '$titulo', descripcion = '$descripcion', estado = '$estado', id_equipo = $id_equipo WHERE id_reporte = $id_reporte";
    $updateResult = pg_query($conn, $updateQuery);

    if ($updateResult) {
        echo "<script>alert('✅ Reporte actualizado correctamente'); window.location.href='../dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Error al actualizar el reporte');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reporte</title>
    <link rel="stylesheet" href="../agregar_equipo/agregar_equipo.css">
</head>
<body>

<h2>Editar Reporte</h2>

<form action="editar_reporte.php?id=<?= $id_reporte ?>" method="POST" class="formulario">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" id="titulo" class="input-form" value="<?= $reporte['titulo']; ?>" required>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion" class="input-form" rows="3"><?= $reporte['descripcion']; ?></textarea>

    <label for="estado">Estado</label>
    <select name="estado" id="estado" class="input-form">
        <option value="Abierto" <?= $reporte['estado'] == 'Abierto' ? 'selected' : ''; ?>>Abierto</option>
        <option value="En Proceso" <?= $reporte['estado'] == 'En Proceso' ? 'selected' : ''; ?>>En Proceso</option>
        <option value="Resuelto" <?= $reporte['estado'] == 'Resuelto' ? 'selected' : ''; ?>>Resuelto</option>
        <option value="Cerrado" <?= $reporte['estado'] == 'Cerrado' ? 'selected' : ''; ?>>Cerrado</option>
    </select>

    <label for="id_equipo">Equipo</label>
    <select name="id_equipo" id="id_equipo" class="input-form">
        <?php while ($equipo = pg_fetch_assoc($resultEquipos)) { ?>
            <option value="<?= $equipo['id_equipo']; ?>" <?= $reporte['id_equipo'] == $equipo['id_equipo'] ? 'selected' : ''; ?>>
                <?= $equipo['nombre']; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit" class="btn">Actualizar Reporte</button>
    <a href="index.php" class="btn cancelar">Cancelar</a>
</form>

</body>
</html>
