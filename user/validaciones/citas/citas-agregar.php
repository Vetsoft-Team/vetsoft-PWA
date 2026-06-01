<?php 

session_start();

require("../../../conexion/conexion.php");

$id_mascota= addslashes($_POST['id_mascota']);
$fecha_cita= addslashes($_POST['fecha_cita']);
$hora_cita= addslashes($_POST['hora_cita']);
$doctor_cita= addslashes($_POST['doctor_cita']);
$motivo_cita= addslashes($_POST['motivo_cita']);

date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d h:i:s');



$checkemail=mysqli_query($mysqli,"SELECT * FROM citas WHERE fecha_cita='$fecha_cita' and hora_cita='$hora_cita' and doctor='$doctor_cita' ");
$check_mail=mysqli_num_rows($checkemail);
if($check_mail>0){

	echo 1;

}else{



	$insertar = mysqli_query($mysqli, "INSERT INTO citas (id_mascota, fecha_cita, hora_cita, doctor, motivo, fecha_registro, estado) VALUES('$id_mascota', '$fecha_cita', '$hora_cita', '$doctor_cita', '$motivo_cita', '$fecha', '0')");

	if ($insertar) {

		$citas_="SELECT max(id_cita) FROM citas ";
		$citas=mysqli_query($mysqli,$citas_);
		while ($cita=mysqli_fetch_row ($citas)){

			$id_cita=$cita[0];

			$insertar1 = mysqli_query($mysqli, "INSERT INTO calendario (id_mascota, id_cita, title, color, start, end) VALUES('$id_mascota', '$id_cita', '$motivo_cita', '#1F9C00', '$fecha_cita $hora_cita', '')");

		}

		echo 0;

	}else{

		echo 2;

	}

}



?>