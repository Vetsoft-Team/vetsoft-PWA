<?php 

session_start();

require("../../../conexion/conexion.php");

$id_mascota = addslashes($_POST['id_mascota']);
$nombre = addslashes($_POST['nombre']);
$fecha_nacimiento = addslashes($_POST['fecha_nacimiento']);
$edad = addslashes($_POST['edad']);
$raza = addslashes($_POST['raza']);
$especie = addslashes($_POST['especie']);
$color = addslashes($_POST['color']);
$sexo = addslashes($_POST['sexo']);
$peso = addslashes($_POST['peso']);
$tipo_peso = addslashes($_POST['tipo_peso']);

$mascotas_editar = mysqli_query($mysqli, "UPDATE mascotas SET nombre = '$nombre', fecha_nacimiento = '$fecha_nacimiento', edad = '$edad', raza='$raza', especie='$especie', color='$color', sexo='$sexo', peso='$peso', tipo_peso='$tipo_peso' where id_mascota = '$id_mascota'");
if ($mascotas_editar) {
	echo 0;
}else{
	echo 1;
}


?>