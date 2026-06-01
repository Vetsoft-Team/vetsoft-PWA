<?php 

session_start();

require("../../../conexion/conexion.php");

$id_visita= addslashes($_POST['id_visita']);
$id_mascota= addslashes($_POST['id_mascota']);
$motivo_v= addslashes($_POST['motivo_v']);
$peso_v= addslashes($_POST['peso_v']);
$tipo_peso_v= addslashes($_POST['tipo_peso_v']);
$temperatura_v= addslashes($_POST['temperatura_v']);
$diagnostico_v= addslashes($_POST['diagnostico_v']);
$sintomas_v= addslashes($_POST['sintomas_v']);
$medicinas_aplicadas_v= addslashes($_POST['medicinas_aplicadas_v']);
$visita_proxima_v= addslashes($_POST['visita_proxima_v']);
$motivo_proximo_v= addslashes($_POST['motivo_proximo_v']);

date_default_timezone_set('America/Panama');    
$fecha = date('Y-m-d h:i:s');


$visitas_editar = mysqli_query($mysqli, "UPDATE visitas SET motivo = '$motivo_v', peso = '$peso_v', tipo_peso = '$tipo_peso_v', temperatura = '$temperatura_v', sintomas = '$sintomas_v', diagnostico = '$diagnostico_v', medicinas_aplicadas = '$medicinas_aplicadas_v', visita_proxima = '$visita_proxima_v', motivo_proximo = '$motivo_proximo_v' where id_visita = '$id_visita' and id_mascota='$id_mascota'");
if ($visitas_editar) {
	echo 0;
}else{
	echo 1;
}


?>