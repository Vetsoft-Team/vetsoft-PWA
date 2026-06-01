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
					<div class="breadcrumb-title pe-3">Mascotas</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Mis mascotas</li>
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
								<a class="dropdown-item" href="mascotas">Mascotas</a>
								<a class="dropdown-item" href="mascotas-nuevo">Nueva mascota</a>
							</div>
						</div>
					</div>
				</div>

				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="mascotas_" class="table table-striped table-bordered" style="width:100%;">
								<thead style="background-color: #212529;">
									<tr>
										<th>Mascota</th>
										<th>Nombre</th>
										<th>Edad</th>
										<th>Raza</th>
										<th>Especie</th>
										<th>Sexo</th>
										<th>Estado</th>
										<th>Detalle</th>
									</tr>
								</thead>
								<tbody>

									<?php

									require("../conexion/conexion.php");

									$n = "";

									if(!empty($_POST))
									{
										$n = $_POST['nombre_busqueda'];

									}

									$mascotas="SELECT * FROM mascotas WHERE id_usuario='".$_SESSION['id_usuario']."' and estado!='2' and (nombre LIKE '%$n%' or raza LIKE '%$n%' or especie LIKE '%$n%') ORDER BY id_mascota DESC ";
									$mascota=mysqli_query($mysqli,$mascotas);
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

										echo 
										'
										<tr>
										<td><img src="../assets/img/mascotas/'.$imagen_pet.'" class="rounded-circle" width="80" height="80"></td>
										<td>'.htmlentities($nombre).'</td>
										<td>'.htmlentities($edad).'</td>
										<td>'.htmlentities($raza).'</td>
										<td>'.htmlentities($especie).'</td>
										<td>'.htmlentities($sexo).'</td>
										';

										if($estado=='0'){

											echo '<td><span class="badge bg-success">ACTIVO</span></td>';

											echo
											'
											<td><a href="mascotas/'.htmlentities($id_mascota).'"><button type="button" class="btn btn-outline-success px-3 radius-30">Historial</button></a></td>
											</tr>
											';

										}else{

											echo '<td><span class="badge bg-danger">INACTIVO</span></td>';

											echo
											'
											<td><button type="button" class="btn btn-outline-danger px-3 radius-30" disabled>Pendiente</button></td>
											</tr>
											';

										}

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
			$('#mascotas_').DataTable()
		});

	</script>
	<script src="../assets/js/app.js"></script>

</body>
</html>