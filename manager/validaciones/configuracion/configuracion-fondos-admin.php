<?php

require("../../../conexion/conexion.php");

$foto = $_FILES['foto'];

if($foto==true){

	unlink("../../../assets/images/bg-themes/6.png");

	$nombre_foto = $foto['name'];
	$type = $foto['type'];
	$url_temp = $foto['tmp_name'];

	if ($nombre_foto != '') {
		$destino = '../../../assets/images/bg-themes/';
		$img_nombre = '6';
		$imgProducto = $img_nombre.'.png';
		$src = $destino.$imgProducto;
	}

	if(isset($imgProducto) && !empty($imgProducto)){


		if ($nombre_foto != '') {
			move_uploaded_file($url_temp, $src);
		}

		echo 0;

	}else{

		echo 2;
	}

}else{

	echo 1;

}


?>
