<?php 

require("../conexion/conexion.php");

$xCBcDeFGHyYAcSDgSADcNfsaGYRsdSdSDSAeDSVVVsSAKIh=$_GET['xCBcDeFGHyYAcSDgSADcNfsaGYRsdSdSDSAeDSVVVsSAKIh'];


$validaciones=mysqli_query($mysqli,"SELECT * FROM usuarios where estado='3' and clave='$xCBcDeFGHyYAcSDgSADcNfsaGYRsdSdSDSAeDSVVVsSAKIh'");
$validacion=mysqli_num_rows($validaciones);

if($validacion>0 ){

	?>


	<!DOCTYPE html>
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
											<img src="../assets/img/logo/<?php echo $logo ?>" width="130">
											<h3 class="">RESTABLECER CONTRASEÑA</h3>
										</div>
										<hr/>
										<div class="form-body">
											<form class="row g-3">


												<script>

													function mostrarContrasena2(){
														var tipo2 = document.getElementById("clave_usuario");
														if(tipo2.type == "password"){
															tipo2.type = "text";
														}else{
															tipo2.type = "password";
														}
													}


													function mostrarContrasena3(){
														var tipo3 = document.getElementById("rclave_usuario");
														if(tipo3.type == "password"){
															tipo3.type = "text";
														}else{
															tipo3.type = "password";
														}
													}

												</script>

												<input type="hidden" id="key" value="<?php echo $_GET['xCBcDeFGHyYAcSDgSADcNfsaGYRsdSdSDSAeDSVVVsSAKIh'] ?>" />

												<div class="form-group">
													<label>Nueva Contraseña</label>
													<input type="password" class="form-control" minlength="8" maxlength="30" id="clave_usuario" style="height: 40px;">

													<div class="form-check form-check-inline mt-2" style="text-align: left;">
														<input class="form-check-input" type="checkbox" onclick="mostrarContrasena2()">
														<label class="form-check-label" style="font-size: 12px;">Mostrar contraseña</label>
													</div>
												</div>
												<div class="form-group">
													<label>Confirmar Contraseña</label>
													<input type="password" class="form-control" minlength="8" maxlength="30" id="rclave_usuario" style="height: 40px;">

													<div class="form-check form-check-inline mt-2" style="text-align: left;">
														<input class="form-check-input" type="checkbox" onclick="mostrarContrasena3()">
														<label class="form-check-label" style="font-size: 12px;">Mostrar contraseña</label>
													</div>
												</div>

												<div class="col-12">
													<div class="d-grid">
														<button type="button" id="recover_true" class="btn btn-light">GUARDAR NUEVA CONTRASEÑA</button>
													</div>

													<script type="text/javascript">
														var boton = document.getElementById('recover_true');
														boton.addEventListener("click", bloquea, false); 

														function bloquea(){
															if(boton.disabled == false){
																boton.disabled = true;

																setTimeout(function(){
																	boton.disabled = false;
																}, 6000)
															}
														}
													</script>
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
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/sweetalert2.min.js"></script>
		<script src="js/restablecer-nuevos-datos.js"></script>

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

	<?php 

}else{

	echo "<script>location.href='../login'</script>";      

}

?>