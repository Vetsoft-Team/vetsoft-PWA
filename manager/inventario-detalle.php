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
	<base href="<?php echo $dominio ?>/manager/inventario-detalle.php" />
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
					<div class="breadcrumb-title pe-3">Detalle del producto</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="inventario">Lista de productos</a></li>
								<li class="breadcrumb-item active" aria-current="page">Producto</li>
							</ol>
						</nav>
					</div>
				</div>


				<?php

				require("../conexion/conexion.php");

				$id_invent=$_GET['i'];

				if($id_invent==true){

					$inventarios="SELECT * FROM inventario WHERE id_inventario='$id_invent'";
					$inventario=mysqli_query($mysqli,$inventarios);

					$result = 0;
					$result = mysqli_num_rows($inventario);
					if ($result > 0) {
						while ($invent=mysqli_fetch_row ($inventario)){

							$id_inventario = $invent[0];
							$nombre_articulo = $invent[1];
							$detalle_articulo = $invent[2];
							$numero_factura = $invent[3];
							$fecha_ingreso = $invent[4];
							$proveedor = $invent[5];
							$cantidad_sugerida = $invent[6];
							$stock = $invent[7];
							$precio_unitario = $invent[8];
							$precio_sugerido = $invent[9];
							$fecha_vencimiento = $invent[10];
							$codigo_barras = $invent[11];
							$estado = $invent[12];

							//IMAGENES
							$imagenes_i="SELECT imagen FROM inventario_img WHERE id_inventario='$id_inventario' LIMIT 1";
							$i_imagenes=mysqli_query($mysqli,$imagenes_i);
							while ($imagenes_v=mysqli_fetch_row ($i_imagenes)){
								$imagen_inv=$imagenes_v[0];
							}
							//IMAGENES

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
											<a href="inventario">
												<div class="col-sm-12 d-grid gap-2">
													<button type="submit" class="btn btn-light px-4">Regresar</button>
												</div>
											</a>
										</div>
										<hr class="my-3" />
										<div class="d-flex flex-column align-items-center text-center">
											<img src="../assets/img/inventario/<?php echo $imagen_inv ?>" alt="Admin" class="rounded-circle p-1 " width="190" height="190">
											<div class="mt-3">
												<h4><?php echo $nombre_articulo; ?></h4>
											</div>
										</div>
										<hr class="my-3" />
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Numero de factura</h6>
												<span class="text-white"><?php echo $numero_factura; ?></span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Fecha ingreso</h6>
												<span class="text-white"><?php echo $fecha_ingreso; ?></span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Fecha vencimiento</h6>
												<span class="text-white"><?php echo $fecha_vencimiento; ?></span>
											</li>
										</ul>

										<center>
											<br>
											<?php 

											if($estado==0){

												echo 
												'
												<form action="validaciones/inventario/inventario-bloquear" method="POST">
												<input name="id_inventario" value="'.$id_inventario.'" style="display: none;" />
												<button type="submit" class="btn btn-outline-danger px-3 radius-30">INACTIVAR PRODUCTO</button>
												</form>
												';

											}else{

												echo 
												'
												<form action="validaciones/inventario/inventario-desbloquear" method="POST">
												<input name="id_inventario" value="'.$id_inventario.'" style="display: none;" />
												<button type="submit" class="btn btn-outline-warning px-3 radius-30">ACTIVAR PRODUCTO</button>
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
												<center><h5 class="mb-3">Detalle del producto</h5></center>
											</div>
										</div>
										<center>
											<div class="row mb-3">
												<div class="col-sm-6">
													<label class="form-label">Nombre del articulo</label>
													<input id="id_inventario" value="<?php echo $id_inventario; ?>" style="display: none;" />
													<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="nombre_articulo" required value="<?php echo $nombre_articulo ?>" placeholder="Ingresa el nombre del articulo">
												</div>
												<div class="col-sm-6">
													<label class="form-label">Numero de factura</label>
													<input type="text" class="form-control" onkeypress="return solonumeros(event)" id="numero_factura" required value="<?php echo $numero_factura ?>" placeholder="Ingresa el numero de factura">
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-4">
													<label class="form-label">Fecha de ingreso</label>
													<input type="date" class="form-control" required value="<?php echo $fecha_ingreso ?>" id="fecha_ingreso">
												</div>
												<div class="col-sm-4">
													<label class="form-label">Proveedor</label>
													<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="proveedor" required value="<?php echo $proveedor ?>" placeholder="Ingresa el nombre del proveedor">
												</div>
												<div class="col-sm-4">
													<label class="form-label">Cantidad sugerida</label>
													<input type="number" class="form-control" onkeypress="return solonumeros(event)" id="cantidad_sugerida" required value="<?php echo $cantidad_sugerida ?>" placeholder="Ingresa la cantidad sugerida">
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-4">
													<label class="form-label">Stock</label>
													<input type="number" class="form-control" onkeypress="return solonumeros(event)" id="stock" required value="<?php echo $stock ?>" placeholder="Ingresa el stock disponible">
												</div>
												<div class="col-sm-4">
													<label class="form-label">Precio Unitario</label>
													<input type="number" class="form-control number" onkeypress="return solonumeros(event)" id="precio_unitario" required value="<?php echo $precio_unitario ?>" onkeypress="return valideKey(event);" placeholder="Ingresa el precio unitario">
												</div>
												<div class="col-sm-4">
													<label class="form-label">Precio sugerido</label>
													<input type="number" class="form-control number2" onkeypress="return solonumeros(event)" id="precio_sugerido" required value="<?php echo $precio_sugerido ?>" onkeypress="return valideKey(event);" placeholder="Ingresa el precio sugerido">
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-12">
													<label class="form-label">Descripción del producto</label>
													<div class="input-group" id="show_hide_password">
														<textarea class="form-control" id="descripcion" rows="3" placeholder="Ingresa las descripcion o detalle del producto"><?php echo $detalle_articulo ?></textarea>
													</div>
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-6">
													<label class="form-label">Fecha de vencimiento del producto</label>
													<input type="date" class="form-control" value="<?php echo $fecha_vencimiento ?>" id="fecha_vencimiento" required>
												</div>
												<div class="col-sm-6">
													<label class="form-label">Codigo de barras</label>
													<input type="text" class="form-control" id="codigo_barras" value="<?php echo $codigo_barras ?>" placeholder="Ingresa el precio unitario">
												</div>
											</div>

											<div class="row">
												<div class="col-sm-12 d-grid gap-2">
													<button type="button" class="btn btn-light px-4 btn-block" id="inventario-editar">Actualizar producto</button>
												</div>
											</div>
										</center>

									</div>
								</div>
							</div>
						</div>


						<hr>


						<div class="row">
							<div class="col-sm-12">
								<div class="card">
									<div class="card-body">

										<div class="row">
											<div class="col-sm-10">
												<center><h5 class="mb-3">Imagenes del producto</h5></center>
											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-light px-4 btn-block" data-bs-toggle="modal" data-bs-target="#registro_inventario"><i class="bx bx-list-plus"></i> NUEVO</button>


												<!-- Modal -->
												<div class="modal fade" id="registro_inventario" tabindex="-1" aria-labelledby="inventario" aria-hidden="true">
													<div class="modal-dialog modal-xl">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="inventario">Nueva imagen del producto</h5>
																<button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">

																<div class="row">

																	<center><h5 class="mt-4">Nueva imagen del producto:</h5></center>	

																	<input id="id_inventario" value="<?php echo $id_invent; ?>" style="display: none;" />

																	<div class="col-sm-12">
																		<center>
																			Imagenes
																			<br>
																			<br>
																			<fieldset>
																				<div class="row mostrar_foto">	

																				</div>
																				<br>	
																				<center><button type="button" id="agregar_foto" class="btn btn-primary">+</button></center>
																			</fieldset>
																		</center>
																	</div>

																</div>


															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
																<button type="button" id="imagenes-agregar" class="btn btn-primary">Guardar</button>
															</div>
														</div>
													</div>
												</div>
												<!-- Modal -->

											</div>
										</div>

										<hr>

										<div class="table-responsive">
											<table id="inventario_" class="table table-striped table-bordered" style="width:100%;">
												<thead style="background-color: #212529;">
													<tr>
														<th>Imagen</th>
														<th>Eliminar</th>
													</tr>
												</thead>
												<tbody>

													<?php

													require("../conexion/conexion.php");

													$inventario_img="SELECT * FROM inventario_img WHERE id_inventario='$id_inventario' ORDER BY id_imagen DESC ";
													$inventario_img_=mysqli_query($mysqli,$inventario_img);
													while ($invent_img=mysqli_fetch_row ($inventario_img_)){

														echo 
														'
														<tr>
														<td><img src="../assets/img/inventario/'.htmlentities($invent_img[2]).'" width="100"></td>
														<td>
														<form action="validaciones/inventario/imagenes-eliminar" method="POST">
														<input name="id_imagen" value="'.$invent_img[0].'" style="display: none;" />
														<input name="id_inventario" value="'.$invent_img[1].'" style="display: none;" />
														<input name="imagen" value="'.$invent_img[2].'" style="display: none;" />
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
	<script src="validaciones/inventario/js/inventario-editar.js"></script>
	<script src="validaciones/inventario/js/imagenes-agregar.js"></script>
	<script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#inventario_').DataTable()
		});

	</script>


	<script type="text/javascript">
		function valideKey(evt){
    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;
    
    if(code==8) { // backspace.
    	return true;
    } else if(code>=48 && code<=57) { // is a number.
    	return true;
    } else{ // other keys.
    	return false;
    }
	}
	</script> 

</body>
</html>