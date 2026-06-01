<?php

require("../../../conexion/conexion.php");

$foto = $_FILES['foto'];
$nombre_foto = $foto['name'];
$type = $foto['type'];
$url_temp = $foto['tmp_name'];

if ($nombre_foto != '') {
	$destino = '../../../assets/img/favicon/';
	$img_nombre = 'Favicon_'.md5(date('d-m-Y H:m:s'));
	$imgProducto = $img_nombre.'.png';
	$src = $destino.$imgProducto;
}


if($foto==true){

	if(isset($imgProducto) && !empty($imgProducto)){


		if ($nombre_foto != '') {
			move_uploaded_file($url_temp, $src);
		}

		//------------------ AGREGAR EL COMPROBANTE EN MEMBRESIA --------------------//
		mysqli_query($mysqli,"UPDATE configuracion SET favicon = '$imgProducto' where id_configuracion = '1'");
		//------------------ AGREGAR EL COMPROBANTE EN MEMBRESIA --------------------//

		echo 0;

	}else{

		echo 2;
	}

}else{

	echo 1;

}


?>
