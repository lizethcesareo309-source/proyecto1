<?php
include 'conexion.php';

// Consultar todos los registros
$sql = "SELECT * FROM registros_imc ORDER BY fecha_registro DESC";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registros IMC</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .contenedor {
            width: 90%;
            max-width: 1200px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        
        th {
            background: #ff9ac9;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        
        td {
            padding: 10px;
            border-bottom: 1px solid #ffe1f0;
        }
        
        tr:hover {
            background: #fff0f7;
        }
        
        .acciones {
            display: flex;
            gap: 5px;
        }
        
        .btn-editar, .btn-eliminar {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            color: white;
        }
        
        .btn-editar {
            background: #4CAF50;
        }
        
        .btn-editar:hover {
            background: #45a049;
        }
        
        .btn-eliminar {
            background: #f44336;
        }
        
        .btn-eliminar:hover {
            background: #da190b;
        }
        
        .sin-registros {
            text-align: center;
            padding: 30px;
            color: #c44d86;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Registros de IMC</h2>
    
    <button onclick="location.href='index.php'">Nuevo Cálculo</button>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Peso (kg)</th>
                    <th>Estatura (m)</th>
                    <th>IMC</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['nombre']; ?></td>
                        <td><?php echo $fila['edad']; ?></td>
                        <td><?php echo $fila['sexo']; ?></td>
                        <td><?php echo $fila['peso']; ?></td>
                        <td><?php echo $fila['estatura']; ?></td>
                        <td><?php echo number_format($fila['imc'], 2); ?></td>
                        <td><?php echo $fila['estado']; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($fila['fecha_registro'])); ?></td>
                        <td>
                            <div class="acciones">
                                <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn-editar">Editar</a>
                                <a href="eliminar.php?id=<?php echo $fila['id']; ?>" 
                                   class="btn-eliminar" 
                                   onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="sin-registros">
            <p>No hay registros disponibles</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

<?php mysqli_close($conexion); ?>