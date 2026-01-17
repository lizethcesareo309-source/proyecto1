<?php
// Incluir conexión
include 'conexion.php';

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$peso = $_POST['peso'];
$estatura = $_POST['estatura'];
$sexo = $_POST['sexo'];

// Calcular IMC
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

// Insertar en la base de datos
$sql = "INSERT INTO registros_imc (nombre, edad, peso, estatura, sexo, imc, estado) 
        VALUES ('$nombre', $edad, $peso, $estatura, '$sexo', $imc, '$estado')";

if (mysqli_query($conexion, $sql)) {
    $mensaje = "Registro guardado exitosamente";
    $tipo_mensaje = "success";
} else {
    $mensaje = "Error al guardar: " . mysqli_error($conexion);
    $tipo_mensaje = "error";
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado IMC</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .mensaje {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .resultado {
            background: #fff0f7;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
        }
        hr {
            border: 1px solid #ffb6d9;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Resultado del IMC</h2>

    <div class="mensaje <?php echo $tipo_mensaje; ?>">
        <?php echo $mensaje; ?>
    </div>

    <div class="resultado">
        <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
        <p><strong>Edad:</strong> <?php echo $edad; ?> años</p>
        <p><strong>Sexo:</strong> <?php echo $sexo; ?></p>
        <p><strong>Peso:</strong> <?php echo $peso; ?> kg</p>
        <p><strong>Estatura:</strong> <?php echo $estatura; ?> m</p>

        <hr>

        <p><strong>IMC:</strong> <?php echo number_format($imc, 2); ?></p>
        <p><strong>Estado:</strong> <?php echo $estado; ?></p>
    </div>

    <button onclick="location.href='index.php'">Calcular de nuevo</button>
    <button onclick="location.href='ver_registros.php'" style="background: #d95f9a; margin-top: 10px;">Ver todos los registros</button>
</div>

</body>
</html>