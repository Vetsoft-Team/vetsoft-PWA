<?php 

session_start();

require("../../../conexion/conexion.php");

$id_visita= $_POST['id_visita'];

/***************************** IMAGENES *****************************/

/*IMAGEN DINAMICA*/
$foto = $_FILES['foto'];
$nombre_foto = $foto['name'];
$type = $foto['type'];
$url_temp = $foto['tmp_name'];

if ($nombre_foto != '') {
	$destino = '../../../assets/img/visitas/';
	$img_nombre = 'visita_'.$id_visita.'_'.md5(date('d-m-Y H:m:s'));
	$imgProducto = $img_nombre.'.png';
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

	$destino = '../../../assets/img/visitas/';
	$img_nombre = 'visita_'.$id_visita.'_'.$token;
	$imgProducto = $img_nombre.'.png';
	$src  = $destino.$imgProducto;

	move_uploaded_file($url_temp, $src);
	array_push($arrayFotos, $imgProducto);


	$insertar = mysqli_query($mysqli, "INSERT INTO visitas_img (id_visita, imagen, tipo_archivo) VALUES('$id_visita', '$imgProducto', 'imagen')");
}
/*IMAGEN DINAMICA*/


/***************************** IMAGENES *****************************/



/***************************** PDF *****************************/

/*IMAGEN DINAMICA*/
$foto2 = $_FILES['foto2'];
$nombre_foto2 = $foto2['name'];
$type = $foto2['type'];
$url_temp = $foto2['tmp_name'];

if ($nombre_foto2 != '') {
	$destino = '../../../assets/img/visitas/';
	$img_nombre = 'visita_'.$id_visita.'_'.md5(date('d-m-Y H:m:s'));
	$imgProducto2 = $img_nombre.'.pdf';
	$src = $destino.$imgProducto2;
}

$fotos2 = $_FILES['foto2'];
$arrayFotos2 = [];
$cantidad = count($_FILES['foto2']['name']);
for($i = 0; $i < $cantidad; $i++){
	$nombre_foto2 = $fotos2['name'][$i];
	$type = $fotos2['type'][$i];
	$url_temp = $fotos2['tmp_name'][$i];
	$imgProducto2 = '';
	$token = bin2hex(random_bytes(10));

	$destino = '../../../assets/img/visitas/';
	$img_nombre = 'visita_'.$id_visita.'_'.$token;
	$imgProducto2 = $img_nombre.'.pdf';
	$src  = $destino.$imgProducto2;

	move_uploaded_file($url_temp, $src);
	array_push($arrayFotos2, $imgProducto2);


	$insertar = mysqli_query($mysqli, "INSERT INTO visitas_img (id_visita, imagen, tipo_archivo) VALUES('$id_visita', '$imgProducto2', 'pdf')");
}
/*IMAGEN DINAMICA*/

/***************************** PDF *****************************/

echo 0;






?>