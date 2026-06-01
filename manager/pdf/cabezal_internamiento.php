<?php

require 'fpdf/fpdf.php';

class PDF extends FPDF
{
	function Header()
	{	

		ob_start();

		require("../../conexion/conexion.php");
		$configuracion="SELECT marca, logo FROM configuracion ";
		$config=mysqli_query($mysqli,$configuracion);
		while ($conf=mysqli_fetch_row ($config)){
			$marca=$conf[0];
			$logo=$conf[1];
		}


		$this->Image('../../assets/img/logo/'.$logo.'', 40, 5, 34 );
		$this->SetFont('Arial','B',25);
		$this->Cell(40);
		$this->Cell(135,20, ''.$marca.'',0,0,'C');
		$this->SetFont('Arial','B',9);
		$this->Cell(-135,40, utf8_decode('Fecha de expedición: '.date('Y-m-d').' '),0,0,'C');
		$this->Ln(45);
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I', 8);
		$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
	}		
}
?>
