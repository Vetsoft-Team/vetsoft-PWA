<!--start header -->
<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			<div class="search-bar flex-grow-1">
				<div class="position-relative search-bar-box">
					<form action="<?php $_SERVER['PHP_SELF']; ?>mascotas" method="POST">
						<input type="text" class="form-control search-control" name="nombre_busqueda" placeholder="Busca mascotas por nombre, raza o especie"> 
						<span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
						<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
					</form>
				</div>
			</div>
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center">
					<li class="nav-item mobile-search-icon">
						<a class="nav-link" href="#">	<i class='bx bx-search'></i>
						</a>
					</li>
					<li class="nav-item dropdown dropdown-large">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	<i class='bx bx-category'></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<div class="row row-cols-3 g-3 p-3">
								<div class="col text-center">
									<a href="config_marca">
										<div class="app-box mx-auto"><i class='bx bx-slider-alt'></i>
										</div>
										<div class="app-title">Marca</div>
									</a>
								</div>
								<div class="col text-center">
									<a href="config_titulo">
										<div class="app-box mx-auto"><i class='bx bx-slider-alt'></i>
										</div>
										<div class="app-title">Titulo</div>
									</a>
								</div>
								<div class="col text-center">
									<a href="config_copyright">
										<div class="app-box mx-auto"><i class='bx bx-slider-alt'></i>
										</div>
										<div class="app-title">Copyright</div>
									</a>
								</div>
								<div class="col text-center">
									<a href="config_favicon">
										<div class="app-box mx-auto"><i class='bx bx-slider-alt'></i>
										</div>
										<div class="app-title">Favicon</div>
									</a>
								</div>
								<div class="col text-center">
									<a href="config_logo">
										<div class="app-box mx-auto"><i class='bx bx-slider-alt'></i>
										</div>
										<div class="app-title">Logo</div>
									</a>
								</div>
								<div class="col text-center">
									<a href="config_fondos">
										<div class="app-box mx-auto"><i class='bx bx-slider-alt'></i>
										</div>
										<div class="app-title">Fondos</div>
									</a>
								</div>
							</div>
						</div>
					</li>

									<li class="nav-item dropdown dropdown-large">
					<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">
						<?php
						require("../conexion/conexion.php");
						$citas_ = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM citas WHERE estado='0'");
						$citas = mysqli_fetch_assoc($citas_);
						echo $citas["total"];
						?>
					</span>
					<i class='bx bx-calendar'></i>
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a href="javascript:;">
						<div class="msg-header">
							<p class="msg-header-title">Citas pendientes</p>
							<p class="msg-header-clear ms-auto">Fecha y hora</p>
						</div>
					</a>
					<div class="header-message-list">

						<?php

						require("../conexion/conexion.php");

						$citas="SELECT * FROM citas WHERE estado='0' ORDER BY id_cita DESC LIMIT 6";
						$citas_=mysqli_query($mysqli,$citas);
						while ($cita=mysqli_fetch_row ($citas_)){

							$nombre_de_mascota = "Desconocida";
							$imagen_pet = "default.png";

							$id_cita = $cita[0];
							$id_mascota = $cita[1];
							$fecha_cita = $cita[3];
							$hora_cita = $cita[4];
							$motivo = $cita[6];

							$mascota_n=("SELECT * FROM mascotas WHERE id_mascota='$id_mascota'");
							$mascota_n_=mysqli_query($mysqli,$mascota_n);
							while($m_n=mysqli_fetch_array($mascota_n_)){
								$nombre_de_mascota = $m_n['nombre'];
							}

									//IMAGENES
							$imagenes_m="SELECT imagen FROM mascotas_img WHERE id_mascota='$id_mascota'";
							$m_imagenes=mysqli_query($mysqli,$imagenes_m);
							while ($imagenes_v=mysqli_fetch_row ($m_imagenes)){
								if (!empty($imagenes_v[0])) {
									$imagen_pet=$imagenes_v[0];
								}
							}
									//IMAGENES

							echo 
							'
							<a class="dropdown-item" href="citas/'.$id_cita.'/'.$id_mascota.'">
							<div class="d-flex align-items-center">
							<div class="user-online">
							<img src="../assets/img/mascotas/'.$imagen_pet.'" class="msg-avatar" alt="user avatar">
							</div>
							<div class="flex-grow-1">
							<h6 class="msg-name">'.htmlentities($nombre_de_mascota).' <span class="msg-time float-end">'.htmlentities($fecha_cita.' '.$hora_cita).'</span></h6>
							<p class="msg-info">'.htmlentities(substr($motivo, 0, 30)).'...</p>
							</div>
							</div>
							</a>
							';
						}

						?>


					</div>
					<a href="citas">
						<div class="text-center msg-footer">Ver todas las citas</div>
					</a>
				</div>
			</li>

		</ul>
	</div>

	<?php
	require("../conexion/conexion.php");
	$configuracion="SELECT logo FROM configuracion ";
	$config=mysqli_query($mysqli,$configuracion);
	while ($conf=mysqli_fetch_row ($config)){
		$logo=$conf[0];
	}
	?>

	<div class="user-box dropdown">
		<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			<img src="../assets/img/logo/<?php echo $logo ?>" class="user-img" alt="user avatar">
			<div class="user-info ps-3">
				<p class="user-name mb-0"><?php echo $_SESSION['nombre']." ".$_SESSION['apellidos']; ?></p>
				<p class="designattion mb-0"><?php echo $_SESSION['correo'] ?></p>
			</div>
		</a>
		<ul class="dropdown-menu dropdown-menu-end">
			<li><a class="dropdown-item" href="cuenta"><i class="bx bx-user"></i><span>Cuenta</span></a>
			</li>
			<li><a class="dropdown-item" href="actividad"><i class="bx bx-cog"></i><span>Actividad</span></a>
			</li>
			<li><a class="dropdown-item" href="acerca-de"><i class='bx bx-help-circle'></i><span>Acerca de</span></a>
			</li>
			<li>
				<div class="dropdown-divider mb-0"></div>
			</li>
			<li><a class="dropdown-item" href="desconectar"><i class='bx bx-log-out-circle'></i><span>Cerrar Sesión</span></a>
			</li>
		</ul>
	</div>

</nav>
</div>
</header>
<!--end header -->