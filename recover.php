<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon/Icono -->
	<?php include'include/favicon.php' ?>
	<!-- Favicon/Icono -->

	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<link href="assets/css/sweetalert2.min.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">

	<!-- Titulo -->
	<?php include'include/title.php' ?>
	<!-- Titulo -->

	<style>
		body {
			background: linear-gradient(135deg, #02362b 0%, #066953 100%) !important;
		}
		.card {
			background-color: #f7f3ec !important;
			border-radius: 10px !important;
			border: none !important;
		}
		.btn-light {
			background-color: #006D5B !important;
			color: white !important;
			border: none !important;
		}
		.btn-light:hover {
			background-color: #004d40 !important;
		}
		.form-control, .input-group-text {
			background-color: #e8f0fe !important;
			border: 1px solid #ced4da !important;
			color: #000 !important;
		}
		.form-control:focus {
			background-color: #e8f0fe !important;
			box-shadow: none !important;
			border-color: #006D5B !important;
		}
		h3 {
			color: #004d40 !important;
			font-weight: 700 !important;
		}
		a {
			color: #006D5B !important;
			font-weight: 500;
		}
		label, p { 
			color: #333 !important; 
		}
		.border.p-4.rounded {
			border: none !important;
		}
	</style>
</head>


<?php
require("conexion/conexion.php");
$configuracion="SELECT logo, color, telefono FROM configuracion ";
$config=mysqli_query($mysqli,$configuracion);
while ($conf=mysqli_fetch_row ($config)){
	$logo=$conf[0];
	$color=$conf[1];
	$whatsapp=$conf[2];
}
?>

<body class="bg-theme <?php echo $color ?>">

	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<img src="assets/img/logo/<?php echo $logo ?>" width="130">
										<h3 class="">RECUPERAR CONTRASEÑA</h3>
									</div>
									<hr/>
									<div class="form-body">
										<form class="row g-3">
											<!-- Paso 1: Validar Correo -->
											<div id="paso1">
												<div class="col-12 mb-3">
													<center><label class="form-label">Correo electrónico</label></center>
													<input type="email" class="form-control" id="correo" placeholder="Ingresa tu correo">
												</div>
												<div class="col-12">
													<div class="d-grid">
														<button type="button" id="recover" class="btn btn-light">VALIDAR CORREO</button>
													</div>
												</div>
											</div>

											<!-- Paso 2: Cambiar Contraseña -->
											<div id="paso2" style="display: none;">
												<div class="col-12 mb-3">
													<center><label class="form-label">Nueva contraseña</label></center>
													<div class="input-group" id="show_hide_password_1">
														<input type="password" class="form-control border-end-0" id="nueva_clave" placeholder="Ingresa la nueva contraseña"> 
														<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
													</div>
												</div>
												<div class="col-12 mb-3">
													<center><label class="form-label">Confirmar contraseña</label></center>
													<div class="input-group" id="show_hide_password_2">
														<input type="password" class="form-control border-end-0" id="confirmar_clave" placeholder="Confirma la contraseña"> 
														<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
													</div>
												</div>
												<div class="col-12">
													<div class="d-grid">
														<button type="button" id="save_password" class="btn btn-light">GUARDAR CONTRASEÑA</button>
													</div>
												</div>
											</div>

											<div class="col-12 mt-4">
												<center>
													<p>¿Deseas Iniciar sesión? <a href="login">Ingresa aquí</a></p>			
												</center>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/sweetalert2.min.js"></script>
	<script src="restablecer/js/recover.js"></script>

	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password_1 a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password_1 input').attr("type") == "text") {
					$('#show_hide_password_1 input').attr('type', 'password');
					$('#show_hide_password_1 i').addClass("bx-hide");
					$('#show_hide_password_1 i').removeClass("bx-show");
				} else if ($('#show_hide_password_1 input').attr("type") == "password") {
					$('#show_hide_password_1 input').attr('type', 'text');
					$('#show_hide_password_1 i').removeClass("bx-hide");
					$('#show_hide_password_1 i').addClass("bx-show");
				}
			});
			$("#show_hide_password_2 a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password_2 input').attr("type") == "text") {
					$('#show_hide_password_2 input').attr('type', 'password');
					$('#show_hide_password_2 i').addClass("bx-hide");
					$('#show_hide_password_2 i').removeClass("bx-show");
				} else if ($('#show_hide_password_2 input').attr("type") == "password") {
					$('#show_hide_password_2 input').attr('type', 'text');
					$('#show_hide_password_2 i').removeClass("bx-hide");
					$('#show_hide_password_2 i').addClass("bx-show");
				}
			});
		});
	</script>

	<!----- REDES SOCIALES ----->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp ?>&text=Hola,%20%20Quisiera%20realizar%20una%20consulta" class="float" target="_blank">
		<i class="fa fa-whatsapp my-float"></i>
	</a>
	<!----- REDES SOCIALES ----->

</body>
</html>