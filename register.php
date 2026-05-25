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
		<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col mx-auto">
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<img src="assets/img/logo/<?php echo $logo ?>" width="100">
										<h3 class="">REGÍSTRAR USUARIO</h3>
									</div>
									<hr/>
									<div class="form-body">
										<form class="row g-3">
											<div class="col-sm-6">
												<label class="form-label">Nombre*</label>
												<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="nombre" required placeholder="Ingresa tu nombre">
											</div>
											<div class="col-sm-6">
												<label class="form-label">Apellidos*</label>
												<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="apellidos" required placeholder="Ingresa tus apellidos">
											</div>
											<div class="col-sm-6">
												<label class="form-label">Ciudad*</label>
												<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="ciudad" required placeholder="Ingresa tu ciudad">
											</div>
											<div class="col-sm-6">
												<label class="form-label">Telefono*</label>
												<input type="text" class="form-control" onkeypress="return solonumeros(event)" id="telefono" required placeholder="Ingresa tu telefono">
                                                                                                       
											</div>
											<div class="col-sm-6">
												<label class="form-label">Correo electrónico*</label>
												<input type="email" class="form-control"  id="correo" required placeholder="Ingresa tu correo">
											</div>
											<div class="col-sm-6">
												<label class="form-label">Contraseña*</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="clave"required placeholder="Ingresa tu contraseña"> 
													<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-12">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="terminos" required value="aceptar">
													<label class="form-check-label">He leído y acepto los Términos y Condiciones*</label>
												</div>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="button" id="register" class="btn btn-light">REGISTRARME</button>
												</div>

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
                                                                                }
                                                                 else{
                                                                keynum = evt.which;
                                                                     }
                                                                 if((keynum > 47 && keynum < 58) || keynum == 8 || keynum== 13){
                                                                return true;
                                                                     }
                                                                 else{
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

												<br>
												<center>
													<p>¿Ya tienes una cuenta? <a href="login">Ingresa aquí</a></p>	
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

	<!----- REDES SOCIALES ----->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp ?>&text=Hola,%20%20Quisiera%20realizar%20una%20consulta" class="float" target="_blank">
		<i class="fa fa-whatsapp my-float"></i>
	</a>
	<!----- REDES SOCIALES ----->

</body>
</html>