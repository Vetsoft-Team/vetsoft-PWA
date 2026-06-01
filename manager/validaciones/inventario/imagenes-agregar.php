<?php

session_start();

require("../../../conexion/conexion.php");

$id_inventario=$_POST['id_inventario'];

$foto = $_FILES['foto'];

if($foto==true){

	/*IMAGEN DINAMICA*/
	$foto = $_FILES['foto'];
	$nombre_foto = $foto['name'];
	$type = $foto['type'];
	$url_temp = $foto['tmp_name'];

	if ($nombre_foto != '') {
		$destino = '../../../img_/img_plantillas/';
		$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		$imgProducto = $img_nombre.'.jpg';
		$src = $destino.$imgProducto;
	}

	$fotos = $_FILES['foto'];
	$arrayFotos = [];
	$cantidad = count($_FILES['foto']['name']);
	for($i = 0; $i < $cantidad; $i++){
		$nombre_foto = $fotos['name'][$i];
		$type = $fotos['type'][$i];
		$url_temp = $fotos['tmp_name'][$i];
		$imgProducto = '';
		$token = bin2hex(random_bytes(10));

		$destino = '../../../assets/img/inventario/';
		$img_nombre = 'Producto_'.$token;
		$imgProducto = $img_nombre.'.jpg';
		$src  = $destino.$imgProducto;

		move_uploaded_file($url_temp, $src);
		array_push($arrayFotos, $imgProducto);

		$insertar = mysqli_query($mysqli, "INSERT INTO inventario_img (id_inventario, imagen) VALUES('$id_inventario', '$imgProducto')");
	}
	/*IMAGEN DINAMICA*/


	echo 0;

}else{

	echo 1;
}



?>
