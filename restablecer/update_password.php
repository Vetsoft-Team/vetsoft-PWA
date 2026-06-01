<?php
session_start();
require("../conexion/conexion.php");

$correo = $_POST['correo'];
$nueva_clave = $_POST['nueva_clave'];

$clave_encrip = sha1(trim($nueva_clave));

$sentencia = "UPDATE usuarios SET clave='$clave_encrip', estado='0' WHERE correo='$correo'";
$resent = mysqli_query($mysqli, $sentencia);

if($resent){
	echo 1;
}else{
	echo 0;
}
?>
