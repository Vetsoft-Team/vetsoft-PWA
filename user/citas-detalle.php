<?php

session_start();
if (@!$_SESSION['correo']) {
	header("Location:desconectar");
}elseif ($_SESSION['rol']==1) {
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
	<base href="<?php echo $dominio ?>/user/citas-detalle.php" />
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
$configuracion="SELECT color_user FROM configuracion ";
$config=mysqli_query($mysqli,$configuracion);
while ($conf=mysqli_fetch_row ($config)){
	$color_user=$conf[0];
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

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Detalle de la mascota</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="mascotas">Mascotas activas</a></li>
								<li class="breadcrumb-item" aria-current="page"><a href="mascotas/<?php echo $_GET['i'];?>">Detalle Mascota</a></li>
								<li class="breadcrumb-item active" aria-current="page">Cita</li>
							</ol>
						</nav>
					</div>
				</div>


				<?php

				require("../conexion/conexion.php");

				$id_pet=$_GET['i'];
				$id_cita=$_GET['c'];

				if($id_pet==true){

					$mascotas="SELECT * FROM mascotas WHERE id_mascota='$id_pet' and id_usuario='".$_SESSION['id_usuario']."' ";
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


							$citas="SELECT * FROM citas WHERE id_cita='$id_cita' and id_mascota='$id_mascota'";
							$cita=mysqli_query($mysqli,$citas);
							$result2 = 0;
							$result2 = mysqli_num_rows($cita);
							if ($result2 > 0) {
								while ($cit=mysqli_fetch_row ($cita)){

									$id_cita_c = $cit[0];
									$id_mascota_c = $cit[1];
									$fecha_cita_c = $cit[2];
									$hora_cita_c = $cit[3];
									$doctor_c = $cit[4];
									$motivo_c = $cit[5];
									$fecha_registro_c = $cit[6];
									$estado_c = $cit[7];

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


							$doctores="SELECT * FROM doctores WHERE id_doctor='$doctor_c'";
							$doctores_=mysqli_query($mysqli,$doctores);
							while ($doctor=mysqli_fetch_row ($doctores_)){

								$nombre_doctor = $doctor[1];
								$apellido_doctor = $doctor[2];

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

									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9">
												<center><h5 class="mb-3">Cita para el <?php echo $fecha_cita_c." ".$hora_cita_c ?></h5></center>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Fecha de la cita</h6>
											</div>
											<div class="col-sm-9">
												<input type="date" class="form-control" id="fecha_cita" min="<?php echo date('Y-m-d')?>" value="<?php echo $fecha_cita_c; ?>" readonly/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Hora de la cita</h6>
											</div>
											<div class="col-sm-9">
												<input type="time" class="form-control" id="hora_cita" value="<?php echo $hora_cita_c; ?>" readonly/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Doctor</h6>
											</div>
											<div class="col-sm-9">
												<select class="form-control" id="doctor_cita" readonly>
													<option value="<?php echo $doctor_c ?>"><?php echo $nombre_doctor." ".$apellido_doctor ?></option>
												</select>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Motivo</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="motivo" readonly><?php echo $motivo_c; ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Estado</h6>
											</div>
											<div class="col-sm-9">
												<?php 

												if($estado_c==0){

													echo 
													'
													<button type="button" class="btn btn-warning px-5" style="width:100%;">PENDIENTE</button>
													';

												}else if($estado_c==1){

													echo 
													'
													<button type="button" class="btn btn-success px-5" style="width:100%;">ASISTIO</button>
													';

												}else{

													echo 
													'
													<button type="button" class="btn btn-danger px-5" style="width:100%;">NO ASISTIO</button>
													';

												}

												?>
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

</body>
</html>