<?php

$id_inventario=$_POST['id_inventario'];

require("../../../conexion/conexion.php");

$sentencia="update inventario set estado='0' where id_inventario='".$id_inventario."'";
$resent=mysqli_query($mysqli,$sentencia);
if ($resent==null) {
	header("location: ../../inventario/".$id_inventario);
}else {
	header("location: ../../inventario/".$id_inventario);
}
?>