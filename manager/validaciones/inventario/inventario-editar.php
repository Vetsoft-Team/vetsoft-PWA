<?php 

session_start();

require("../../../conexion/conexion.php");

$id_inventario=$_POST['id_inventario'];
$nombre_articulo=$_POST['nombre_articulo'];
$numero_factura=$_POST['numero_factura'];
$fecha_ingreso=$_POST['fecha_ingreso'];
$proveedor=$_POST['proveedor'];
$cantidad_sugerida=$_POST['cantidad_sugerida'];
$stock=$_POST['stock'];
$precio_unitario=$_POST['precio_unitario'];
$precio_sugerido=$_POST['precio_sugerido'];
$descripcion=$_POST['descripcion'];
$fecha_vencimiento=$_POST['fecha_vencimiento'];
$codigo_barras=$_POST['codigo_barras'];

$inventario_editar = mysqli_query($mysqli, "UPDATE inventario SET nombre_articulo = '$nombre_articulo', numero_factura = '$numero_factura', fecha_ingreso = '$fecha_ingreso', proveedor='$proveedor', cantidad_sugerida='$cantidad_sugerida', stock='$stock', precio_unitario='$precio_unitario', precio_sugerido='$precio_sugerido', detalle_articulo='$descripcion', fecha_vencimiento='$fecha_vencimiento', codigo_barras='$codigo_barras' where id_inventario = '$id_inventario'");
if ($inventario_editar) {
	echo 0;
}else{
	echo 1;
}


?>