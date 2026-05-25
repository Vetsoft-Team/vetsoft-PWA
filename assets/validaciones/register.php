<?php

session_start();

require("../../conexion/conexion.php");

$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$ciudad=$_POST['ciudad'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$clave=$_POST['clave'];
$ip=$_SERVER['REMOTE_ADDR'];

date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d h:i:s');

$checkemail=mysqli_query($mysqli,"SELECT * FROM usuarios WHERE correo='$correo'");
$check_mail=mysqli_num_rows($checkemail);
if($check_mail>0){

	echo 0;

}else{

	$veterinaria=sha1(trim($clave));

	$query=mysqli_query($mysqli,"INSERT INTO usuarios (nombre, apellidos, ciudad, correo, telefono, clave, ultima_conexion, fecha_registro, ip, estado, rol, top) VALUES('$nombre','$apellidos','$ciudad','$correo','$telefono','$veterinaria','$fecha','$fecha','$ip','0','2','1')");

	echo 1;

}




?>
