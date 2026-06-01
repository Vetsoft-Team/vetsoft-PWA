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
					<div class="breadcrumb-title pe-3">Internamientos</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Mascotas Internadas</li>
							</ol>
						</nav>
					</div>
				</div>

				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="internamientos_" class="table table-striped table-bordered" style="width:100%;">
								<thead style="background-color: #212529;">
									<tr>
										<th>Fecha de entrada</th>
										<th>Medicina</th>
										<th>Motivo</th>
										<th>Dias internado</th>
										<th>Estado</th>
										<th>Detalle</th>
									</tr>
								</thead>
								<tbody>

									<?php

									require("../conexion/conexion.php");

									$internamientos="SELECT id_internamiento, fecha_entrada, fecha_salida, medicinas_aplicadas, motivo, TIMESTAMPDIFF(DAY, fecha_entrada, curdate() ), id_mascota, estado FROM internamientos ORDER BY estado ASC";
									$internamiento=mysqli_query($mysqli,$internamientos);
									while ($interna=mysqli_fetch_row ($internamiento)){

										echo 
										'
										<tr>
										<td>'.htmlentities($interna[1]).'</td>
										<td>'.htmlentities($interna[3]).'</td>
										<td>'.htmlentities($interna[4]).'</td>
										';

										$fecha1= new DateTime($interna[1]);
										$fecha2= new DateTime($interna[2]);
										$diff = $fecha1->diff($fecha2);

										if($interna[2]==true){

											echo '<td>'.$diff->days.' dias</td>';

										}else{

											echo '<td>'.htmlentities($interna[5]).' dias</td>';
										}


										if($interna[7]==0){

											echo '<td><span class="badge bg-success">INTERNADO</span></td>';

										}else{

											echo '<td><span class="badge bg-danger">DADO DE ALTA</span></td>';

										}

										echo
										'
										<td><a href="internamientos/'.htmlentities($interna[0]).'/'.htmlentities($interna[6]).'"><button type="button" class="btn btn-outline-success px-3 radius-30">Vista previa</button></a></td>
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
			$('#internamientos_').DataTable()
		});

	</script>
	<script src="../assets/js/app.js"></script>

</body>
</html>