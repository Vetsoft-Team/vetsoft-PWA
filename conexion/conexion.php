<?php

$mysqli = new MySQLi("localhost", "root", "", "veterinaria");
if ($mysqli -> connect_errno) {
	die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno() 
		. ") " . $mysqli -> mysqli_connect_error());
}
mysqli_set_charset($mysqli,"utf8");

?>