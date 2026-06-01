<footer class="page-footer">
	<?php
	require("../conexion/conexion.php");
	$configuracion="SELECT pie_pagina, telefono FROM configuracion ";
	$config=mysqli_query($mysqli,$configuracion);
	while ($conf=mysqli_fetch_row ($config)){
		$pie_pagina=$conf[0];
		$whatsapp=$conf[1];

		echo '<p class="mb-0">'.htmlentities($pie_pagina).'</p>';
	}
	?>
</footer>


<!----- REDES SOCIALES ----->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp ?>&text=Hola,%20%20Quisiera%20realizar%20una%20consulta" class="float" target="_blank">
	<i class="fa fa-whatsapp my-float"></i>
</a>
<!----- REDES SOCIALES ----->