<?php 

session_start();

require("../../../conexion/conexion.php");

$telefono= addslashes($_POST['telefono']);

$configuracion_editar = mysqli_query($mysqli, "UPDATE configuracion SET telefono = '$telefono' where id_configuracion = '1'");
if ($configuracion_editar) {
	echo 0;
}else{
	echo 1;
}



?>