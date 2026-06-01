<?php 

session_start();

require("../../../conexion/conexion.php");

$id_imagen= $_POST['id_imagen'];
$id_inventario= $_POST['id_inventario'];
$imagen= $_POST['imagen'];

$inventario_imagenes = mysqli_query($mysqli, "DELETE FROM inventario_img where id_imagen = $id_imagen");
unlink("../../../assets/img/inventario/".$imagen);  

echo'
<script>
function redireccionarPagina() {
	window.location = "../../inventario/'.$id_inventario.'";
}
setTimeout("redireccionarPagina()");
</script>
';




?>