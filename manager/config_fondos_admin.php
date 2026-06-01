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
	<link href="../https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	<link href="../assets/css/sweetalert2.min.css" rel="stylesheet">
	<link href="../assets/css/style.css" rel="stylesheet">

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
					<div class="breadcrumb-title pe-3">Configuración de los fondos</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Fondos</li>
							</ol>
						</nav>
					</div>
				</div>


				<?php

				require("../conexion/conexion.php");

				$config_="SELECT * FROM configuracion WHERE id_configuracion='1'";
				$config=mysqli_query($mysqli,$config_);

				$result = 0;
				$result = mysqli_num_rows($config);
				if ($result > 0) {
					while ($conf=mysqli_fetch_row ($config)){

						$id_configuracion = $conf[0];
						$marca = $conf[1];
						$titulo = $conf[2];
						$favicon = $conf[3];
						$logo = $conf[4];
						$color = substr($conf[5], 8,9);
						$color_admin = substr($conf[6], 8, 9);
						$color_user = $conf[7];
						$pie_pagina = $conf[8];

					}
				}else{

					echo'
					<script>
					function redireccionarPagina() {
						window.location = "javascript:history.back()";
					}
					setTimeout("redireccionarPagina()");
					</script>
					';

				}



				?>

				<div class="container">
					<div class="main-body">

						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<hr class="my-3" />
										<div class="d-flex flex-column align-items-center text-center">
											<h5>FONDO DEL PANEL ADMIN</h5>
											<img src="../assets/images/bg-themes/<?php echo $color_admin ?>.png" alt="Admin" width="250" height="150">
										</div>
										<hr class="my-3" />
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-12">
												<center><h5 class="mb-3">ACTUALIZAR FONDO DEL PANEL ADMIN</h5></center>
											</div>
										</div>
										<div class="row mb-3">
											<center>
												<div class="photo">
													<br>
													<div class="prevPhoto">
														<span class="delPhoto notBlock">X</span>
														<label for="foto"></label>
													</div>
													<div class="upimg">
														<input type="file" id="foto">
													</div>
													<div id="form_alert"></div>
												</div>
												<small class="color_blanco">Sube aqui el nuevo fondo del panel admin<br>La imagen debe ser de 1920x1080</small>
											</center>

										</div>

										<div class="row">
											<div class="col-sm-12 d-grid gap-2">
												<button type="button" class="btn btn-light px-4 btn-block" id="fondos-admin">Actualizar información</button>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div style="margin-top: 165px;"></div>

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
	<script src="../assets/js/app.js"></script>
	<script src="../assets/js/sweetalert2.min.js"></script>
	<script src="validaciones/configuracion/js/configuracion-fondos-admin.js"></script>

</body>
</html>