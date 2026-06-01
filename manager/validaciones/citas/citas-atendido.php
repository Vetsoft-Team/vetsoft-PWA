<?php 

session_start();

require("../../../conexion/conexion.php");

$id_cita= $_POST['id_cita'];
$id_mascota= $_POST['id_mascota'];

$citas_editar = mysqli_query($mysqli, "UPDATE citas SET estado = '1' where id_cita = '$id_cita' and id_mascota='$id_mascota'");

$citas_editar = mysqli_query($mysqli, "UPDATE calendario SET color = '#A00000' where id_cita = '$id_cita' and id_mascota='$id_mascota'");

echo'
<script>
function redireccionarPagina() {
	window.location = "../../mascotas/'.$id_mascota.'";
}
setTimeout("redireccionarPagina()");
</script>
';




?>