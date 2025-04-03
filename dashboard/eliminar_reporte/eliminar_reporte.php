<?php
include '../../conf/connection.php'; // Incluir la conexión

// Obtener el ID del reporte
$id_reporte = $_GET['id'] ?? '';

if ($id_reporte) {
    // Eliminar reporte
    $query = "DELETE FROM reportes WHERE id_reporte = $id_reporte";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "<script>alert('✅ Reporte eliminado correctamente'); window.location.href='../dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Error al eliminar el reporte.'); window.location.href='../dashboard.php';</script>";
    }
} else {
    echo "<script>alert('⚠️ ID de reporte no válido'); window.location.href='../dashboard.php';</script>";
}

pg_close($conn);
?>
