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
			min-height: 100vh;
		}
		.register-wrapper {
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 2rem 0;
		}
		.card {
			background-color: #f7f3ec !important;
			border-radius: 10px !important;
			border: none !important;
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
		}
		.card-body {
			padding: 2rem !important;
		}
		.btn-light {
			background-color: #006D5B !important;
			color: white !important;
			border: none !important;
			font-weight: 600 !important;
			padding: 0.6rem 1.2rem !important;
			border-radius: 6px !important;
			transition: all 0.2s ease-in-out !important;
		}
		.btn-light:hover {
			background-color: #004d40 !important;
			transform: translateY(-1px);
			box-shadow: 0 4px 12px rgba(0, 77, 64, 0.2) !important;
		}
		.form-control, .input-group-text {
			background-color: #e8f0fe !important;
			border: 1px solid #ced4da !important;
			color: #000000 !important;
			border-radius: 6px !important;
			transition: all 0.2s ease-in-out !important;
		}
		.form-control:focus {
			background-color: #e8f0fe !important;
			box-shadow: 0 0 0 0.2rem rgba(0, 109, 91, 0.15) !important;
			border-color: #006D5B !important;
		}
		.form-control::placeholder {
			color: #555555 !important;
			opacity: 1 !important;
		}
		h3 {
			color: #004d40 !important;
			font-weight: 700 !important;
		}
		a {
			color: #006D5B !important;
			font-weight: 500;
		}
		a:hover {
			color: #004d40 !important;
		}
		label {
			color: #000000 !important;
			font-weight: 600 !important;
			font-size: 0.85rem;
			margin-bottom: 5px;
		}
		p { 
			color: #333333 !important; 
		}
		.border.p-4.rounded {
			border: none !important;
		}
		.divider-text {
			color: #666;
			font-size: 0.8rem;
		}
		.form-check-input {
			border: 2px solid #006D5B !important;
		}
		.form-check-input:checked {
			background-color: #006D5B !important;
			border-color: #006D5B !important;
		}
		.form-check-input:focus {
			box-shadow: 0 0 0 0.25rem rgba(0, 109, 91, 0.25) !important;
		}
		.form-check-label {
			color: #444 !important;
			font-size: 0.85rem;
		}
		.section-title {
			font-size: 0.75rem;
			text-transform: uppercase;
			letter-spacing: 1px;
			color: #006D5B !important;
			font-weight: 700;
			margin-bottom: 0.75rem;
			margin-top: 0.5rem;
			border-bottom: 2px solid rgba(0, 109, 91, 0.1);
			padding-bottom: 4px;
		}
		hr {
			border-color: rgba(0,0,0,0.1);
			margin: 1rem 0;
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
		<div class="register-wrapper">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-8 col-lg-6 col-xl-5">
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">

									<!-- Logo y título -->
									<div class="text-center mb-3">
										<img src="assets/img/logo/<?php echo $logo ?>" width="150" alt="Logo" style="max-height:80px; object-fit:contain;">
										<h3 class="mt-2">CREAR CUENTA</h3>
										<p class="divider-text mb-0">Completa el formulario para registrarte</p>
									</div>

									<hr/>

									<div class="form-body">
										<form class="row g-3">

											<!-- Información personal -->
											<div class="col-12">
												<p class="section-title"><i class='bx bx-user me-1'></i>Información personal</p>
											</div>

											<div class="col-sm-6">
												<label class="form-label">Nombre *</label>
												<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="nombre" required placeholder="Ingrese su nombre">
											</div>
											<div class="col-sm-6">
												<label class="form-label">Apellidos *</label>
												<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="apellidos" required placeholder="Ingrese su apellido">
											</div>
											<div class="col-sm-6">
												<label class="form-label">Ciudad *</label>
												<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="ciudad" required placeholder="Ingrese su ciudad">
											</div>
											<div class="col-sm-6">
												<label class="form-label">Teléfono *</label>
												<input type="text" class="form-control" onkeypress="return solonumeros(event)" id="telefono" required placeholder="Ingrese su teléfono">
											</div>

											<!-- Información de acceso -->
											<div class="col-12 mt-1">
												<p class="section-title"><i class='bx bx-lock-alt me-1'></i>Información de acceso</p>
											</div>

											<div class="col-12">
												<label class="form-label">Correo electrónico *</label>
												<input type="email" class="form-control" id="correo" required placeholder="Ingrese su correo electrónico">
											</div>
											<div class="col-12">
												<label class="form-label">Contraseña *</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="clave" required placeholder="Ingrese su contraseña">
													<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>

											<!-- Términos -->
											<div class="col-12">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="terminos" required value="aceptar">
													<label class="form-check-label" for="terminos">
														He leído y acepto los <a href="#">Términos y Condiciones</a> *
													</label>
												</div>
											</div>

											<!-- Botón -->
											<div class="col-12">
												<div class="d-grid">
													<button type="button" id="register" class="btn btn-light">REGISTRARME</button>
												</div>
												<br>
												<center>
													<p class="mb-0">¿Ya tienes una cuenta? <a href="login">Ingresar aquí</a></p>
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
	<script src="assets/validaciones/js/register.js"></script>

	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>

	<script type="text/javascript">
		var boton = document.getElementById('register');
		boton.addEventListener("click", bloquea, false);

		function bloquea(){
			if(boton.disabled == false){
				boton.disabled = true;
				setTimeout(function(){
					boton.disabled = false;
				}, 5000)
			}
		}

		function solonumeros(evt){
			if(window.event){
				keynum = evt.keyCode;
			} else {
				keynum = evt.which;
			}
			if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13){
				return true;
			} else {
				alert("Ingresar solo numeros");
				return false;
			}
		}

		function soloLetras(e) {
			var key = e.keyCode || e.which,
			tecla = String.fromCharCode(key).toLowerCase(),
			letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
			especiales = [8, 37, 39, 46],
			tecla_especial = false;

			for (var i in especiales) {
				if (key == especiales[i]) {
					tecla_especial = true;
					break;
				}
			}

			if (letras.indexOf(tecla) == -1 && !tecla_especial) {
				return false;
			}
		}
	</script>

	<!----- REDES SOCIALES ----->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp ?>&text=Hola,%20%20Quisiera%20realizar%20una%20consulta" class="float" target="_blank">
		<i class="fa fa-whatsapp my-float"></i>
	</a>
	<!----- REDES SOCIALES ----->

</body>
</html>