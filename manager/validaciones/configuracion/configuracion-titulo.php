<?php 

session_start();

require("../../../conexion/conexion.php");

$titulo= addslashes($_POST['titulo']);

$configuracion_editar = mysqli_query($mysqli, "UPDATE configuracion SET titulo = '$titulo' where id_configuracion = '1'");
if ($configuracion_editar) {
	echo 0;
}else{
	echo 1;
}



?>