<?php

$id_mascota=$_POST['id_mascota'];

require("../../../conexion/conexion.php");

$sentencia="update mascotas set estado='1' where id_mascota='".$id_mascota."'";
$resent=mysqli_query($mysqli,$sentencia);
if ($resent==null) {
	header("location: ../../mascotas/".$id_mascota);
}else {
	header("location: ../../mascotas/".$id_mascota);
}
?>