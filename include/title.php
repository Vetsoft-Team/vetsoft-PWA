<?php
require("conexion/conexion.php");
$configuracion="SELECT titulo FROM configuracion ";
$config=mysqli_query($mysqli,$configuracion);
while ($conf=mysqli_fetch_row ($config)){
	$titulo=$conf[0];

	echo '<title>'.htmlentities($titulo).'</title>';
}
?>