<?php

$key=$_POST['key'];
$clave_usuario=$_POST['clave_usuario'];
$rclave_usuario=$_POST['rclave_usuario'];

require("../conexion/conexion.php");


if($key==null){
    
  echo "<script>location.href='../login'</script>";  
    
}else{
    


$checkemail=mysqli_query($mysqli,"SELECT * FROM usuarios WHERE clave='$key'");
$check_mail=mysqli_num_rows($checkemail);
if($clave_usuario==$rclave_usuario){

	if($check_mail>0){


		$veterinaria=sha1(trim($clave_usuario));
		
		$sentencia="update usuarios set clave='$veterinaria', estado='0' where clave='$key'";
		$resent=mysqli_query($mysqli,$sentencia);

		echo 1;

	}else{

		echo 2;


	}


}else{

	echo 0;

}

}

