<?php 

session_start();

require("../../../conexion/conexion.php");

$id_imagen= $_POST['id_imagen'];
$imagen= $_POST['imagen'];

$id_v= $_POST['id_v'];
$id_m= $_POST['id_m'];

$visitas_imagenes = mysqli_query($mysqli, "DELETE FROM visitas_img where id_imagen = $id_imagen");
unlink("../../../assets/img/visitas/".$imagen);  

echo'
<script>
function redireccionarPagina() {
	window.location = "../../visitas/'.$id_v.'/'.$id_m.'";
}
setTimeout("redireccionarPagina()");
</script>
';




?>