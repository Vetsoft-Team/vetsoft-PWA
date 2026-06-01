<?php

include 'cabezal_internamiento.php';
require '../../conexion/conexion.php';

$id_internamiento=$_GET['internamiento'];


$query = "SELECT * FROM internamientos WHERE id_internamiento='$id_internamiento'";
$resultado = $mysqli->query($query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

while($row = $resultado->fetch_assoc())
{

	$id_internamiento = $row['id_internamiento'];
	$id_mascota = $row['id_mascota'];
	$fecha_entrada = $row['fecha_entrada'];
	$fecha_salida = $row['fecha_salida'];
	$medicinas_aplicadas = $row['medicinas_aplicadas'];
	$motivo = $row['motivo'];
	$antecedentes = $row['antecedentes'];
	$tratamiento = $row['tratamiento'];
	$fecha_registro = $row['fecha_registro'];
	$estado = $row['estado'];


	$mascotas_="SELECT id_usuario, nombre, raza, sexo FROM mascotas WHERE id_mascota='$id_mascota' ";
	$mascotas=mysqli_query($mysqli,$mascotas_);
	while ($mascota=mysqli_fetch_row ($mascotas)){
		$id_usuario=$mascota[0];
		$nombre=$mascota[1];
		$raza=$mascota[2];
		$sexo=$mascota[3];
	}

	$usuarios_="SELECT nombre, apellidos, correo, telefono FROM usuarios WHERE id_usuario='$id_usuario' ";
	$usuarios=mysqli_query($mysqli,$usuarios_);
	while ($usuario=mysqli_fetch_row ($usuarios)){
		$nombre_u=$usuario[0];
		$apellido_u=$usuario[1];
		$correo_u=$usuario[2];
		$telefono_u=$usuario[3];
	}


	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(85,10,utf8_decode('Dueño'),1,0,'C',1);
	$pdf->Cell(55,10,utf8_decode('Correo'),1,0,'C',1);
	$pdf->Cell(50,10,utf8_decode('Telefono'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(85,10,utf8_decode($nombre_u." ".$apellido_u),1,0,'C',1);
	$pdf->Cell(55,10,utf8_decode($correo_u),1,0,'C',1);
	$pdf->Cell(50,10,utf8_decode($telefono_u),1,1,'C',1);
	/*------------------------------------------------*/

	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(85,10,utf8_decode('Mascota'),1,0,'C',1);
	$pdf->Cell(55,10,utf8_decode('Raza'),1,0,'C',1);
	$pdf->Cell(50,10,utf8_decode('Sexo'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(85,10,utf8_decode($nombre),1,0,'C',1);
	$pdf->Cell(55,10,utf8_decode($raza),1,0,'C',1);
	$pdf->Cell(50,10,utf8_decode($sexo),1,1,'C',1);
	/*------------------------------------------------*/
	$pdf->Ln(15);


	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(95,10,utf8_decode('Fecha entrada'),1,0,'C',1);
	$pdf->Cell(95,10,utf8_decode('Fecha salida'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(95,10,utf8_decode($fecha_entrada),1,0,'C',1);
	$pdf->Cell(95,10,utf8_decode($fecha_salida),1,1,'C',1);
	/*------------------------------------------------*/




	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,10,utf8_decode('Medicinas aplicadas'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$texto = utf8_decode($medicinas_aplicadas);
	$pdf->MultiCell(190,7,$texto,1,1,'C',1);
	/*------------------------------------------------*/




	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,10,utf8_decode('Motivo'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$texto = utf8_decode($motivo);
	$pdf->MultiCell(190,7,$texto,1,1,'C',1);
	/*------------------------------------------------*/




	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,10,utf8_decode('Antecedentes'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$texto = utf8_decode($antecedentes);
	$pdf->MultiCell(190,7,$texto,1,1,'C',1);
	/*------------------------------------------------*/





	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,10,utf8_decode('Tratamiento'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$texto = utf8_decode($tratamiento);
	$pdf->MultiCell(190,7,$texto,1,1,'C',1);
	/*------------------------------------------------*/


}


$pdf->Output();

?>