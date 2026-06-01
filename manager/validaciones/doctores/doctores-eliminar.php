<?php 

session_start();

require("../../../conexion/conexion.php");

$id_doctor= $_POST['id_doctor'];

$doctores_eliminar = mysqli_query($mysqli, "DELETE FROM doctores where id_doctor = $id_doctor"); 

echo'
<script>
function redireccionarPagina() {
	window.location = "../../doctores";
}
setTimeout("redireccionarPagina()");
</script>
';




?>