<?php

session_start();
if (@!$_SESSION['correo']) {
	header("Location:../../desconectar");
}elseif ($_SESSION['rol']==1) {
	header("Location:../../desconectar");
}

require("../../../conexion/conexion.php");

$id_mascota=$_POST['id_mascota'];

$foto = $_FILES['foto'];
$nombre_foto = $foto['name'];
$type = $foto['type'];
$url_temp = $foto['tmp_name'];

if ($nombre_foto != '') {
	$destino = '../../../assets/img/mascotas/';
	$img_nombre = 'Mascota_'.md5(date('d-m-Y H:m:s'));
	$imgProducto = $img_nombre.'.jpg';
	$src = $destino.$imgProducto;
}


date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d h:i:s');


if($foto==true){

	if(isset($imgProducto) && !empty($imgProducto)){


		if ($nombre_foto != '') {
			move_uploaded_file($url_temp, $src);
		}

		//------------------ AGREGAR EL COMPROBANTE EN MEMBRESIA --------------------//
		mysqli_query($mysqli,"UPDATE mascotas_img SET imagen = '$imgProducto' where id_mascota = '$id_mascota'");
		//------------------ AGREGAR EL COMPROBANTE EN MEMBRESIA --------------------//

		echo 0;

	}else{

		echo 2;
	}

}else{

	echo 1;

}


?>
