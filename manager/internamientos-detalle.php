<?php

session_start();
if (@!$_SESSION['correo']) {
	header("Location:desconectar");
}elseif ($_SESSION['rol']==2) {
	header("Location:desconectar");
}

require("../conexion/conexion.php");
$monitoreo="SELECT dominio FROM monitoreo ";
$monitor=mysqli_query($mysqli,$monitoreo);
while ($moni=mysqli_fetch_row ($monitor)){
	$dominio=$moni[0];
}
?>

<!doctype html>
<html lang="en">

<head>
	<base href="<?php echo $dominio ?>/manager/internamientos-detalle.php" />
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
					<div class="breadcrumb-title pe-3">Detalle de la mascota</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="mascotas">Mascotas activas</a></li>
								<li class="breadcrumb-item" aria-current="page"><a href="mascotas/<?php echo $_GET['i'];?>">Detalle Mascota</a></li>
								<li class="breadcrumb-item active" aria-current="page">Internamiento</li>
							</ol>
						</nav>
					</div>
				</div>


				<?php

				require("../conexion/conexion.php");

				$id_pet=$_GET['i'];
				$id_internamiento=$_GET['in'];

				if($id_pet==true){

					$mascotas="SELECT * FROM mascotas WHERE id_mascota='$id_pet'";
					$mascota=mysqli_query($mysqli,$mascotas);

					$result = 0;
					$result = mysqli_num_rows($mascota);
					if ($result > 0) {
						while ($pets=mysqli_fetch_row ($mascota)){


							$id_mascota = $pets[0];
							$id_usuario = $pets[1];
							$nombre = $pets[2];
							$fecha_nacimiento = $pets[3];
							$edad = $pets[4];
							$raza = $pets[5];
							$especie = $pets[6];
							$color = $pets[7];
							$sexo = $pets[8];
							$peso = $pets[9];
							$tipo_peso = $pets[10];
							$fecha_registro = $pets[11];
							$estado = $pets[12];

							//IMAGENES
							$imagenes_m="SELECT imagen FROM mascotas_img WHERE id_mascota='$id_mascota'";
							$m_imagenes=mysqli_query($mysqli,$imagenes_m);
							while ($imagenes_v=mysqli_fetch_row ($m_imagenes)){
								$imagen_pet=$imagenes_v[0];
							}
							//IMAGENES


							$internamientos="SELECT * FROM internamientos WHERE id_internamiento='$id_internamiento'";
							$internamiento=mysqli_query($mysqli,$internamientos);
							while ($interno=mysqli_fetch_row ($internamiento)){

								$id_internamiento_i = $interno[0];
								$id_mascota_i = $interno[1];
								$fecha_entrada_i = $interno[2];
								$fecha_salida_i = $interno[3];
								$medicinas_aplicadas_i = $interno[4];
								$motivo_i = $interno[5];
								$antecedentes_i = $interno[6];
								$tratamiento_i = $interno[7];
								$fecha_registro_i = $interno[8];

							}

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
										<div class="row">
											<a href="javascript:history.back()">
												<div class="col-sm-12 d-grid gap-2">
													<button type="submit" class="btn btn-light px-4">Regresar</button>
												</div>
											</a>
										</div>
										<hr class="my-3" />
										<div class="d-flex flex-column align-items-center text-center">
											<img src="../assets/img/mascotas/<?php echo $imagen_pet ?>" alt="Admin" class="rounded-circle p-1 " width="190" height="190">
											<div class="mt-3">
												<h4><?php echo $nombre; ?></h4>
											</div>
										</div>
										<hr class="my-3" />
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Edad</h6>
												<span class="text-white"><?php echo $edad; ?></span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Raza</h6>
												<span class="text-white"><?php echo $raza; ?></span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Especie</h6>
												<span class="text-white"><?php echo $especie; ?></span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Sexo</h6>
												<span class="text-white"><?php echo $sexo; ?></span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Peso</h6>
												<span class="text-white"><?php echo $peso." ".$tipo_peso; ?></span>
											</li>
										</ul>

										<br>
										<br>
										<center>
											<h6>IMPRIMIR REPORTE</h6>
											<a href="pdf/reporte_internamiento?internamiento=<?php echo $id_internamiento_i ?>" target="blank">
												<img src="../assets/img/iconos/reporte.png" width="80">
											</a>
										</center>

									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9">
												<center><h5 class="mb-3">Internamiento de <?php echo $nombre ?></h5></center>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Fecha de entrada</h6>
											</div>
											<div class="col-sm-9">
												<input id="id_internamiento" value="<?php echo $id_internamiento_i; ?>" style="display: none;" />
												<input id="id_mascota" value="<?php echo $id_mascota_i; ?>" style="display: none;" />
												<input type="date" class="form-control" id="fecha_entrada" value="<?php echo $fecha_entrada_i; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Fecha de salida</h6>
											</div>
											<div class="col-sm-9">
												<input type="date" class="form-control" id="fecha_salida" value="<?php echo $fecha_salida_i; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Medicinas aplicadas</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="medicinas_aplicadas"><?php echo $medicinas_aplicadas_i; ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Motivo</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="motivo"><?php echo $motivo_i; ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Antecedentes</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="antecedentes"><?php echo $antecedentes_i; ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Tratamiento</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="tratamiento"><?php echo $tratamiento_i; ?></textarea>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 d-grid gap-2">
												<button type="button" class="btn btn-light px-4 btn-block" id="internamientos-editar">Actualizar información</button>
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
	<script src="validaciones/internamientos/js/internamientos-editar.js"></script>

</body>
</html>