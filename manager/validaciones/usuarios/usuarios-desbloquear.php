<?php

$id_usuario=$_POST['id_usuario'];

require("../../../conexion/conexion.php");

$sentencia="update usuarios set estado='0' where id_usuario='".$id_usuario."'";
$resent=mysqli_query($mysqli,$sentencia);
if ($resent==null) {
	header("location: ../../usuarios/".$id_usuario);
}else {
	header("location: ../../usuarios/".$id_usuario);
}
?>