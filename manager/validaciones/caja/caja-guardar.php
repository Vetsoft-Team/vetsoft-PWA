<?php

session_start();

require("../../../conexion/conexion.php");

$total_venta=$_POST['total_venta'];
$usuario_venta=$_POST['usuario_venta'];

date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d h:i:s');

$numero_aleatorio = rand(100000000000000,900000000000000);

$query= mysqli_query($mysqli,"INSERT INTO ventas(id_usuario, total, fecha_registro, cod, estado) VALUES('$usuario_venta','$total_venta','$fecha','$numero_aleatorio','0')");

$sql="SELECT * FROM caja";
$ressql=mysqli_query($mysqli,$sql);
while ($row=mysqli_fetch_row ($ressql)){

	$id_caja = $row[0];
	$id_usuario = $row[1];
	$id_inventario = $row[2];
	$precio = $row[3];
	$cantidad = $row[4];
	$total = $row[5];
	$fecha_registro = $row[6];

	/*-----------DETALLE VENTA---------*/
	$r = mysqli_query($mysqli, "SELECT max(id_venta) as id_venta FROM ventas");
	$f = mysqli_fetch_assoc($r);

	$id_venta=$f['id_venta'];

	$query= mysqli_query($mysqli,"INSERT INTO ventas_detalle (id_venta, id_usuario, id_inventario, precio, cantidad, total, fecha_registro, estado) VALUES('$id_venta','$usuario_venta','$id_inventario','$precio','$cantidad','$total','$fecha','0')");
	/*-----------DETALLE VENTA---------*/


	/*-----------RESTA DEL STOCK---------*/
	$sql_c2="SELECT * FROM inventario WHERE id_inventario='$id_inventario'";
	$ressql_c2=mysqli_query($mysqli,$sql_c2);
	while ($row_c2=mysqli_fetch_row ($ressql_c2)){

		$stock=$row_c2[7];

		$stock_total= $stock-$cantidad;

		mysqli_query($mysqli, "UPDATE inventario SET stock='$stock_total' WHERE id_inventario='$id_inventario'");

	}
	/*-----------RESTA DEL STOCK---------*/

}

$sql="DELETE FROM caja";
$ejecutar= $mysqli->query($sql);

echo 0;



?>
