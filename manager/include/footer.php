<footer class="page-footer">
	<?php
	require("../conexion/conexion.php");
	$configuracion="SELECT pie_pagina FROM configuracion ";
	$config=mysqli_query($mysqli,$configuracion);
	while ($conf=mysqli_fetch_row ($config)){
		$pie_pagina=$conf[0];

		echo '<p class="mb-0">'.htmlentities($pie_pagina).'</p>';
	}
	?>
</footer>