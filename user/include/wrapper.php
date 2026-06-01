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
					<a href="mascotas" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-donate-heart'></i>
						</div>
						<div class="menu-title">Mis Mascotas</div>
					</a>
				</li>
				<li>
					<a href="mascotas-nuevo" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-donate-heart'></i>
						</div>
						<div class="menu-title">Nueva Mascota</div>
					</a>
				</li>
				<li>
					<a href="citas" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-calendar'></i>
						</div>
						<div class="menu-title">Mis citas</div>
					</a>
				</li>
                <!--				
				<li class="menu-label">Tienda</li>
				

				<li>
					<a href="productos" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Productos</div>
					</a>
				</li>-->

				<!------------------------------------->
				<li class="menu-label">Cuenta</li>
				<!------------------------------------->

				<li>
					<a href="cuenta" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-slider-alt"></i>
						</div>
						<div class="menu-title">Mi cuenta</div>
					</a>
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