<?php 

session_start();

require("../../../conexion/conexion.php");

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


$insertar1 = mysqli_query($mysqli, "INSERT INTO visitas (id_mascota, fecha, motivo, peso, tipo_peso, temperatura, sintomas, diagnostico, medicinas_aplicadas, visita_proxima, motivo_proximo, estado) VALUES('$id_mascota', '$fecha', '$motivo_v', '$peso_v', '$tipo_peso_v', '$temperatura_v', '$sintomas_v', '$diagnostico_v', '$medicinas_aplicadas_v', '$visita_proxima_v', '$motivo_proximo_v', '0')");


if ($insertar1) {


	/***************************** IMAGENES *****************************/
	$img_visitas="SELECT max(id_visita) FROM visitas ";
	$img_visitas_=mysqli_query($mysqli,$img_visitas);
	while ($img_visita=mysqli_fetch_row ($img_visitas_)){

		$id_imagen_visita=$img_visita[0];

		/*IMAGEN DINAMICA*/
		$foto = $_FILES['foto'];
		$nombre_foto = $foto['name'];
		$type = $foto['type'];
		$url_temp = $foto['tmp_name'];

		if ($nombre_foto != '') {
			$destino = '../../../assets/img/visitas/';
			$img_nombre = 'visita_'.$id_imagen_visita.'_'.md5(date('d-m-Y H:m:s'));
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
			$img_nombre = 'visita_'.$id_imagen_visita.'_'.$token;
			$imgProducto = $img_nombre.'.png';
			$src  = $destino.$imgProducto;

			move_uploaded_file($url_temp, $src);
			array_push($arrayFotos, $imgProducto);


			$insertar = mysqli_query($mysqli, "INSERT INTO visitas_img (id_visita, imagen, tipo_archivo) VALUES('$id_imagen_visita', '$imgProducto', 'imagen')");
		}
		/*IMAGEN DINAMICA*/

	}
	/***************************** IMAGENES *****************************/



	/***************************** PDF *****************************/
	$pdf_visitas="SELECT max(id_visita) FROM visitas ";
	$pdf_visitas_=mysqli_query($mysqli,$pdf_visitas);
	while ($pdf_visita=mysqli_fetch_row ($pdf_visitas_)){

		$id_pdf_visita=$pdf_visita[0];

		/*IMAGEN DINAMICA*/
		$foto2 = $_FILES['foto2'];
		$nombre_foto2 = $foto2['name'];
		$type = $foto2['type'];
		$url_temp = $foto2['tmp_name'];

		if ($nombre_foto2 != '') {
			$destino = '../../../assets/img/visitas/';
			$img_nombre = 'visita_'.$id_pdf_visita.'_'.md5(date('d-m-Y H:m:s'));
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
			$img_nombre = 'visita_'.$id_pdf_visita.'_'.$token;
			$imgProducto2 = $img_nombre.'.pdf';
			$src  = $destino.$imgProducto2;

			move_uploaded_file($url_temp, $src);
			array_push($arrayFotos2, $imgProducto2);


			$insertar = mysqli_query($mysqli, "INSERT INTO visitas_img (id_visita, imagen, tipo_archivo) VALUES('$id_pdf_visita', '$imgProducto2', 'pdf')");
		}
		/*IMAGEN DINAMICA*/

	}
	/***************************** PDF *****************************/

	echo 0;

}else{

	echo 1;

}





?>