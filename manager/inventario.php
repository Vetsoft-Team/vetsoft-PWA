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
	<!-- loader-->
	<link href="../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	
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
					<div class="breadcrumb-title pe-3">Inventario</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Productos en inventario</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-light">Opciones</button>
							<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	
								<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	
								<a class="dropdown-item" href="inventario">Lista de productos</a>
								<a class="dropdown-item" href="inventario-nuevo">Nuevo producto</a>
							</div>
						</div>
					</div>
				</div>

				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered" style="width:100%;">
								<thead style="background-color: #212529;">
									<tr>
										<th>Nombre articulo</th>
										<th>Nº factura</th>
										<th>Fecha ingreso</th>
										<th>Fecha vencimiento</th>
										<th>Stock</th>
										<th>Estado</th>
										<th>Detalle</th>
									</tr>
								</thead>
								<tbody>

									<?php

									require("../conexion/conexion.php");
									
									$inventarios="SELECT * FROM inventario";
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


										echo 
										'
										<tr>
										<td>'.htmlentities($nombre_articulo).'</td>
										<td>'.htmlentities($numero_factura).'</td>
										<td>'.htmlentities($fecha_ingreso).'</td>
										';

										date_default_timezone_set('America/Panama');
										$fecha_actual = date("Y-m-d");
										$fecha_actual_mas_3=date("Y-m-d",strtotime($fecha_actual."+ 3 days"));

										if($fecha_vencimiento<$fecha_actual){

											echo '<td>'.htmlentities($fecha_vencimiento).' <br> <p style="color: #DC0D00;">(PRODUCTO VENCIDO)</p></td>';

										}else if($fecha_actual_mas_3>=$fecha_vencimiento){

											echo '<td>'.htmlentities($fecha_vencimiento).' <br> <p style="color: #DC0D00;">(PROXIMO EN VENCER)</p></td>';

										}else{

											echo '<td>'.htmlentities($fecha_vencimiento).'</td>';

										}

										if($stock>=1){

											echo '<td style="color: #2AB900;">'.htmlentities($stock).' Und</td>';

										}else{

											echo '<td style="color: #DC0D00;">SIN STOCK</td>';

										}
										

										if($estado=='0'){

											echo '<td><span class="badge bg-success">ACTIVO</span></td>';

										}else{

											echo '<td><span class="badge bg-danger">INACTIVO</span></td>';

										}

										echo
										'
										<td><a href="inventario/'.htmlentities($id_inventario).'"><button type="button" class="btn btn-outline-success px-3 radius-30">Historial</button></a></td>
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

	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
			.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>

	<script src="../assets/js/app.js"></script>

</body>
</html>