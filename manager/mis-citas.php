<?php 

session_start();
if (@!$_SESSION['correo']) {
	header("Location:desconectar");
	exit;
}elseif ($_SESSION['rol']==2) {
	header("Location:desconectar");
	exit;
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

// Búsqueda del Doctor logueado en la tabla doctores
$my_doctor_id = 0;
$user_nombre = $_SESSION['nombre'];
$user_apellidos = $_SESSION['apellidos'];

$doctor_search = mysqli_query($mysqli, "SELECT id_doctor FROM doctores WHERE (nombre='$user_nombre' AND apellido='$user_apellidos') OR ('$user_nombre' LIKE CONCAT('%', nombre, '%') AND '$user_apellidos' LIKE CONCAT('%', apellido, '%'))");
if ($doc_row = mysqli_fetch_assoc($doctor_search)) {
    $my_doctor_id = $doc_row['id_doctor'];
}

$selected_date = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
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
					<div class="breadcrumb-title pe-3">Mis Citas</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="index"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Mis Citas del Día</li>
							</ol>
						</nav>
					</div>
				</div>

				<hr/>

				<!-- Filtro de Fecha -->
				<div class="card mb-4" style="background-color: rgba(255,255,255,0.05);">
					<div class="card-body">
						<form method="GET" class="row g-3 align-items-center">
							<div class="col-auto">
								<label for="fecha" class="form-label mb-0 text-white"><i class="bx bx-calendar me-1"></i>Seleccionar Fecha:</label>
							</div>
							<div class="col-auto">
								<input type="date" name="fecha" id="fecha" class="form-control" style="background-color: #f7f3ec; color: #000;" value="<?php echo $selected_date; ?>">
							</div>
							<div class="col-auto">
								<button type="submit" class="btn btn-light px-3"><i class="bx bx-filter-alt"></i> Filtrar Citas</button>
							</div>
						</form>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<?php if ($my_doctor_id == 0): ?>
							<div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
								<div class="d-flex align-items-center">
									<div class="font-35 text-dark"><i class="bx bx-info-circle"></i></div>
									<div class="ms-3">
										<h6 class="mb-0 text-dark">Información de Cuenta</h6>
										<div class="text-dark">Tu cuenta de usuario no está vinculada a ningún registro de Doctor en la base de datos. Por favor, contacta con soporte o con el administrador para enlazar tu cuenta.</div>
									</div>
								</div>
							</div>
						<?php else: ?>
							<div class="table-responsive">
								<table id="citas_dia" class="table table-striped table-bordered" style="width:100%;">
									<thead style="background-color: #212529;">
										<tr>
											<th>Hora</th>
											<th>Mascota/Paciente</th>
											<th>Dueño</th>
											<th>Motivo de la Cita</th>
											<th>Estado</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$citas_q = mysqli_query($mysqli, "
											SELECT c.*, m.nombre as mascota_nombre, m.id_mascota, u.nombre as dueno_nombre, u.apellidos as dueno_apellidos 
											FROM citas c 
											LEFT JOIN mascotas m ON c.id_mascota = m.id_mascota 
											LEFT JOIN usuarios u ON m.id_usuario = u.id_usuario 
											WHERE c.doctor='$my_doctor_id' AND c.fecha_cita='$selected_date' 
											ORDER BY c.hora_cita ASC
										");
										
										while ($cita = mysqli_fetch_assoc($citas_q)):
											$id_cita = $cita['id_cita'];
											$id_mascota = $cita['id_mascota'];
											$mascota_nombre = $cita['mascota_nombre'] ?: 'Urgencia / Sin Mascota Registrada';
											$dueno_nombre_completo = $cita['dueno_nombre'] ? $cita['dueno_nombre'].' '.$cita['dueno_apellidos'] : 'N/A';
											$hora_cita = $cita['hora_cita'];
											$motivo = $cita['motivo'];
											$estado_cita = $cita['estado'];
										?>
											<tr>
												<td><strong><?php echo htmlentities($hora_cita); ?></strong></td>
												<td><i class="bx bx-purchase-tag me-1"></i><?php echo htmlentities($mascota_nombre); ?></td>
												<td><i class="bx bx-user me-1"></i><?php echo htmlentities($dueno_nombre_completo); ?></td>
												<td><?php echo htmlentities($motivo); ?></td>
												<td>
													<?php if ($estado_cita == 0): ?>
														<span class="badge bg-warning text-dark">PENDIENTE</span>
													<?php else: ?>
														<span class="badge bg-success">ATENDIDA</span>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($id_mascota > 0): ?>
														<a href="mascotas/<?php echo $id_mascota; ?>" class="btn btn-sm btn-outline-success px-3 radius-30">
															<i class="bx bx-first-aid me-1"></i> Atender / Historial
														</a>
													<?php else: ?>
														<button disabled class="btn btn-sm btn-outline-secondary px-3 radius-30">Sin Mascota</button>
													<?php endif; ?>
												</td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						<?php endif; ?>
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
			$('#citas_dia').DataTable({
				"language": {
					"lengthMenu": "Mostrar _MENU_ registros por página",
					"zeroRecords": "No se encontraron citas para esta fecha",
					"info": "Mostrando página _PAGE_ de _PAGES_",
					"infoEmpty": "No hay citas disponibles",
					"infoFiltered": "(filtrado de _MAX_ registros totales)",
					"search": "Buscar:",
					"paginate": {
						"first": "Primero",
						"last": "Último",
						"next": "Siguiente",
						"previous": "Anterior"
					}
				}
			});
		});
	</script>
	<script src="../assets/js/app.js"></script>
</body>
</html>
