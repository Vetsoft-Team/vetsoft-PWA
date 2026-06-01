<?php

session_start();

require("../../conexion/conexion.php");

$correo=$_POST['correo'];
$clave=$_POST['clave'];
$ip=$_SERVER['REMOTE_ADDR'];

$veterinaria=sha1(trim($clave));


$sql=mysqli_query($mysqli,"SELECT * FROM usuarios WHERE correo='$correo'");

if($f=mysqli_fetch_array($sql)){

	if($veterinaria==$f['clave']){

		$_SESSION['id_usuario']=$f['id_usuario'];
		$_SESSION['nombre']=$f['nombre'];
		$_SESSION['apellidos']=$f['apellidos'];
		$_SESSION['ciudad']=$f['ciudad'];
		$_SESSION['correo']=$f['correo'];
		$_SESSION['telefono']=$f['telefono'];
		$_SESSION['clave']=$f['clave'];
		$_SESSION['ultima_conexion']=$f['ultima_conexion'];
		$_SESSION['fecha_registro']=$f['fecha_registro'];
		$_SESSION['ip']=$f['ip'];
		$_SESSION['estado']=$f['estado'];
		$_SESSION['rol']=$f['rol'];

		date_default_timezone_set('America/Panama');    
		$ultima_conexion = date('Y-m-d h:i:s');


		if($f['rol']==1 || $f['rol']==3){

			mysqli_query($mysqli, "UPDATE usuarios SET ultima_conexion = '$ultima_conexion', ip = '$ip' WHERE id_usuario ='".$f['id_usuario']."'");
			$actividad = mysqli_query($mysqli, "INSERT INTO actividad (id_usuario, ip, fecha) VALUES('".$f['id_usuario']."', '$ip', '$ultima_conexion')");
			echo 1;

		}else{

			if($f['estado']==0){

				mysqli_query($mysqli, "UPDATE usuarios SET ultima_conexion = '$ultima_conexion', ip = '$ip' WHERE id_usuario ='".$f['id_usuario']."'");
				$actividad = mysqli_query($mysqli, "INSERT INTO actividad (id_usuario, ip, fecha) VALUES('".$f['id_usuario']."', '$ip', '$ultima_conexion')");
				echo 2;

			}else if($f['estado']==1){

				echo 3;

			}else{

				echo 4;
			}


		}


	}else{

		echo 5;

	}


}else{

	echo 6;

}


?>    

