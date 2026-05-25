<?php
require("C:/xampp/htdocs/veterinaria/conexion/conexion.php");

echo "=== TABLA USUARIOS ===\n";
$r = mysqli_query($mysqli, "DESCRIBE usuarios");
while($f = mysqli_fetch_assoc($r)) echo $f['Field'].': '.$f['Type']."\n";

echo "\n=== TABLA MASCOTAS ===\n";
$r2 = mysqli_query($mysqli, "DESCRIBE mascotas");
while($f = mysqli_fetch_assoc($r2)) echo $f['Field'].': '.$f['Type']."\n";

echo "\n=== TABLAS EXISTENTES ===\n";
$r3 = mysqli_query($mysqli, "SHOW TABLES");
while($f = mysqli_fetch_row($r3)) echo $f[0]."\n";
?>
