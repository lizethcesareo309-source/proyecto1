<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora IMC</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<div class="contenedor">
    <h2>Calculadora IMC</h2>

    <form action="calcular_imc.php" method="POST">

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Edad:</label>
        <input type="number" name="edad" required>

        <label>Peso (kg):</label>
        <input type="number" step="0.1" name="peso" required>

        <label>Estatura (m):</label>
        <input type="number" step="0.01" name="estatura" required>

        <label>Sexo:</label>
        <select name="sexo" required>
            <option value="">Seleccione...</option>
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
        </select>

        <button type="submit">Calcular IMC</button>
    </form>
</div>

</body>
</html>