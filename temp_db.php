<?php
$mysqli = new MySQLi("localhost", "root", "", "veterinaria");
$res = $mysqli->query("ALTER TABLE citas ADD COLUMN descripcion TEXT NULL");
if ($res) {
    echo "Column 'descripcion' successfully added to 'citas' table!";
} else {
    echo "Error adding column: " . $mysqli->error;
}
?>
