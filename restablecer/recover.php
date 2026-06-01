<?php
session_start();
require("../conexion/conexion.php");

$correo = $_POST['correo'];

$checkemail = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE correo='$correo' AND (estado='0' OR estado='3')");
$check_mail = mysqli_num_rows($checkemail);

if($check_mail > 0){
	echo 1;
}else{
	echo 0;
}
?>
