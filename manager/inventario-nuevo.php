<?php 

session_start();
if (@!$_SESSION['correo']) {
	header("Location:desconectar");
}elseif ($_SESSION['rol']==2) {
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
					<div class="breadcrumb-title pe-3">Inventario</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="inventario">Lista de productos</a></li>
								<li class="breadcrumb-item active" aria-current="page">Nuevo producto</li>
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
								<a class="dropdown-item" href="inventario">Lista de productos</a>
								<a class="dropdown-item" href="inventario-nuevo">Nuevo producto</a>
							</div>
						</div>
					</div>
				</div>

				<hr/>


				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<hr>
										<div class="row">
											<div class="col-sm-12">
												<center><h5>NUEVO PRODUCTO</h5></center>
											</div>
										</div>
										<hr>
										<br>
										<center>
											<div class="row mb-3">
												<div class="col-sm-6">
													<label class="form-label">Nombre del articulo</label>
													<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="nombre_articulo" required placeholder="Ingresa el nombre del articulo">
												</div>
												<div class="col-sm-6">
													<label class="form-label">Numero de factura</label>
													<input type="text" class="form-control" onkeypress="return solonumeros(event)" id="numero_factura" required placeholder="Ingresa el numero de factura">
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-4">
													<label class="form-label">Fecha de ingreso</label>
													<input type="date" class="form-control" id="fecha_ingreso">
												</div>
												<div class="col-sm-4">
													<label class="form-label">Proveedor</label>
													<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="proveedor" required placeholder="Ingresa el nombre del proveedor">
												</div>
												<div class="col-sm-4">
													<label class="form-label">Cantidad sugerida</label>
													<input type="number" class="form-control" id="cantidad_sugerida" required placeholder="Ingresa la cantidad sugerida">
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-4">
													<label class="form-label">Stock</label>
													<input type="number" class="form-control" onkeypress="return solonumeros(event)" id="stock" required placeholder="Ingresa el stock disponible">
												</div>
												<div class="col-sm-4">
													<label class="form-label">Precio Unitario</label>
													<input type="number" class="form-control number" onkeypress="return solonumeros(event)"  id="precio_unitario" onkeypress="return valideKey(event);" required placeholder="Ingresa el precio unitario">
												</div>
												<div class="col-sm-4">
													<label class="form-label">Precio sugerido</label>
													<input type="number" class="form-control number2" onkeypress="return solonumeros(event)" id="precio_sugerido" onkeypress="return valideKey(event);" required placeholder="Ingresa el precio sugerido">
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-12">
													<label class="form-label">Descripción del producto</label>
													<div class="input-group" id="show_hide_password">
														<textarea class="form-control" id="descripcion" rows="3" placeholder="Ingresa las descripcion o detalle del producto"></textarea>
													</div>
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-6">
													<label class="form-label">Fecha de vencimiento del producto</label>
													<input type="date" class="form-control" id="fecha_vencimiento">
												</div>
												<div class="col-sm-6">
													<label class="form-label">Codigo de barras</label>
													<input type="text" class="form-control" id="codigo_barras" placeholder="Ingresa el precio unitario">
												</div>
											</div>

											<br>

											<div class="row ">
												<div class="col-lg-12 col-md-12">
													<label>Imagenes del producto</label>
													<br><br>
													<fieldset>
														<div class="row mostrar_foto">	

														</div>	
														<center><button type="button" id="agregar_foto" class="btn btn-primary">+</button></center>
													</fieldset>
												</div>
											</div>

											<br>

											<div class="row">
												<div class="col-sm-12 d-grid gap-2">
													<button type="button" class="btn btn-light px-4 btn-block" id="inventario-agregar">Agregar producto</button>
												</div>
											</div>
										</center>

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
	<script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="../assets/js/sweetalert2.min.js"></script>
	<script src="../assets/js/app.js"></script>
	<script src="validaciones/inventario/js/inventario-agregar.js"></script>

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