<?php 

session_start();

require("../../../conexion/conexion.php");

$id_cita= addslashes($_POST['id_cita']);
$id_mascota= addslashes($_POST['id_mascota']);
$fecha_cita= addslashes($_POST['fecha_cita']);
$hora_cita= addslashes($_POST['hora_cita']);
$doctor_cita= addslashes($_POST['doctor_cita']);
$motivo= addslashes($_POST['motivo']);

date_default_timezone_set('America/Panama');    
$fecha = date('Y-m-d h:i:s');

$citas_editar = mysqli_query($mysqli, "UPDATE citas SET fecha_cita = '$fecha_cita', hora_cita = '$hora_cita', doctor = '$doctor_cita', motivo = '$motivo' where id_cita = '$id_cita' and id_mascota='$id_mascota'");
if ($citas_editar) {

	$calendario_editar = mysqli_query($mysqli, "UPDATE calendario SET start = '$fecha_cita $hora_cita', title = '$motivo' where id_cita = '$id_cita'");

	echo 0;
}else{
	echo 1;
}


?>