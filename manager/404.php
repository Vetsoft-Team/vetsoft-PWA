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

	<link href="../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../assets/js/pace.min.js"></script>
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
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
$configuracion="SELECT marca, logo, color_manager, telefono FROM configuracion ";
$config=mysqli_query($mysqli,$configuracion);
while ($conf=mysqli_fetch_row ($config)){
	$marca=$conf[0];
	$logo=$conf[1];
	$color_manager=$conf[2];
	$whatsapp=$conf[3];
}
?>


<body class="bg-theme <?php echo $color_manager ?>">

	<div class="wrapper">
		<nav class="navbar navbar-expand-lg navbar-light bg-light rounded fixed-top rounded-0 shadow-sm">
			<div class="container-fluid">
				<a class="navbar-brand" href="index">
					<h4><img src="../assets/img/logo/<?php echo $logo ?>" width="30" alt="" /> <?php echo $marca ?></h4>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent1">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item"> <a class="nav-link text-white" aria-current="page" href="index"><i class='bx bx-home-alt me-1'></i>Inicio</a>
						</li>
						<li class="nav-item"> <a class="nav-link text-white" href="estadisticas"><i class='bx bx-category me-1'></i>Estadistica</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="error-404 d-flex align-items-center justify-content-center">
			<div class="container">
				<div class="card py-5">
					<div class="row g-0">
						<div class="col col-xl-6">
							<center>
								<div class="card-body p-4">
									<h1 class="display-1"><span class="text-white">4</span><span class="text-white">0</span><span class="text-white">4</span></h1>
									<h5 class="font-weight-bold display-6">¡Ups! No se puede encontrar esa página.</h5>
									<p>Parece que no se encontró nada en esta ubicación.</p>
									<div class="mt-5"> 
										<a href="index" class="btn btn-light btn-lg px-md-5 radius-30">INICIO</a>
									</div>
								</div>
							</center>
						</div>
						<div class="col-xl-6">
							<center>
								<img src="../assets/img/logo/<?php echo $logo ?>" class="img-fluid" alt="" style="width: 60%;">
							</center>
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
		</div>
		<div class="bg-light p-3 fixed-bottom border-top shadow">
			<div class="d-flex align-items-center justify-content-between flex-wrap">
				<?php
				require("../conexion/conexion.php");
				$configuracion="SELECT pie_pagina FROM configuracion ";
				$config=mysqli_query($mysqli,$configuracion);
				while ($conf=mysqli_fetch_row ($config)){
					$pie_pagina=$conf[0];

					echo '<p class="mb-0">'.htmlentities($pie_pagina).'</p>';
				}
				?>
			</div>
		</div>
	</div>
	<!-- end wrapper -->

	<!-- Bootstrap JS -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="../assets/js/jquery.min.js"></script>

</body>


</html>