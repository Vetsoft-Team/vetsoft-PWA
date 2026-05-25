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
	<base href="<?php echo $dominio ?>/manager/visitas-detalle.php" />
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
					<div class="breadcrumb-title pe-3">Detalle de la mascota</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="mascotas">Mascotas activas</a></li>
								<li class="breadcrumb-item" aria-current="page"><a href="mascotas/<?php echo $_GET['i'];?>">Detalle Mascota</a></li>
								<li class="breadcrumb-item active" aria-current="page">Detalle de visita</li>
							</ol>
						</nav>
					</div>
				</div>


				<?php

				require("../conexion/conexion.php");

				$id_pet=$_GET['i'];
				$id_visit=$_GET['v'];

				if($id_pet==true){

					$mascotas="SELECT * FROM mascotas WHERE id_mascota='$id_pet'";
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


							$visitas="SELECT * FROM visitas WHERE id_visita='$id_visit'";
							$visita=mysqli_query($mysqli,$visitas);
							while ($visit=mysqli_fetch_row ($visita)){

								$id_visita_v = $visit[0];
								$id_mascota_v = $visit[1];
								$fecha_v = $visit[2];
								$motivo_v = $visit[3];
								$peso_v = $visit[4];
								$tipo_peso_v = $visit[5];
								$temperatura_v = $visit[6];
								$sintomas_v = $visit[7];
								$diagnostico_v = $visit[8];
								$medicinas_aplicadas_v = $visit[9];
								$visita_proxima_v = $visit[10];
								$motivo_proximo_v = $visit[11];
								$estado_v = $visit[12];

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

										<br>
										<br>
										<center>
											<h6>IMPRIMIR REPORTE</h6>
											<a href="pdf/reporte_visita?visita=<?php echo $id_visita_v ?>" target="blank">
												<img src="../assets/img/iconos/reporte.png" width="80">
											</a>
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
												<center><h5 class="mb-3">Datos de la visita #<?php echo $id_visit ?></h5></center>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Fecha de la visita</h6>
											</div>
											<div class="col-sm-9">
												<input id="id_visita" value="<?php echo $id_visita_v; ?>" style="display: none;" />
												<input id="id_mascota" value="<?php echo $id_mascota_v; ?>" style="display: none;" />
												<input type="text" class="form-control" id="fecha_visita" value="<?php echo $fecha_v; ?>" readonly />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Motivo de la visita</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="motivo_v"><?php echo $motivo_v; ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Peso</h6>
											</div>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="peso_v" value="<?php echo $peso_v; ?>" />
											</div>
											<div class="col-sm-5">
												<select type="text" class="form-control" id="tipo_peso_v">
													<option value="<?php echo $tipo_peso_v; ?>"><?php echo $tipo_peso_v; ?></option>
													<option value="Kilogramos" style="color: black;">Kilogramos</option>
													<option value="Gramos" style="color: black;">Gramos</option>
												</select>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Temperatura</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="temperatura_v" value="<?php echo $temperatura_v; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Diagnostico y tratamiento</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="diagnostico_v"><?php echo $diagnostico_v; ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Sintomas</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="sintomas_v"><?php echo $sintomas_v; ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Medicinas o productos aplicados</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="medicinas_aplicadas_v"><?php echo $medicinas_aplicadas_v; ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Fecha de la proxima visita</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="visita_proxima_v" value="<?php echo $visita_proxima_v; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Motivo de la proxima visita</h6>
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" id="motivo_proximo_v"><?php echo $motivo_proximo_v; ?></textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 d-grid gap-2">
												<button type="button" class="btn btn-light px-4 btn-block" id="visitas-editar">Actualizar información</button>
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
													<center><h5 class="mb-3">Exámenes de Laboratorio / Placas:</h5></center>
												</div>
												<div class="col-sm-2">
													<button type="button" class="btn btn-light px-4 btn-block" data-bs-toggle="modal" data-bs-target="#registro_visitas"><i class="bx bx-list-plus"></i> NUEVO</button>


													<!-- Modal -->
													<div class="modal fade" id="registro_visitas" tabindex="-1" aria-labelledby="visitas" aria-hidden="true">
														<div class="modal-dialog modal-xl">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="visitas">Nuevo registro de exámenes de laboratorio o placas</h5>
																	<button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">

																	<div class="row">

																		<center><h5 class="mt-4">Exámenes de Laboratorio / Placas:</h5></center>	

																		<input id="id_visita" value="<?php echo $id_visita_v; ?>" style="display: none;" />
																		<input id="id_mascota" value="<?php echo $id_mascota_v; ?>" style="display: none;" />

																		<div class="col-sm-6">
																			<center>
																				Imagenes
																				<br>
																				<br>
																				<fieldset>
																					<div class="row mostrar_foto">	

																					</div>
																					<br>	
																					<center><button type="button" id="agregar_imagenes" class="btn btn-primary">+</button></center>
																				</fieldset>
																			</center>
																		</div>


																		<div class="col-sm-6">
																			<center>
																				Pdf
																				<br>
																				<br>
																				<fieldset>
																					<div class="row mostrar_foto2">	

																					</div>
																					<br>	
																					<center><button type="button" id="agregar_pdf" class="btn btn-primary">+</button></center>
																				</fieldset>
																			</center>
																		</div>

																	</div>


																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
																	<button type="button" id="examenes-agregar" class="btn btn-primary">Guardar</button>
																</div>
															</div>
														</div>
													</div>
													<!-- Modal -->

												</div>
											</div>

											<hr>

											<div class="table-responsive">
												<table id="visitas_" class="table table-striped table-bordered" style="width:100%;">
													<thead style="background-color: #212529;">
														<tr>
															<th>Imagen/Pdf</th>
															<th>Tipo de archivo</th>
															<th>Detalle</th>
															<th>Eliminar</th>
														</tr>
													</thead>
													<tbody>

														<?php

														require("../conexion/conexion.php");

														$visitas_img="SELECT * FROM visitas_img WHERE id_visita='$id_visita_v' ORDER BY id_imagen DESC ";
														$visitas_img_=mysqli_query($mysqli,$visitas_img);
														while ($visit_img=mysqli_fetch_row ($visitas_img_)){

															echo 
															'
															<tr>
															<td>'.htmlentities($visit_img[2]).'</td>
															<td>'.htmlentities($visit_img[3]).'</td>
															<td><a href="../assets/img/visitas/'.$visit_img[2].'" target="_blank"><button type="button" class="btn btn-outline-success px-3 radius-30">Vista previa</button></a></td>
															<td>
															<form action="validaciones/visitas/examenes-eliminar" method="POST">
															<input name="id_imagen" value="'.$visit_img[0].'" style="display: none;" />
															<input name="imagen" value="'.$visit_img[2].'" style="display: none;" />
															<input name="id_v" value="'.$id_visita_v.'" style="display: none;" />
															<input name="id_m" value="'.$id_mascota_v.'" style="display: none;" />
															<button type="submit" class="btn btn-outline-danger px-3 radius-30">Eliminar</button>
															</form>
															</td>
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
	<script src="validaciones/visitas/js/visitas-editar.js"></script>
	<script src="validaciones/visitas/js/examenes-agregar.js"></script>

</body>
</html>