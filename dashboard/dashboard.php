<?php
include '../conf/connection.php'; // Conexión a la BD

// Obtener equipos
$query_equipos = "SELECT * FROM equipos";
$result_equipos = pg_query($conn, $query_equipos);

// Obtener reportes
$query_reportes = "SELECT r.id_reporte, u.nombre AS usuario, e.nombre AS equipo, r.titulo, r.descripcion, r.estado, r.fecha_reporte
                   FROM reportes r
                   JOIN usuarios u ON r.id_usuario = u.id_usuario
                   JOIN equipos e ON r.id_equipo = e.id_equipo";
$result_reportes = pg_query($conn, $query_reportes);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

    <h2>Equipos Registrados</h2>

    <a href="agregar_equipo/agregar_equipo.php" class="btn"> Agregar equipo </a>
    <a href="agregar_reporte/agregar_reporte.php" class="btn"> Agregar reporte </a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Ubicación</th>
            <th>Fecha de Registro</th>
            <th>Acciones</th>
        </tr>
        <?php while ($equipo = pg_fetch_assoc($result_equipos)): ?>
            <tr>
                <td><?= $equipo['id_equipo'] ?></td>
                <td><?= htmlspecialchars($equipo['nombre']) ?></td>
                <td><?= htmlspecialchars($equipo['descripcion']) ?></td>
                <td><?= htmlspecialchars($equipo['ubicacion']) ?></td>
                <td><?= $equipo['fecha_registro'] ?></td>
                <td>
                    <a href="editar_equipo/editar_equipo.php?id=<?= $equipo['id_equipo']; ?>" class="btn editar">Editar</a>
                    <a href="eliminar_equipo/eliminar_equipo.php?id=<?= $row['id_equipo']; ?>" class="btn eliminar" onclick="return confirm('⚠️ ¿Estás seguro de eliminar este equipo?');">Eliminar</a>                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Reportes de Fallas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Equipo</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Fecha de Reporte</th>
            <th>Acciones</th>
        </tr>
        <?php while ($reporte = pg_fetch_assoc($result_reportes)): ?>
            <tr>
                <td><?= $reporte['id_reporte'] ?></td>
                <td><?= htmlspecialchars($reporte['usuario']) ?></td>
                <td><?= htmlspecialchars($reporte['equipo']) ?></td>
                <td><?= htmlspecialchars($reporte['titulo']) ?></td>
                <td><?= htmlspecialchars($reporte['descripcion']) ?></td>
                <td><?= htmlspecialchars($reporte['estado']) ?></td>
                <td><?= $reporte['fecha_reporte'] ?></td>
                <td>
                <a href="editar_reporte/editar_reporte.php?id=<?= $reporte['id_reporte']; ?>" class="btn editar">Editar</a>                    
                <a href="eliminar_reporte/eliminar_reporte.php?id=<?= $reporte['id_reporte']; ?>" class="btn eliminar" onclick="return confirm('⚠️ ¿Estás seguro de eliminar este reporte?');">Eliminar</a>                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>

</html>