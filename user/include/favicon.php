<?php
require("../conexion/conexion.php");
$configuracion="SELECT favicon FROM configuracion ";
$config=mysqli_query($mysqli,$configuracion);
while ($conf=mysqli_fetch_row ($config)){
	$favicon=$conf[0];

	echo '<link rel="icon" href="../assets/img/favicon/'.htmlentities($favicon).'" type="image/png" />';
}
?>