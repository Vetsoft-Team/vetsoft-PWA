<?php 

session_start();

require("../../../conexion/conexion.php");

$id_cita= $_POST['id_cita'];
$id_mascota= $_POST['id_mascota'];

$citas_eliminar = mysqli_query($mysqli, "DELETE FROM citas where id_cita = $id_cita"); 
$calendario_eliminar = mysqli_query($mysqli, "DELETE FROM calendario where id_cita = $id_cita"); 

echo'
<script>
function redireccionarPagina() {
	window.location = "../../mascotas/'.$id_mascota.'";
}
setTimeout("redireccionarPagina()");
</script>
';




?>