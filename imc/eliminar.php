<?php
include 'conexion.php';

$id = $_GET['id'];

// Eliminar el registro
$sql = "DELETE FROM registros_imc WHERE id=$id";

if (mysqli_query($conexion, $sql)) {
    // Redireccionar a la página de registros
    header("Location: ver_registros.php");
} else {
    echo "Error al eliminar: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>