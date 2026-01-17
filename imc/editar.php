<?php
include 'conexion.php';

$id = $_GET['id'];

// Si se envió el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $peso = $_POST['peso'];
    $estatura = $_POST['estatura'];
    $sexo = $_POST['sexo'];
    
    // Recalcular IMC
    $imc = $peso / ($estatura * $estatura);
    
    // Clasificación del IMC
    if ($imc < 18.5) {
        $estado = "Bajo peso";
    } elseif ($imc < 25) {
        $estado = "Peso normal";
    } elseif ($imc < 30) {
        $estado = "Sobrepeso";
    } else {
        $estado = "Obesidad";
    }
    
    // Actualizar en la base de datos
    $sql = "UPDATE registros_imc SET 
            nombre='$nombre', 
            edad=$edad, 
            peso=$peso, 
            estatura=$estatura, 
            sexo='$sexo',
            imc=$imc,
            estado='$estado'
            WHERE id=$id";
    
    if (mysqli_query($conexion, $sql)) {
        header("Location: ver_registros.php");
        exit();
    } else {
        $error = "Error al actualizar: " . mysqli_error($conexion);
    }
}

// Obtener los datos actuales del registro
$sql = "SELECT * FROM registros_imc WHERE id=$id";
$resultado = mysqli_query($conexion, $sql);
$registro = mysqli_fetch_assoc($resultado);

if (!$registro) {
    die("Registro no encontrado");
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Editar Registro</h2>

    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $registro['nombre']; ?>" required>

        <label>Edad:</label>
        <input type="number" name="edad" value="<?php echo $registro['edad']; ?>" required>

        <label>Peso (kg):</label>
        <input type="number" step="0.1" name="peso" value="<?php echo $registro['peso']; ?>" required>

        <label>Estatura (m):</label>
        <input type="number" step="0.01" name="estatura" value="<?php echo $registro['estatura']; ?>" required>

        <label>Sexo:</label>
        <select name="sexo" required>
            <option value="Femenino" <?php if($registro['sexo']=='Femenino') echo 'selected'; ?>>Femenino</option>
            <option value="Masculino" <?php if($registro['sexo']=='Masculino') echo 'selected'; ?>>Masculino</option>
        </select>

        <button type="submit">Actualizar</button>
        <button type="button" onclick="location.href='ver_registros.php'" style="background: #999; margin-top: 10px;">Cancelar</button>
    </form>
</div>

</body>
</html>