<?php 

session_start();

require("../../../conexion/conexion.php");

$id_mascota= $_POST['id_mascota'];

$visitas_imagenes = mysqli_query($mysqli, "UPDATE mascotas SET estado = '2' where id_mascota = $id_mascota");

echo'
<script>
function redireccionarPagina() {
	window.location = "../../mascotas";
}
setTimeout("redireccionarPagina()");
</script>
';




?>