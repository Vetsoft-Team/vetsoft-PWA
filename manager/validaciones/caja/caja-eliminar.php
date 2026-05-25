<?php 

session_start();

require("../../../conexion/conexion.php");

$id_caja= $_POST['id_caja'];

$caja_imagenes = mysqli_query($mysqli, "DELETE FROM caja where id_caja = $id_caja"); 

echo'
<script>
function redireccionarPagina() {
	window.location = "javascript:history.back()";
}
setTimeout("redireccionarPagina()");
</script>
';

?>