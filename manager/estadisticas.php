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
	<link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
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
$configuracion="SELECT favicon, color_manager FROM configuracion ";
$config=mysqli_query($mysqli,$configuracion);
while ($conf=mysqli_fetch_row ($config)){
	$favicon=$conf[0];
	$color_manager=$conf[1];
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
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-12">

					<div class="col">
						<a href="usuarios">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Usuarios</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$usuario_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM usuarios");
												$usuario = mysqli_fetch_assoc($usuario_);
												echo $usuario["total"];
												?>
											</h4>
											<p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i><?php echo date('d-m-Y'); ?></p>
										</div>
										<div class="widgets-icons ms-auto"><i class='bx bxs-group'></i>
										</div>
									</div>
									<div id="chart1"></div>
								</div>
							</div>
						</a>
					</div>

					<div class="col">
						<a href="mascotas">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Mascotas</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$mascota_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM mascotas");
												$mascota = mysqli_fetch_assoc($mascota_);
												echo $mascota["total"];
												?>
											</h4>
											<p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i><?php echo date('d-m-Y'); ?></p>
										</div>
										<div class="widgets-icons ms-auto"><i class='bx bxs-donate-heart'></i>
										</div>
									</div>
									<div id="chart1"></div>
								</div>
							</div>
						</a>
					</div>

					<div class="col">
						<a href="doctores">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Doctores/Doctoras</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$doctores_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM doctores");
												$doctores = mysqli_fetch_assoc($doctores_);
												echo $doctores["total"];
												?>
											</h4>
											<p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i><?php echo date('d-m-Y'); ?></p>
										</div>
										<div class="widgets-icons ms-auto"><i class='bx bxs-vial'></i>
										</div>
									</div>
									<div id="chart1"></div>
								</div>
							</div>
						</a>
					</div>

					<div class="col">
						<a href="citas">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Citas activas</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$citas_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM citas WHERE estado='0'");
												$citas = mysqli_fetch_assoc($citas_);
												echo $citas["total"];
												?>
											</h4>
											<p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i><?php echo date('d-m-Y'); ?></p>
										</div>
										<div class="widgets-icons ms-auto"><i class='bx bxs-calendar'></i>
										</div>
									</div>
									<div id="chart1"></div>
								</div>
							</div>
						</a>
					</div>


					<div class="col">
						<a href="internamientos">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Internamientos activos</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$internos_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM internamientos WHERE estado='0'");
												$internos = mysqli_fetch_assoc($internos_);
												echo $internos["total"];
												?>
											</h4>
											<p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i><?php echo date('d-m-Y'); ?></p>
										</div>
										<div class="widgets-icons ms-auto"><i class='bx bxs-bookmark-heart'></i>
										</div>
									</div>
									<div id="chart1"></div>
								</div>
							</div>
						</a>
					</div>


					<div class="col">
						<a href="inventario">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Inventario</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$inventario_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM inventario WHERE estado='0'");
												$inventario = mysqli_fetch_assoc($inventario_);
												echo $inventario["total"];
												?>
											</h4>
											<p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i><?php echo date('d-m-Y'); ?></p>
										</div>
										<div class="widgets-icons ms-auto"><i class='bx bxs-box'></i>
										</div>
									</div>
									<div id="chart1"></div>
								</div>
							</div>
						</a>
					</div>


					<div class="col">
						<a href="ventas">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Ventas</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$ventas_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM ventas WHERE estado='0'");
												$ventas = mysqli_fetch_assoc($ventas_);
												echo $ventas["total"];
												?>
											</h4>
											<p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i><?php echo date('d-m-Y'); ?></p>
										</div>
										<div class="widgets-icons ms-auto"><i class='bx bxs-bullseye'></i>
										</div>
									</div>
									<div id="chart1"></div>
								</div>
							</div>
						</a>
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
	<script src="../assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="../assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="../assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="../assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="../assets/plugins/jquery-knob/excanvas.js"></script>
	<script src="../assets/plugins/jquery-knob/jquery.knob.js"></script>
	<script>
		$(function() {
			$(".knob").knob();
		});
	</script>
	<script src="../assets/js/index.js"></script>
	<script src="../assets/js/app.js"></script>
	
</body>
</html>