<?php

session_start();

require("../../../conexion/conexion.php");

$id_inventario=$_POST['id_inventario'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];

$total=$precio*$cantidad;

date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d h:i:s');

$checkemail=mysqli_query($mysqli,"SELECT * FROM caja WHERE id_inventario='$id_inventario'");
$check_mail=mysqli_num_rows($checkemail);
if($check_mail>0){

	echo'
	<script>
	function redireccionarPagina() {
		window.location = "javascript:history.back()";
	}
	setTimeout("redireccionarPagina()");
	</script>
	';

}else{


	$query=mysqli_query($mysqli,"INSERT INTO caja (id_usuario, id_inventario, precio, cantidad, total, fecha_registro) VALUES('','$id_inventario','$precio','$cantidad','$total','$fecha')");

	echo'
	<script>
	function redireccionarPagina() {
		window.location = "javascript:history.back()";
	}
	setTimeout("redireccionarPagina()");
	</script>
	';

}




?>
