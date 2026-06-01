<?php
ob_start();
session_start();

if (@!$_SESSION['correo']) {
    header("Location: ../../desconectar");
    exit;
} elseif ($_SESSION['rol'] == 2) {
    header("Location: ../../desconectar");
    exit;
}

require 'fpdf/fpdf.php';
require '../../conexion/conexion.php';

$id_cita = $_GET['cita'];

// Obtener datos de la cita
$query = mysqli_query($mysqli, "SELECT * FROM citas WHERE id_cita='$id_cita'");
$cita = mysqli_fetch_assoc($query);

if (!$cita) {
    ob_end_clean();
    echo "<center><h3 style='margin-top: 50px; font-family: Arial; color: #cc0000;'>La cita no existe.</h3></center>";
    exit;
}

$id_mascota = $cita['id_mascota'];
$fecha_cita = $cita['fecha_cita'];
$hora_cita = $cita['hora_cita'];
$doctor_id = $cita['doctor'];
$motivo = $cita['motivo'];
$descripcion = isset($cita['descripcion']) ? $cita['descripcion'] : '';
$fecha_registro = $cita['fecha_registro'];

// Obtener datos del doctor
$doctor_q = mysqli_query($mysqli, "SELECT * FROM doctores WHERE id_doctor='$doctor_id'");
$doc = mysqli_fetch_assoc($doctor_q);
$nombre_doctor = $doc ? $doc['nombre'].' '.$doc['apellido'] : 'N/A';

// Obtener datos de la mascota y dueño
$mascota_q = mysqli_query($mysqli, "SELECT m.*, u.nombre as user_nombre, u.apellidos as user_apellidos, u.correo, u.telefono FROM mascotas m JOIN usuarios u ON m.id_usuario = u.id_usuario WHERE m.id_mascota='$id_mascota'");
$m = mysqli_fetch_assoc($mascota_q);

// Datos configuración
$config_q = "SELECT marca, logo FROM configuracion";
$config_r = mysqli_query($mysqli, $config_q);
$conf = mysqli_fetch_assoc($config_r);
$marca = $conf['marca'];
$logo = $conf['logo'];

class PDF extends FPDF {
    function Header() {
        global $marca, $logo, $fecha_cita, $hora_cita;
        $this->Image('../../assets/img/logo/'.$logo, 10, 5, 30);
        $this->SetFont('Arial','B',18);
        $this->Cell(30);
        $this->Cell(0, 10, utf8_decode($marca), 0, 1, 'C');
        $this->SetFont('Arial','',9);
        $this->Cell(30);
        $this->Cell(0, 5, utf8_decode('Reporte de Consulta / Cita Médica'), 0, 1, 'C');
        $this->Cell(30);
        $this->Cell(0, 5, utf8_decode('Fecha de Cita: '.$fecha_cita.'  Hora: '.$hora_cita), 0, 1, 'C');
        $this->Ln(5);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(3);
    }
    function Footer() {
        $this->SetY(-25);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(2);
        $this->SetFont('Arial','I',8);
        $this->Cell(0, 5, '_____________________________', 0, 1, 'C');
        $this->Cell(0, 5, 'Firma del Doctor', 0, 1, 'C');
        $this->Cell(0, 5, 'Pagina '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

ob_end_clean();
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

/*------------------------------------------------*/
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(85,8,utf8_decode('Dueño / Cliente'),1,0,'L',1);
$pdf->Cell(55,8,utf8_decode('Correo'),1,0,'L',1);
$pdf->Cell(50,8,utf8_decode('Teléfono'),1,1,'L',1);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(85,8,utf8_decode($m['user_nombre']." ".$m['user_apellidos']),1,0,'L',1);
$pdf->Cell(55,8,utf8_decode($m['correo']),1,0,'L',1);
$pdf->Cell(50,8,utf8_decode($m['telefono']),1,1,'L',1);
/*------------------------------------------------*/

/*------------------------------------------------*/
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(85,8,utf8_decode('Mascota / Paciente'),1,0,'L',1);
$pdf->Cell(55,8,utf8_decode('Raza / Especie'),1,0,'L',1);
$pdf->Cell(50,8,utf8_decode('Sexo'),1,1,'L',1);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(85,8,utf8_decode($m['nombre']),1,0,'L',1);
$pdf->Cell(55,8,utf8_decode($m['raza']." / ".$m['especie']),1,0,'L',1);
$pdf->Cell(50,8,utf8_decode($m['sexo']),1,1,'L',1);
/*------------------------------------------------*/
$pdf->Ln(5);

/*------------------------------------------------*/
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(190,8,utf8_decode('Doctor Asignado'),1,1,'L',1);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,8,utf8_decode($nombre_doctor),1,1,'L',1);
/*------------------------------------------------*/
$pdf->Ln(5);

/*------------------------------------------------*/
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(190,8,utf8_decode('Motivo de la Cita'),1,1,'L',1);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',10);
$texto = utf8_decode($motivo);
$pdf->MultiCell(190,7,$texto,1,'L',1);
/*------------------------------------------------*/
$pdf->Ln(5);

/*------------------------------------------------*/
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(190,8,utf8_decode('Descripción de la Consulta / Diagnóstico y Tratamiento'),1,1,'L',1);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',10);
$texto_desc = utf8_decode($descripcion ?: 'No se ha registrado descripción aún.');
$pdf->MultiCell(190,7,$texto_desc,1,'L',1);
/*------------------------------------------------*/

$pdf->Output('I', 'Consulta_'.$m['nombre'].'_'.date('Ymd').'.pdf');
?>
