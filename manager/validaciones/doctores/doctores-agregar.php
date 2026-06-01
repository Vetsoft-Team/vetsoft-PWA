<?php

session_start();

require("../../../conexion/conexion.php");

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];


$query=mysqli_query($mysqli,"INSERT INTO doctores (nombre, apellido) VALUES('$nombre','$apellido')");

echo 0;






?>
