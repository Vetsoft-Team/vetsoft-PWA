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
	<script src="validaciones/mascotas/js/jquery-3.4.1.min.Js"></script>
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
					<div class="breadcrumb-title pe-3">Mascotas</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="citas">Calendario de citas</a></li>
								<li class="breadcrumb-item active" aria-current="page">Agendar cita</li>
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
								<a class="dropdown-item" href="mascotas">Lista de mascotas</a>
								<a class="dropdown-item" href="mascotas-nuevo">Nueva mascota</a>
							</div>
						</div>
					</div>
				</div>

				<hr/>

				<?php
				$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
				$motivo_defecto = ($tipo == 'urgencia') ? 'Urgencia médica' : '';
				?>

				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">

										<hr>
										<div class="row">
											<div class="col-sm-12">
												<center><h5>AGENDAR NUEVA CITA <?php if($tipo=='urgencia') echo 'DE URGENCIA'; ?></h5></center>
											</div>
										</div>
										<hr>
										<br>
										<center>
											<div class="row mb-3">
												<div class="col-sm-6">
													<label class="form-label">Mascota / Paciente</label>
													<?php if($tipo == 'urgencia'): ?>
														<input type="text" class="form-control" id="id_mascota" required placeholder="Escribe el nombre de la mascota">
														<small class="text-muted">La mascota puede no estar registrada</small>
													<?php else: ?>
														<select class="form-control" id="id_mascota" required>
															<option value="">Seleccionar Mascota</option>
															<?php
															$sql_m=("SELECT m.id_mascota, m.nombre, u.nombre as user_n, u.apellidos as user_a FROM mascotas m JOIN usuarios u ON m.id_usuario = u.id_usuario WHERE m.estado=0 ORDER BY m.id_mascota DESC");
															$query_m=mysqli_query($mysqli,$sql_m);
															while($arreglo_m=mysqli_fetch_array($query_m)){
																echo '<option value="'.$arreglo_m['id_mascota'].'" style="color: black;">'.$arreglo_m['nombre'].' (Dueño: '.$arreglo_m['user_n'].' '.$arreglo_m['user_a'].')</option>';
															}
															?>
														</select>
													<?php endif; ?>
												</div>
												<div class="col-sm-6">
													<label class="form-label">Nombre del doctor/doctora</label>
													<select class="form-control" id="doctor_cita" required>
														<option value="">Doctores disponibles</option>
														<?php
														$sql_d=("SELECT * FROM doctores ORDER BY id_doctor DESC");
														$query_d=mysqli_query($mysqli,$sql_d);
														while($arreglo_d=mysqli_fetch_array($query_d)){
															echo '<option value="'.$arreglo_d['id_doctor'].'" style="color: black;">'.$arreglo_d['nombre'].' '.$arreglo_d['apellido'].'</option>';
														}
														?>
													</select>
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-6">
													<label class="form-label">Fecha de la cita</label>
													<input type="date" class="form-control" min="<?php echo date('Y-m-d')?>" id="fecha_cita" required>
												</div>
												<div class="col-sm-6">
													<label class="form-label">Hora de la cita</label>
													<input type="time" class="form-control" id="hora_cita" required>
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-12">
													<label class="form-label">Motivo de la cita</label>
													<textarea class="form-control" id="motivo_cita" rows="3" required><?php echo $motivo_defecto; ?></textarea>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-12 d-grid gap-2">
													<button type="button" class="btn btn-light px-4 btn-block" id="citas-agendar-btn">Guardar Cita</button>
												</div>
											</div>
										</center>

									</div>
								</div>
							</div>


						</div>
					</div>
				</div>


			</div>
		</div>

	<script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="../assets/js/sweetalert2.min.js"></script>
	
	<script>
		$(document).ready(function(){
			$('#citas-agendar-btn').click(function(){
				let id_mascota = $('#id_mascota').val();
				let fecha_cita = $('#fecha_cita').val();
				let hora_cita = $('#hora_cita').val();
				let doctor_cita = $('#doctor_cita').val();
				let motivo_cita = $('#motivo_cita').val();

				if (id_mascota == '') {
					Swal.fire('Advertencia', 'Selecciona una mascota', 'warning');
				} else if (doctor_cita == '') {
					Swal.fire('Advertencia', 'Selecciona un doctor', 'warning');
				} else if (fecha_cita == '') {
					Swal.fire('Advertencia', 'Ingresa la fecha', 'warning');
				} else if (hora_cita == '') {
					Swal.fire('Advertencia', 'Ingresa la hora', 'warning');
				} else {
					$.ajax({
						url: 'validaciones/citas/citas-agregar',
						type: 'post',
						data: {
							id_mascota: id_mascota,
							fecha_cita: fecha_cita,
							hora_cita: hora_cita,
							doctor_cita: doctor_cita,
							motivo_cita: motivo_cita
						},
						success: function(data) {
							if (data == 0) {
								Swal.fire('Cita registrada', 'La cita fue agendada exitosamente', 'success').then(function() {
									window.location = "citas";
								});
							} else {
								Swal.fire('Error', 'Ocurrió un error al guardar la cita', 'error');
							}
						}
					});
				}
			});
		});
	</script>

	<script src="../assets/js/app.js"></script>

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
	<script src="validaciones/mascotas/js/mascotas-agregar.js"></script>
	
	<script src="../assets/js/app.js"></script>

</body>
<script src='validaciones/mascotas/js/Funciones.js'></script>
</html>