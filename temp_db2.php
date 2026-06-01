<?php
require("C:/xampp/htdocs/veterinaria/conexion/conexion.php");

echo "=== TABLA RAZAS ===\n";
$r = mysqli_query($mysqli, "DESCRIBE razas");
while($f = mysqli_fetch_assoc($r)) echo $f['Field'].': '.$f['Type']."\n";

echo "\n=== TABLA VACUNAS ===\n";
$r2 = mysqli_query($mysqli, "DESCRIBE vacunas");
while($f = mysqli_fetch_assoc($r2)) echo $f['Field'].': '.$f['Type']."\n";

echo "\n=== TABLA CITAS ===\n";
$r3 = mysqli_query($mysqli, "DESCRIBE citas");
while($f = mysqli_fetch_assoc($r3)) echo $f['Field'].': '.$f['Type']."\n";

echo "\n=== TABLA VISITAS ===\n";
$r4 = mysqli_query($mysqli, "DESCRIBE visitas");
while($f = mysqli_fetch_assoc($r4)) echo $f['Field'].': '.$f['Type']."\n";

echo "\n=== TABLA INTERNAMIENTOS ===\n";
$r5 = mysqli_query($mysqli, "DESCRIBE internamientos");
while($f = mysqli_fetch_assoc($r5)) echo $f['Field'].': '.$f['Type']."\n";

echo "\n=== RAZAS EXISTENTES ===\n";
$r6 = mysqli_query($mysqli, "SELECT * FROM razas LIMIT 10");
while($f = mysqli_fetch_assoc($r6)) print_r($f);
?>
