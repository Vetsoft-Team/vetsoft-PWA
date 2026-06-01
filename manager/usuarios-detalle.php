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
	<base href="<?php echo $dominio ?>/manager/usuarios-detalle.php" />
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


	<!---- Este script permite mantener la posición de la página cuando se refresca ---->
	<script>
		window.onload=function(){
			var pos=window.name || 0;
			window.scrollTo(0,pos);
		}
		window.onunload=function(){
			window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
		}
	</script>
	<!---- Este script permite mantener la posición de la página cuando se refresca ---->

	
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
					<div class="breadcrumb-title pe-3">Detalle del usuario</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="usuarios">Usuarios activos</a></li>
								<li class="breadcrumb-item active" aria-current="page">Detalle</li>
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
								<a class="dropdown-item" href="usuarios">Lista de usuarios</a>
								<a class="dropdown-item" href="usuarios-nuevo">Nuevo usuario</a>
							</div>
						</div>
					</div>
				</div>


				<?php

				require("../conexion/conexion.php");

				$id_user=$_GET['i'];

				if($id_user==true){

					$usuarios="SELECT * FROM usuarios WHERE id_usuario='$id_user'";
					$usuario=mysqli_query($mysqli,$usuarios);


					$result = 0;
					$result = mysqli_num_rows($usuario);
					if ($result > 0) {

						while ($user=mysqli_fetch_row ($usuario)){


							$id_usuario = $user[0];
							$nombre = $user[1];
							$apellidos = $user[2];
							$ciudad = $user[3];
							$correo = $user[4];
							$telefono = $user[5];
							$clave = $user[6];
							$ultima_conexion = $user[7];
							$fecha_registro = $user[8];
							$ip = $user[9];
							$estado = $user[10];
							$rol = $user[11];

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
											<img src="../assets/images/avatars/usuarios.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
											<div class="mt-3">
												<h4><?php echo $nombre; ?></h4>
											</div>
										</div>
										<hr class="my-3" />
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Registro</h6>
												<span class="text-white"><?php echo $fecha_registro; ?></span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Conexión</h6>
												<span class="text-white"><?php echo $ultima_conexion; ?></span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Ip</h6>
												<span class="text-white"><?php echo $ip; ?></span>
											</li>
										</ul>

										<center>
											<br>
											<?php 

											if($estado==0){

												echo 
												'
												<form action="validaciones/usuarios/usuarios-bloquear" method="POST">
												<input name="id_usuario" value="'.$id_usuario.'" style="display: none;" />
												<button type="submit" class="btn btn-outline-danger px-3 radius-30">BLOQUEAR USUARIO</button>
												</form>
												';

											}else{

												echo 
												'
												<form action="validaciones/usuarios/usuarios-desbloquear" method="POST">
												<input name="id_usuario" value="'.$id_usuario.'" style="display: none;" />
												<button type="submit" class="btn btn-outline-warning px-3 radius-30">DESBLOQUEAR USUARIO</button>
												</form>
												';

											}

											?>
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
												<center><h5 class="mb-3">Datos del usuario</h5></center>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Nombre</h6>
											</div>
											<div class="col-sm-9">
												<input id="id_usuario" value="<?php echo $id_usuario; ?>" style="display: none;" />
												<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="nombre" required value="<?php echo $nombre; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Apellidos</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="apellidos" required value="<?php echo $apellidos; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Ciudad</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="ciudad" required value="<?php echo $ciudad; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Telefono</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" class="form-control" onkeypress="return solonumeros(event)" id="telefono" required value="<?php echo $telefono; ?>" />
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 d-grid gap-2">
												<button type="button" class="btn btn-light px-4 btn-block" id="usuarios-detalle">Actualizar información</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="card">
										<div class="card-body">

											<div class="row">
												<div class="col-sm-10">
													<center><h5 class="mb-3">Mascotas del usuario</h5></center>
												</div>
												<div class="col-sm-2">
													<form action="mascotas-nuevo" method="POST">
														<input name="buscando" value="<?php echo $nombre ?>" style="display: none;">
														<button type="submit" class="btn btn-light px-4 btn-block"><i class="bx bx-list-plus"></i> NUEVO</button>
													</form>
												</div>
											</div>

											<hr>

											<div class="table-responsive">
												<table id="mascotas_" class="table table-striped table-bordered" style="width:100%;">
													<thead style="background-color: #212529;">
														<tr>
															<th>Mascota</th>
															<th>Nombre</th>
															<th>Raza</th>
															<th>Especie</th>
															<th>Sexo</th>
															<th>Detalle</th>
														</tr>
													</thead>
													<tbody>

														<?php

														require("../conexion/conexion.php");

														$mascotas="SELECT * FROM mascotas WHERE id_usuario='$id_usuario' and estado='0' ORDER BY id_mascota DESC ";
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
															$imagenes_m="SELECT imagen FROM mascotas_img WHERE id_mascota='$id_mascota' LIMIT 1";
															$m_imagenes=mysqli_query($mysqli,$imagenes_m);
															while ($imagenes_v=mysqli_fetch_row ($m_imagenes)){
																$imagen_principal=$imagenes_v[0];
															}
															//IMAGENES

															echo 
															'
															<tr>
															<td><img src="../assets/img/mascotas/'.htmlentities($imagen_principal).'" width="100" style="border-radius:20px;"></td>
															<td>'.htmlentities($nombre).'</td>
															<td>'.htmlentities($raza).'</td>
															<td>'.htmlentities($especie).'</td>
															<td>'.htmlentities($sexo).'</td>
															<td><a href="mascotas/'.htmlentities($id_mascota).'"><button type="button" class="btn btn-outline-success px-3 radius-30">Historial</button></a></td>
															</tr>
															';
														}

														?>
													</tbody>

												</table>
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
                                                        }else{
                                                        keynum = evt.which;
                                                            }
                                                        if((keynum > 47 && keynum < 58) || keynum == 8 || keynum== 13){
                                                        return true;
                                                        }else{
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
	<script src="validaciones/usuarios/js/usuarios-editar.js"></script>

	<script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#mascotas_').DataTable()
		});
	</script>

</body>
</html>