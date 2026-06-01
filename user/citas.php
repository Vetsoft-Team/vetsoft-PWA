<?php 

session_start();
if (@!$_SESSION['correo']) {
	header("Location:desconectar");
}elseif ($_SESSION['rol']==1) {
	header("Location:desconectar");
}


require_once('../conexion/conexion_two.php');
$sql = "SELECT c.id, c.id_mascota, c.id_cita, c.title, c.start, c.end, c.color FROM calendario c inner join mascotas m on c.id_mascota=m.id_mascota WHERE m.id_usuario='".$_SESSION['id_usuario']."' ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

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
	<link href="../assets/css/sweetalert2.min.css" rel="stylesheet">
	<link href="../assets/css/style.css" rel="stylesheet">
	
	<!-- Titulo -->
	<?php include'include/title.php' ?>
	<!-- Titulo -->


	<!-- FullCalendar -->
	<link href='validaciones/citas/css/fullcalendar.css' rel='stylesheet' />

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
					<div class="breadcrumb-title pe-3">Citas</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Calendario de citas</li>
							</ol>
						</nav>
					</div>
				</div>

				<hr/>


				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											

											<div id="calendar" class="col-centered" style="color: white;">
											</div>

											<!-- Modal -->
											<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog">
													<div class="modal-content">
														<form action="citas-detalle" method="GET">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Cita</h5>
																<button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">


																<div class="form-group">
																	<label for="title" class="col-sm-2 control-label">Motivo</label>
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="title" placeholder="Titulo">
																		<input type="hidden" name="c" class="form-control" id="id_cita">
																		<input type="hidden" name="i" class="form-control" id="id_mascota">
																		<br>
																		<button type="submit" class="btn btn-success btn-block" style="width: 100%;">DETALLE DE LA CITA</button>
																	</div>
																</div>

															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
															</div>
														</form>
													</div>
												</div>
											</div>
											
											<br>

											<center>
												<hr>
												<b style="color: #1F9C00;">Color verde:</b> cita pendiente (activa)
												<br>
												<b style="color: #A00000;">Color rojo:</b> asistio a la cita
												<br>
												<b style="color: #C67200;">Color naranja:</b> no asistio a la cita
												<hr>
											</center>
											
											<br>
											
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
	<script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="../assets/js/sweetalert2.min.js"></script>
	<script src="../assets/js/app.js"></script>


	<!-- FullCalendar -->
	<script src='validaciones/citas/js/moment.min.js'></script>
	<script src='validaciones/citas/js/fullcalendar/fullcalendar.min.js'></script>
	<script src='validaciones/citas/js/fullcalendar/fullcalendar.js'></script>
	<script src='validaciones/citas/js/fullcalendar/locale/es.js'></script>

	<script>

		$(document).ready(function() {

			var date = new Date();
			var yyyy = date.getFullYear().toString();
			var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
			var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

			$('#calendar').fullCalendar({
				header: {
					language: 'es',
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay',

				},
				defaultDate: yyyy+"-"+mm+"-"+dd,
				editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #id_mascota').val(event.id_mascota);
					$('#ModalEdit #id_cita').val(event.id_cita);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 

				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
				?>
				{
					id: '<?php echo $event['id']; ?>',
					id_mascota: '<?php echo $event['id_mascota']; ?>',
					id_cita: '<?php echo $event['id_cita']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
				},
			<?php endforeach; ?>
			]
		});

		});

	</script>

</body>
</html>