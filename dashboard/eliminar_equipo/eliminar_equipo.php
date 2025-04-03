<?php
include '../../conf/connection.php'; // Incluir la conexión

// Obtener el ID del equipo
$id_equipo = $_GET['id'] ?? '';

if ($id_equipo) {
    // Eliminar equipo
    $query = "DELETE FROM equipos WHERE id_equipo = $id_equipo";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "<script>alert('✅ Equipo eliminado correctamente'); window.location.href='../dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Error al eliminar el equipo. Asegúrate de que no tiene reportes asociados.'); window.location.href='../dashboard.php';</script>";
    }
} else {
    echo "<script>alert('⚠️ ID de equipo no válido'); window.location.href='../dashboard.php';</script>";
}

pg_close($conn);
?>
