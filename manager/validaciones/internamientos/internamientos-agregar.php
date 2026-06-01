<?php 

session_start();

require("../../../conexion/conexion.php");

$id_mascota= addslashes($_POST['id_mascota']);
$entrada_i= addslashes($_POST['entrada_i']);
$medicinas_aplicadas_i= addslashes($_POST['medicinas_aplicadas_i']);
$motivo_i= addslashes($_POST['motivo_i']);
$antecedentes_i= addslashes($_POST['antecedentes_i']);
$tratamiento_i= addslashes($_POST['tratamiento_i']);


date_default_timezone_set('America/Panama');    
$fecha = date('Y-m-d');


$insertar1 = mysqli_query($mysqli, "INSERT INTO internamientos (id_mascota, fecha_entrada, fecha_salida, medicinas_aplicadas, motivo, antecedentes, tratamiento, fecha_registro, estado) VALUES('$id_mascota', '$entrada_i', '', '$medicinas_aplicadas_i', '$motivo_i', '$antecedentes_i', '$tratamiento_i', '$fecha', '0')");

if ($insertar1) {

	echo 0;

}else{

	echo 1;

}





?>