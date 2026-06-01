<?php
session_start();
if (@!$_SESSION['correo']) { header("Location:../../desconectar"); exit; }
if ($_SESSION['rol'] != 1) { echo 0; exit; }

require("../../../conexion/conexion.php");

$id_usuario = intval($_POST['id_usuario']);
$nueva_clave = sha1(trim($_POST['nueva_clave']));

$q = mysqli_query($mysqli, "UPDATE usuarios SET clave='$nueva_clave' WHERE id_usuario='$id_usuario'");
echo $q ? 1 : 0;
?>
