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
					<div class="breadcrumb-title pe-3">Usuarios</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="estadisticas"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Usuarios activos</li>
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

				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="usuarios_" class="table table-striped table-bordered" style="width:100%;">
								<thead style="background-color: #212529;">
									<tr>
										<th>Nombre</th>
										<th>Apellidos</th>
										<th>Ciudad</th>
										<th>Telefono</th>
										<th>Fecha registro</th>
										<th>Estado</th>
										<th>Detalle</th>
										<th>Contraseña</th>
									</tr>
								</thead>
								<tbody>

									<?php

									require("../conexion/conexion.php");

									$usuarios="SELECT * FROM usuarios WHERE rol='2'";
									$usuario=mysqli_query($mysqli,$usuarios);
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


										echo 
										'
										<tr>
										<td>'.htmlentities($nombre).'</td>
										<td>'.htmlentities($apellidos).'</td>
										<td>'.htmlentities($ciudad).'</td>
										<td>'.htmlentities($telefono).'</td>
										<td>'.htmlentities($fecha_registro).'</td>
										';

										if($estado=='0'){

											echo '<td><span class="badge bg-success">ACTIVO</span></td>';

										}else{

											echo '<td><span class="badge bg-danger">INACTIVO</span></td>';

										}

										echo
										'
										<td><a href="usuarios/'.htmlentities($id_usuario).'"><button type="button" class="btn btn-outline-success px-3 radius-30">Historial</button></a></td>
										<td><button type="button" class="btn btn-outline-warning px-3 radius-30 btn-cambiar-clave" data-id="'.htmlentities($id_usuario).'" data-nombre="'.htmlentities($nombre.' '.$apellidos).'">Cambiar clave</button></td>
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

		<!-- Modal Cambiar Contraseña -->
		<div class="modal fade" id="modal_cambiar_clave" tabindex="-1" aria-labelledby="modalClaveLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="modalClaveLabel">Cambiar contraseña</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        <p>Usuario: <strong id="modal_nombre_usuario"></strong></p>
		        <input type="hidden" id="modal_id_usuario">
		        <div class="mb-3">
		          <label class="form-label">Nueva contraseña</label>
		          <input type="password" class="form-control" id="nueva_clave_admin" placeholder="Ingresa la nueva contraseña">
		        </div>
		        <div class="mb-3">
		          <label class="form-label">Confirmar contraseña</label>
		          <input type="password" class="form-control" id="confirmar_clave_admin" placeholder="Confirma la contraseña">
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-warning" id="btn_guardar_clave">Guardar</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Fin Modal -->

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
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#usuarios_').DataTable({
				dom: 'Bfrtip',
				buttons: [
					{
						extend: 'excelHtml5',
						text: 'Descargar Excel',
						className: 'btn btn-success'
					}
				]
			});

			// CAMBIAR CONTRASEÑA
			$(document).on('click', '.btn-cambiar-clave', function() {
				let id = $(this).data('id');
				let nombre = $(this).data('nombre');
				$('#modal_id_usuario').val(id);
				$('#modal_nombre_usuario').text(nombre);
				$('#nueva_clave_admin').val('');
				$('#confirmar_clave_admin').val('');
				var modal = new bootstrap.Modal(document.getElementById('modal_cambiar_clave'));
				modal.show();
			});

			$('#btn_guardar_clave').click(function() {
				let id_usuario = $('#modal_id_usuario').val();
				let nueva_clave = $('#nueva_clave_admin').val();
				let confirmar_clave = $('#confirmar_clave_admin').val();
				if (nueva_clave == '') {
					Swal.fire('Advertencia', 'Ingresa la nueva contraseña', 'warning'); return;
				}
				if (nueva_clave !== confirmar_clave) {
					Swal.fire('Advertencia', 'Las contraseñas no coinciden', 'warning'); return;
				}
				$.ajax({
					url: 'validaciones/usuarios/usuarios-cambiar-clave',
					type: 'post',
					data: { id_usuario: id_usuario, nueva_clave: nueva_clave },
					success: function(data) {
						if (data == 1) {
							bootstrap.Modal.getInstance(document.getElementById('modal_cambiar_clave')).hide();
							Swal.fire('¡Listo!', 'Contraseña actualizada correctamente', 'success');
						} else {
							Swal.fire('Error', 'No se pudo actualizar la contraseña', 'error');
						}
					}
				});
			});
		});

	</script>
	<script src="../assets/js/app.js"></script>

</body>
</html>