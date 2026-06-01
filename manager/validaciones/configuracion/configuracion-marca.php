<?php 

session_start();

require("../../../conexion/conexion.php");

$marca= addslashes($_POST['marca']);

$configuracion_editar = mysqli_query($mysqli, "UPDATE configuracion SET marca = '$marca' where id_configuracion = '1'");
if ($configuracion_editar) {
	echo 0;
}else{
	echo 1;
}



?>