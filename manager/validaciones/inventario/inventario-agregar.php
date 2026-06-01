<?php

session_start();

require("../../../conexion/conexion.php");

$nombre_articulo=$_POST['nombre_articulo'];
$numero_factura=$_POST['numero_factura'];
$fecha_ingreso=$_POST['fecha_ingreso'];
$proveedor=$_POST['proveedor'];
$cantidad_sugerida=$_POST['cantidad_sugerida'];
$stock=$_POST['stock'];
$precio_unitario=$_POST['precio_unitario'];
$precio_sugerido=$_POST['precio_sugerido'];
$descripcion=$_POST['descripcion'];
$fecha_vencimiento=$_POST['fecha_vencimiento'];
$codigo_barras=$_POST['codigo_barras'];

date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d h:i:s');

$foto = $_FILES['foto'];

if($foto==true){


	$query=mysqli_query($mysqli,"INSERT INTO inventario (nombre_articulo, detalle_articulo, numero_factura, fecha_ingreso, proveedor, cantidad_sugerida, stock, precio_unitario, precio_sugerido, fecha_vencimiento, codigo_barras, estado) VALUES('$nombre_articulo','$descripcion','$numero_factura','$fecha_ingreso','$proveedor','$cantidad_sugerida','$stock','$precio_unitario','$precio_sugerido','$fecha_vencimiento','$codigo_barras','0')");


	$query = mysqli_query($mysqli, "SELECT MAX(id_inventario) as id_inventario FROM inventario");
	$data = mysqli_fetch_array($query);
	$id_inventario = $data['id_inventario'];

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
