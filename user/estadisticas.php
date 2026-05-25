<?php 

session_start();
if (@!$_SESSION['correo']) {
	header("Location:desconectar");
}elseif ($_SESSION['rol']==1) {
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
	<link href="../assets/css/style.css" rel="stylesheet">
		
	<!-- Titulo -->
	<?php include'include/title.php' ?>
	<!-- Titulo -->

</head>

<?php
require("../conexion/conexion.php");
$configuracion="SELECT favicon, color_user FROM configuracion ";
$config=mysqli_query($mysqli,$configuracion);
while ($conf=mysqli_fetch_row ($config)){
	$favicon=$conf[0];
	$color_user=$conf[1];
}
?>

<body class="bg-theme <?php echo $color_user ?>">
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
						<a href="mascotas">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Mascotas activas</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$mascota_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM mascotas WHERE id_usuario='".$_SESSION['id_usuario']."' and estado='0' ");
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
						<a href="mascotas">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Mascotas pendientes</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$mascota_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM mascotas WHERE id_usuario='".$_SESSION['id_usuario']."' and estado='1' ");
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
						<a href="citas">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Citas pendientes</p>
											<h4 class="my-1">
												<?php
												require("../conexion/conexion.php");
												$citas_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM citas c inner join mascotas m on c.id_mascota=m.id_mascota WHERE m.id_usuario='".$_SESSION['id_usuario']."' and c.estado='0' ");
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
						<div class="card radius-10" style="border: 1px solid white;">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Internamientos activos</p>
										<h4 class="my-1">
											<?php
											require("../conexion/conexion.php");
											$internos_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM internamientos i inner join mascotas m on i.id_mascota=m.id_mascota  WHERE m.id_usuario='".$_SESSION['id_usuario']."' and i.estado='0' ");
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
					</div>

					<div class="col">
						<a href="productos">
							<div class="card radius-10" style="border: 1px solid white;">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">Productos disponibles en tienda</p>
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