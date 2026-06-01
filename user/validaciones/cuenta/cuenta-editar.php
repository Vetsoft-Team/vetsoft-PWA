<?php 

session_start();
if (@!$_SESSION['correo']) {
	header("Location:../../desconectar");
}elseif ($_SESSION['rol']==1) {
	header("Location:../../desconectar");
}

require("../../../conexion/conexion.php");

$id_usuario=$_SESSION['id_usuario'];
$nombre = addslashes($_POST['nombre']);
$apellidos = addslashes($_POST['apellidos']);
$correo = addslashes($_POST['correo']);
$telefono = addslashes($_POST['telefono']);

$cuenta_editar = mysqli_query($mysqli, "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', telefono='$telefono' where id_usuario = '$id_usuario' and estado='0' ");
if ($cuenta_editar) {
	echo 0;
}else{
	echo 1;
}


?>