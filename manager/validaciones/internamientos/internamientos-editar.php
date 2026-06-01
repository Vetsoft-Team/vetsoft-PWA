<?php 

session_start();

require("../../../conexion/conexion.php");

$id_internamiento= addslashes($_POST['id_internamiento']);
$id_mascota= addslashes($_POST['id_mascota']);
$fecha_entrada= addslashes($_POST['fecha_entrada']);
$fecha_salida= addslashes($_POST['fecha_salida']);
$medicinas_aplicadas= addslashes($_POST['medicinas_aplicadas']);
$motivo= addslashes($_POST['motivo']);
$antecedentes= addslashes($_POST['antecedentes']);
$tratamiento= addslashes($_POST['tratamiento']);

date_default_timezone_set('America/Panama');    
$fecha = date('Y-m-d h:i:s');



if($fecha_salida==true){

$internamientos_editar = mysqli_query($mysqli, "UPDATE internamientos SET fecha_entrada = '$fecha_entrada', fecha_salida = '$fecha_salida', medicinas_aplicadas = '$medicinas_aplicadas', motivo = '$motivo', antecedentes = '$antecedentes', tratamiento = '$tratamiento', estado='1' where id_internamiento = '$id_internamiento' and id_mascota='$id_mascota'");

}else{

$internamientos_editar = mysqli_query($mysqli, "UPDATE internamientos SET fecha_entrada = '$fecha_entrada', fecha_salida = '$fecha_salida', medicinas_aplicadas = '$medicinas_aplicadas', motivo = '$motivo', antecedentes = '$antecedentes', tratamiento = '$tratamiento' where id_internamiento = '$id_internamiento' and id_mascota='$id_mascota'");

}


if ($internamientos_editar) {
	echo 0;
}else{
	echo 1;
}


?>