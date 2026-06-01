<?php
session_start();
if (@!$_SESSION['correo']) { header("Location:../../desconectar"); exit; }

require("../../../conexion/conexion.php");

$id_mascota      = mysqli_real_escape_string($mysqli, $_POST['id_mascota']);
$nombre_vacuna   = mysqli_real_escape_string($mysqli, $_POST['nombre_vacuna']);
$fecha_aplicacion = mysqli_real_escape_string($mysqli, $_POST['fecha_aplicacion']);
$tiempo_meses    = intval($_POST['tiempo_meses']);
$proxima_fecha   = mysqli_real_escape_string($mysqli, $_POST['proxima_fecha']);

$q = mysqli_query($mysqli,
    "INSERT INTO vacunas (id_mascota, nombre_vacuna, fecha_aplicacion, tiempo_meses, proxima_fecha)
     VALUES ('$id_mascota','$nombre_vacuna','$fecha_aplicacion','$tiempo_meses','$proxima_fecha')"
);
echo $q ? 0 : 1;
?>
