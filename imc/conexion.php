<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "proyecto_imc";

// Crear conexión
$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if (!$conexion) {
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}

// Establecer charset UTF-8
mysqli_set_charset($conexion, "utf8");
?>