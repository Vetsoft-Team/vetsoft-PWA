<?php

include 'cabezal_visita.php';
require '../../conexion/conexion.php';

$id_visita=$_GET['visita'];


$query = "SELECT * FROM visitas WHERE id_visita='$id_visita'";
$resultado = $mysqli->query($query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

while($row = $resultado->fetch_assoc())
{

	$id_visita = $row['id_visita'];
	$id_mascota = $row['id_mascota'];
	$fecha = $row['fecha'];
	$motivo = $row['motivo'];
	$peso = $row['peso'];
	$tipo_peso = $row['tipo_peso'];
	$temperatura = $row['temperatura'];
	$sintomas = $row['sintomas'];
	$diagnostico = $row['diagnostico'];
	$medicinas_aplicadas = $row['medicinas_aplicadas'];
	$visita_proxima = $row['visita_proxima'];
	$motivo_proximo = $row['motivo_proximo'];
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
	$pdf->Cell(190,10,utf8_decode('Motivo de la visita'),1,1,'C',1);

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
	$pdf->Cell(95,10,utf8_decode('Peso'),1,0,'C',1);
	$pdf->Cell(95,10,utf8_decode('Temperatura'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(95,10,utf8_decode($peso." ".$tipo_peso),1,0,'C',1);
	$pdf->Cell(95,10,utf8_decode($temperatura),1,1,'C',1);
	/*------------------------------------------------*/




	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,10,utf8_decode('Sintomas'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$texto = utf8_decode($sintomas);
	$pdf->MultiCell(190,7,$texto,1,1,'C',1);
	/*------------------------------------------------*/




	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,10,utf8_decode('Diagnostico y tratamiento'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$texto = utf8_decode($diagnostico);
	$pdf->MultiCell(190,7,$texto,1,1,'C',1);
	/*------------------------------------------------*/





	/*------------------------------------------------*/
	$pdf->SetFillColor(52,52,52);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,10,utf8_decode('Medicinas o productos aplicados'),1,1,'C',1);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','I',10);
	$texto = utf8_decode($medicinas_aplicadas);
	$pdf->MultiCell(190,7,$texto,1,1,'C',1);
	/*------------------------------------------------*/


	/*------------------------------------------------*/
	$pdf->Ln(30);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(190,10,utf8_decode('_______________________________________'),0,1,'C');
	$pdf->Cell(190,10,utf8_decode('Firma del Doctor'),0,1,'C');
	/*------------------------------------------------*/

}

ob_end_clean();
$pdf->Output();

?>