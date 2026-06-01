<?php 

session_start();

require("../../../conexion/conexion.php");

$id_usuario = addslashes($_POST['id_usuario']);
$nombre = addslashes($_POST['nombre']);
$apellidos = addslashes($_POST['apellidos']);
$ciudad = addslashes($_POST['ciudad']);
$telefono = addslashes($_POST['telefono']);

$usuarios_editar = mysqli_query($mysqli, "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', ciudad = '$ciudad', telefono='$telefono' where id_usuario = '$id_usuario'");
if ($usuarios_editar) {
	echo 0;
}else{
	echo 1;
}


?>