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
	<script src="validaciones/mascotas/js/jquery-3.4.1.min.Js"></script>
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
					<div class="breadcrumb-title pe-3">Mascotas</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="mascotas">Lista de mascotas</a></li>
								<li class="breadcrumb-item active" aria-current="page">Nueva Mascota/Paciente</li>
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
								<a class="dropdown-item" href="mascotas">Lista de mascotas</a>
								<a class="dropdown-item" href="mascotas-nuevo">Nueva mascota</a>
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
												<center><h5>DATOS DEL DUEÑO</h5></center>
											</div>
										</div>
										<hr>

										<div class="row mb-3">

											<div class="col-sm-6">
												<center><label style="color: green;">Buscador</label></center>
												<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
													<div class="form-outline">
														<input type="search" name="buscando" class="form-control" style="border: 1px solid green;" placeholder="Buscar usuarios" />
													</div>
												</form>
											</div>


											<div class="col-sm-6">


												<center>
													<label>Nombre del usuario a asignar</label>
													<select class="form-control" id="id_usuario">
														<?php
														require("../conexion/conexion.php");

														$q = "";

														if(!empty($_POST))
														{
															$q = $_POST['buscando'];
														}


														$sql=("SELECT * FROM usuarios WHERE (nombre LIKE '%$q%' or apellidos LIKE '%$q%' or correo LIKE '%$q%') ORDER BY id_usuario DESC");
														$query=mysqli_query($mysqli,$sql);
														while($arreglo=mysqli_fetch_array($query)){
															$id_usuario = $arreglo['id_usuario'];
															$nombre = $arreglo['nombre'];
															$apellidos = $arreglo['apellidos'];
															echo '<option value="'.$id_usuario.'" style="color: black;">'.$nombre.' '.$apellidos.'</option>';
														}
														?>
													</select>
												</center>
											</div>
										</div>

										<br>
										<hr>
										<div class="row">
											<div class="col-sm-12">
												<center><h5>DATOS DE LA MASCOTA</h5></center>
											</div>
										</div>
										<hr>
										<br>
										<center>
											<div class="row mb-3">
												<div class="col-sm-4">
													<label class="form-label">Nombre</label>
													<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="nombre" placeholder="Ingresa el nombre"/>
												</div>
												<div class="col-sm-4">
													<label class="form-label">Fecha de nacimiento</label>
													<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"min="2013-01-01" max="2022-01-01"/>
												</div>

												<div class="col-sm-4">
													<label class="form-label">Edad</label>
													<input type="text" name="" id="edad" class="form-control input-sm" readonly=""/>
											    	<!--<input type="text" class="form-control" onkeypress="return solonumeros(event)" id="edad" placeholder="Ingresa la edad">-->
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-3">
													<label class="form-label">Especie</label>
													<select type="text" class="form-control" id="especie">
														<option value="" style="color: black;">Seleccionar</option>
														<option value="Perro" style="color: black;">Perro</option>
														<option value="Gato" style="color: black;">Gato</option>
                                                                                                                <option value="Loro" style="color: black;">Loro </option>
														<option value="Hamster" style="color: black;">Hamster</option>
                                                                                                                <option value="Poodle" style="color: black;">Poodle</option>
                                                                                                    </select>
												</div>
                                                                                           
												<div class="col-sm-3">
													<label class="form-label">Raza</label>
													<select type="text" class="form-control" id="raza">
														<option value="" style="color: black;">Seleccionar</option>
														<option value="Bulldog" style="color: black;">Bulldog</option>
														<option value="Chihuahua" style="color: black;">Chihuahua</option>
                                                                                                                <option value="Labrador" style="color: black;">Labrador </option>
														<option value="Pastor alemán" style="color: black;">Pastor alemán</option>
                                                                                                                <option value="Poodle" style="color: black;">Poodle</option>
														<option value="Golden retriever" style="color: black;">Golden retriever</option>
                                                                                                                <option value="Pug" style="color: black;">Pug</option>
														<option value="Husky siberiano" style="color: black;">Husky siberiano</option>
														<option value="Bóxer" style="color: black;">Bóxer</option>
                                                                                                                <option value="Bull terrier" style="color: black;">Bull terrier </option>
														<option value="Cocker" style="color: black;">Cocker</option>
                                                                                                                <option value="Basset hound" style="color: black;">Basset hound</option>
														<option value="Chow Chow" style="color: black;">Chow Chow</option>
                                                                                                                <option value="Pinscher" style="color: black;">Pinscher </option>
														<option value="Doberman" style="color: black;">Doberman</option>
                                                                                                                <option value="Rottweiler" style="color: black;">Rottweiler</option>
														<option value="Schnauzer" style="color: black;">Schnauzer</option>

													</select>
												</div>
												
												<div class="col-sm-3">
													<label class="form-label">Color</label>
													<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="color" placeholder="Ingresa el color">
												</div>
												<div class="col-sm-3">
													<label class="form-label">Sexo</label>
													<select type="text" class="form-control" id="sexo">
														<option value="" style="color: black;">Sexo</option>
														<option value="Macho" style="color: black;">Macho</option>
														<option value="Hembra" style="color: black;">Hembra</option>
													</select>
												</div>
											</div>

											<div class="row mb-3">
												
												<div class="col-sm-8">
													<label class="form-label">Peso </label>
													<div class="row">
														<div class="col-sm-6">
															<input type="text" class="form-control" id="peso" required placeholder="Ingresa el peso">
														</div>
														<div class="col-sm-6">
															<select type="text" class="form-control" id="tipo_peso">
																<option value="Kilogramos" style="color: black;">Kilogramos</option>
																<option value="Gramos" style="color: black;">Gramos</option>
															</select>
														</div>
													</div>
												</div>

												<div class="col-sm-4">
													<center>
														<label>Mascota</label>
														<br>
														<div class="photo">
															<div class="prevPhoto">
																<span class="delPhoto notBlock">X</span>
																<label for="foto"></label>
															</div>
															<div class="upimg">
																<input type="file" id="foto">
															</div>
															<div id="form_alert"></div>
														</div>
														<small class="color_blanco">Sube aqui la imagen de la mascota</small>
													</center>
												</div>

											</div>



											<div class="row">
												<div class="col-sm-12 d-grid gap-2">
													<button type="button" class="btn btn-light px-4 btn-block" id="mascotas-agregar">Crear mascota</button>
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

														// Dependencia de Raza y Especie, y cálculo de Edad
														$(document).ready(function() {
															var razas = {
																"Perro": ["Bulldog", "Chihuahua", "Labrador", "Pastor alemán", "Poodle", "Golden retriever", "Pug", "Husky siberiano", "Bóxer", "Bull terrier", "Cocker", "Basset hound", "Chow Chow", "Pinscher", "Doberman", "Rottweiler", "Schnauzer"],
																"Gato": ["Persa", "Siamés", "Maine Coon", "Bengalí", "Esfinge", "Ragdoll", "Mestizo"],
																"Loro": ["Guacamaya", "Cacatúa", "Ninfa", "Periquito"],
																"Hamster": ["Sirio", "Ruso", "Roborovski", "Chino"],
																"Poodle": ["Toy", "Miniatura", "Estándar"]
															};

															$("#especie").change(function() {
																var especieSeleccionada = $(this).val();
																var $razaSelect = $("#raza");
																$razaSelect.empty();
																$razaSelect.append('<option value="" style="color: black;">Seleccionar</option>');
																
																if (especieSeleccionada && razas[especieSeleccionada]) {
																	$.each(razas[especieSeleccionada], function(index, value) {
																		$razaSelect.append('<option value="'+value+'" style="color: black;">'+value+'</option>');
																	});
																}
															});

															$("#fecha_nacimiento").change(function() {
																var fechaNac = new Date($(this).val());
																var hoy = new Date();
																var edadAnios = hoy.getFullYear() - fechaNac.getFullYear();
																var edadMeses = hoy.getMonth() - fechaNac.getMonth();

																if (edadMeses < 0 || (edadMeses === 0 && hoy.getDate() < fechaNac.getDate())) {
																	edadAnios--;
																	edadMeses += 12;
																}

																var textoEdad = "";
																if (edadAnios > 0) {
																	textoEdad += edadAnios + (edadAnios === 1 ? " año " : " años ");
																}
																if (edadMeses > 0 || edadAnios === 0) {
																	textoEdad += edadMeses + (edadMeses === 1 ? " mes" : " meses");
																}
																$("#edad").val(textoEdad.trim());
															});
														});

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
	<script src="validaciones/mascotas/js/mascotas-agregar.js"></script>
	
	<script src="../assets/js/app.js"></script>

</body>
<script src='validaciones/mascotas/js/Funciones.js'></script>
</html>