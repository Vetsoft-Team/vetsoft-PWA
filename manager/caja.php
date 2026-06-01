<?php 

session_start();
if (@!$_SESSION['correo']) {
	header("Location:desconectar");
}elseif ($_SESSION['rol']==2) {
	header("Location:desconectar");
}

?>
<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Favicon/Icono -->
	<?php include'include/favicon.php' ?>
	<!-- Favicon/Icono -->

	<!--plugins-->
	<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- Bootstrap CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	<link href="../assets/css/sweetalert2.min.css" rel="stylesheet">
	
	<!-- Titulo -->
	<?php include'include/title.php' ?>
	<!-- Titulo -->

</head>

<?php
require("../conexion/conexion.php");
$configuracion="SELECT color_manager FROM configuracion ";
$config=mysqli_query($mysqli,$configuracion);
while ($conf=mysqli_fetch_row ($config)){
	$color_manager=$conf[0];
}
?>

<body class="bg-theme <?php echo $color_manager ?>">
	<!--wrapper-->
	<div class="wrapper">

		<!-- Wrapper -->
		<?php include'include/wrapper.php' ?>
		<!-- Wrapper -->
		
		<!-- Header -->
		<?php include'include/header.php' ?>
		<!-- Header -->


		<div class="page-wrapper">
			<div class="page-content">

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Caja de cobro</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Caja menor</li>
							</ol>
						</nav>
					</div>
				</div>

				<hr/>

				<div class="row">

					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="caja_" class="table table-striped table-bordered" style="width:100%;">
										<thead style="background-color: #212529;">
											<tr>
												<th>Imagen</th>
												<th>Nombre articulo</th>
												<th>Precio</th>
												<th>Cantidad</th>
												<th>Detalle</th>
											</tr>
										</thead>
										<tbody>

											<?php

											require("../conexion/conexion.php");

											date_default_timezone_set('America/Panama');
											$fecha_actual = date("Y-m-d");

											$inventarios="SELECT * FROM inventario WHERE estado='0' and fecha_vencimiento>'$fecha_actual' and stock>='1' ";
											$inventario=mysqli_query($mysqli,$inventarios);
											while ($invent=mysqli_fetch_row ($inventario)){

												$id_inventario = $invent[0];
												$nombre_articulo = $invent[1];
												$detalle_articulo = $invent[2];
												$numero_factura = $invent[3];
												$fecha_ingreso = $invent[4];
												$proveedor = $invent[5];
												$cantidad_sugerida = $invent[6];
												$stock = $invent[7];
												$precio_unitario = $invent[8];
												$precio_sugerido = $invent[9];
												$fecha_vencimiento = $invent[10];
												$codigo_barras = $invent[11];
												$estado = $invent[12];

												//IMAGENES
												$imagenes_i="SELECT imagen FROM inventario_img WHERE id_inventario='$id_inventario'";
												$i_imagenes=mysqli_query($mysqli,$imagenes_i);
												while ($imagenes_v=mysqli_fetch_row ($i_imagenes)){
													$imagen_inv=$imagenes_v[0];
												}
												//IMAGENES

												$cajasxi_="SELECT * FROM caja WHERE id_inventario='$id_inventario' ";
												$caja_xi=mysqli_query($mysqli,$cajasxi_);
												$result = 0;
												$result = mysqli_num_rows($caja_xi);
												if ($result > 0) {
													while ($cajaxi=mysqli_fetch_row ($caja_xi)){
														$id_inventario_xi=$cajaxi[2];
													}
												}else{
													$id_inventario_xi='0';
												}

												echo 
												'
												<tr>
												<td><img src="../assets/img/inventario/'.$imagen_inv.'" class="rounded-circle p-1 " width="60" height="60"></td>
												<td>'.htmlentities($nombre_articulo).'</td>
												<td>'.htmlentities(number_format($precio_sugerido)).'</td>

												<form action="validaciones/caja/caja-agregar" method="POST">
												<td>
												<input name="id_inventario" value="'.$id_inventario.'" style="display: none;" />
												<input type="number" class="form-control" name="cantidad" placeholder="" style="width:80px;" min="1" max="'.$stock.'" onkeypress="return valideKey(event);" required>
												<input name="precio" value="'.$precio_sugerido.'" style="display: none;" />
												</td>
												';
												if($id_inventario==$id_inventario_xi){
													echo'<td><button type="button" class="btn btn-outline-success px-3 radius-30"><i class="bx bx-check-double"></i></button></td>';	
												}else{
													echo'<td><button type="submit" class="btn btn-outline-info px-3 radius-30"><i class="bx bx-chevron-right-circle"></i></button></td>';
												}
												echo'
												</form>
												</tr>
												';
											}

											?>
										</tbody>

									</table>
								</div>
							</div>
						</div>

					</div>

					<div class="col-md-6">
						<center><h4>PRODUCTOS SELECCIONADOS</h4></center>
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="caja_menor" class="table table-striped table-bordered" style="width:100%;">
										<thead style="background-color: #212529;">
											<tr>
												<th>Producto</th>
												<th>Cantidad</th>
												<th>Precio</th>
												<th>Total</th>
												<th>Detalle</th>
											</tr>
										</thead>
										<tbody>

											<?php

											require("../conexion/conexion.php");

											$cajas="SELECT * FROM caja ORDER BY id_caja DESC";
											$caja_=mysqli_query($mysqli,$cajas);
											while ($caja=mysqli_fetch_row ($caja_)){

												$id_caja_c = $caja[0];
												$id_usuario_c = $caja[1];
												$id_inventario_c = $caja[2];
												$precio_c = $caja[3];
												$cantidad_c = $caja[4];
												$total_c = $caja[5];
												$fecha_registro_c = $caja[6];

												//IMAGENES
												$imagenes_c="SELECT imagen FROM inventario_img WHERE id_inventario='$id_inventario_c'";
												$c_imagenes=mysqli_query($mysqli,$imagenes_c);
												while ($imagenes_vc=mysqli_fetch_row ($c_imagenes)){
													$imagen_caja=$imagenes_vc[0];
												}
												//IMAGENES

												echo 
												'
												<tr>
												<td><img src="../assets/img/inventario/'.$imagen_caja.'" class="rounded-circle p-1 " width="60" height="60"></td>
												<td>'.htmlentities($cantidad_c).'</td>
												<td>'.htmlentities(number_format($precio_c)).'</td>
												<td>'.htmlentities(number_format($total_c)).'</td>


												<td>
												<form action="validaciones/caja/caja-eliminar" method="POST">
												<input name="id_caja" value="'.$caja[0].'" style="display: none;" />
												<button type="submit" class="btn btn-outline-danger px-3 radius-30"><i class="bx bx-x"></i></button>
												</form>
												</td>

												</tr>
												';


												$subcaja="SELECT SUM(total) as subtotal FROM caja";
												$subcaja_=mysqli_query($mysqli,$subcaja);
												$result2 = 0;
												$result2 = mysqli_num_rows($subcaja_);
												if ($result2 > 0) {
													while ($subt=mysqli_fetch_row ($subcaja_)){
														$subtotal=$subt[0];
													}
												}else{
													$subtotal=0;
												}


											}

											?>
										</tbody>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th>SubTotal:</th>
												<th><?php error_reporting(0); echo number_format($subtotal) ?></th>
												<th></th>
											</tr>
										</tfoot>

									</table>

									<br>

									<label>Venta dirigida a:</label>

									<!-------- VERIFICA LA ULTIMA VENTA ---------->
									<?php 
									$r = mysqli_query($mysqli, "SELECT max(id_venta) as id_venta FROM ventas");
									$f = mysqli_fetch_assoc($r);
									$id_venta=$f['id_venta']+1;
									?>
									<!-------- VERIFICA LA ULTIMA VENTA ---------->

									<input type="text" id="total_venta" value="<?php echo $subtotal ?>" style="display: none;">
									<input type="text" id="id_ultima_venta" value="<?php echo $id_venta ?>" style="display: none;">
									<select class="form-control" id="usuario_venta">
										<option value="1">Venta comun</option>
										<?php
										require("../conexion/conexion.php");
										$sql=("SELECT * FROM usuarios ORDER BY id_usuario DESC");
										$query=mysqli_query($mysqli,$sql);
										while($arreglo=mysqli_fetch_array($query)){
											$id_usuario = $arreglo['id_usuario'];
											$nombre = $arreglo['nombre'];
											$apellidos = $arreglo['apellidos'];
											echo '<option value="'.$id_usuario.'" style="color: black;">'.$nombre.' '.$apellidos.'</option>';
										}
										?>
									</select>
									<small>No es obligatorio elegir un usuario</small>
									<br>
									<br>

									<?php 

									if($subtotal>0){

										echo '<button type="button" id="caja-agregar" class="btn btn-outline-success px-3 radius-30" style="width: 100%;">GUARDAR VENTA</button>';

									}else{

										echo '<button type="button" id="caja-agregar" class="btn btn-outline-success px-3 radius-30" style="width: 100%;" disabled>GUARDAR VENTA</button>';

									}

									?>

								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="overlay toggle-icon"></div>
			<a class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

			<!-- Footer -->
			<?php include'include/footer.php' ?>
			<!-- Footer -->

		</div>

		<script src="../assets/js/bootstrap.bundle.min.js"></script>
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
		<script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
		<script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
		<script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
		<script src="../assets/js/sweetalert2.min.js"></script>
		<script src="validaciones/caja/js/caja-guardar.js"></script>

		<script>
			$(document).ready(function() {
				$('#caja_').DataTable()
			});

		</script>

		<script type="text/javascript">
			function valideKey(evt){
    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;
    
    if(code==8) { // backspace.
    	return true;
    } else if(code>=48 && code<=57) { // is a number.
    	return true;
    } else{ // other keys.
    	return false;
    }
}
</script> 

<script src="../assets/js/app.js"></script>

</body>
</html>