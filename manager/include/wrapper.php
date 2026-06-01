		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="../assets/img/favicon/<?php echo $favicon ?>" width="20" class="logo-icon" alt="logo icon">
				</div>
				<div>

					<?php
					require("../conexion/conexion.php");
					$configuracion="SELECT marca FROM configuracion ";
					$config=mysqli_query($mysqli,$configuracion);
					while ($conf=mysqli_fetch_row ($config)){
						$marca=$conf[0];
					}
					?>
					<h4 class="logo-text text-capitalize"><?php echo $marca ?></h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="index" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Inicio</div>
					</a>
				</li>
				<?php if ($_SESSION['rol'] == 3) { ?>
					<!------------------------------------->
					<li class="menu-label">Panel de Doctor</li>
					<!------------------------------------->
					<li>
						<a href="mis-citas" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-calendar-star'></i>
							</div>
							<div class="menu-title">Mis Citas del Día</div>
						</a>
					</li>
					<li>
						<a href="mascotas" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-donate-heart'></i>
							</div>
							<div class="menu-title">Mascota/Paciente</div>
						</a>
					</li>
					<li>
						<a href="internamientos" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
							</div>
							<div class="menu-title">Internamientos</div>
						</a>
					</li>
				<?php } else { ?>
					<li>
						<a href="estadisticas" class="has-arrow">
							<div class="parent-icon"><i class="bx bx-category"></i>
							</div>
							<div class="menu-title">Estadisticas</div>
						</a>
					</li>

					<!------------------------------------->
					<li class="menu-label">Menu</li>
					<!------------------------------------->

					<li>
						<a href="usuarios" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-group'></i>
							</div>
							<div class="menu-title">Usuarios</div>
							</a>
					</li>
					<li>
						<a href="mascotas" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-donate-heart'></i>
							</div>
							<div class="menu-title">Mascota/Paciente</div>
						</a>
					</li>
					<li>
						<a href="internamientos" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
							</div>
							<div class="menu-title">Internamientos</div>
						</a>
					</li>
					<li>
						<a href="citas" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-calendar'></i>
							</div>
							<div class="menu-title">Calendario de citas</div>
						</a>
					</li>
					<li>
						<a href="citas-agendar" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-plus-medical'></i>
							</div>
							<div class="menu-title">Agendar cita</div>
						</a>
					</li>
					<li>
						<a href="citas-agendar?tipo=urgencia" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-error-circle'></i>
							</div>
							<div class="menu-title">Cita de urgencia</div>
						</a>
					</li>
					<li>
						<a href="doctores" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-vial'></i>
							</div>
							<div class="menu-title">Doctores</div>
						</a>
					</li>
				<?php } ?>
                <!--
				
				<li class="menu-label">Sistema</li>
				

				<li>
					<a href="caja" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Caja de cobro</div>
					</a>
				</li>
				<li>
					<a href="ventas" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Ventas</div>
					</a>
				</li>
				
				<li>
					<a href="inventario" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-box"></i>
						</div>
						<div class="menu-title">Inventario</div>
					</a>
				</li> -->

				<!------------------------------------->
				<li class="menu-label">Configuración</li>
				<!------------------------------------->

				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-slider-alt"></i>
						</div>
						<div class="menu-title">Sistema</div>
					</a>
					<ul>
						<li> <a href="config_marca"><i class="bx bx-right-arrow-alt"></i>Marca</a>
						</li>
						<li> <a href="config_titulo"><i class="bx bx-right-arrow-alt"></i>Titulo</a>
						</li>
						<li> <a href="config_copyright"><i class="bx bx-right-arrow-alt"></i>Copyright</a>
						</li>
						<li> <a href="config_favicon"><i class="bx bx-right-arrow-alt"></i>Favicon</a>
						</li>
						<li> <a href="config_logo"><i class="bx bx-right-arrow-alt"></i>Logo</a>
						</li>
						<li> <a href="config_fondos"><i class="bx bx-right-arrow-alt"></i>Fondos</a>
						</li>
						<li> <a href="config_telefono"><i class="bx bx-right-arrow-alt"></i>Whatsapp</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="acerca-de" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-help-circle"></i>
						</div>
						<div class="menu-title">Acerca de</div>
					</a>
				</li>


			</ul>
			<!--navigation-->
		</div>
		<!--sidebar wrapper -->