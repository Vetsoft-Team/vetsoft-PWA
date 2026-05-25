<?php 

session_start();

require("../../../conexion/conexion.php");

$pie_pagina= addslashes($_POST['pie_pagina']);

$configuracion_editar = mysqli_query($mysqli, "UPDATE configuracion SET pie_pagina = '$pie_pagina' where id_configuracion = '1'");
if ($configuracion_editar) {
	echo 0;
}else{
	echo 1;
}



?>