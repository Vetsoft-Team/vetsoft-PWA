<?php 

session_start();
if (@!$_SESSION['correo']) {
	header("Location:../../desconectar");
}elseif ($_SESSION['rol']==1) {
	header("Location:../../desconectar");
}

require("../../../conexion/conexion.php");

$id_usuario = $_SESSION['id_usuario'];
$nombre = addslashes($_POST['nombre']);
$fecha_nacimiento = addslashes($_POST['fecha_nacimiento']);
$edad = addslashes($_POST['edad']);
$raza = addslashes($_POST['raza']);
$especie = addslashes($_POST['especie']);
$color = addslashes($_POST['color']);
$sexo = addslashes($_POST['sexo']);
$peso = addslashes($_POST['peso']);
$tipo_peso = addslashes($_POST['tipo_peso']);


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

		$query=mysqli_query($mysqli,"INSERT INTO mascotas (id_usuario, nombre, fecha_nacimiento, edad, raza, especie, color, sexo, peso, tipo_peso, fecha_registro, estado) VALUES('$id_usuario','$nombre','$fecha_nacimiento','$edad','$raza','$especie','$color','$sexo','$peso','$tipo_peso','$fecha','1')");

		$mascotas_="SELECT max(id_mascota) FROM mascotas ";
		$mascotas2_=mysqli_query($mysqli,$mascotas_);
		while ($pets=mysqli_fetch_row ($mascotas2_)){

			$id_mascota=$pets[0];

			$query2=mysqli_query($mysqli,"INSERT INTO mascotas_img (id_mascota, imagen) VALUES('$id_mascota','$imgProducto')");
			echo 0;
		}


	}else{

		echo 2;
	}

}else{

	echo 1;

}




?>