<?php
ob_start();
require 'fpdf/fpdf.php';
require '../../conexion/conexion.php';

$id_mascota = $_GET['mascota'];

// Datos configuración
$config_q = "SELECT marca, logo FROM configuracion";
$config_r = mysqli_query($mysqli, $config_q);
$conf = mysqli_fetch_assoc($config_r);
$marca = $conf['marca'];
$logo = $conf['logo'];

// Datos mascota
$mascota_q = "SELECT m.*, u.nombre as user_nombre, u.apellidos as user_apellidos, u.correo, u.telefono FROM mascotas m JOIN usuarios u ON m.id_usuario = u.id_usuario WHERE m.id_mascota='$id_mascota'";
$mascota_r = mysqli_query($mysqli, $mascota_q);
$m = mysqli_fetch_assoc($mascota_r);

class PDF extends FPDF {
    function Header() {
        global $marca, $logo;
        $this->Image('../../assets/img/logo/'.$logo, 10, 5, 30);
        $this->SetFont('Arial','B',18);
        $this->Cell(30);
        $this->Cell(0, 10, utf8_decode($marca), 0, 1, 'C');
        $this->SetFont('Arial','',9);
        $this->Cell(30);
        $this->Cell(0, 5, utf8_decode('Historial Clínico Veterinario'), 0, 1, 'C');
        $this->Cell(30);
        $this->Cell(0, 5, 'Fecha: '.date('Y-m-d'), 0, 1, 'C');
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

// ---- DATOS DEL PACIENTE ----
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 8, utf8_decode(' DATOS DEL PACIENTE'), 1, 1, 'L', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(45, 7, 'Nombre:', 1); $pdf->Cell(145, 7, utf8_decode($m['nombre']), 1, 1);
$pdf->Cell(45, 7, 'Especie:', 1); $pdf->Cell(65, 7, utf8_decode($m['especie']), 1);
$pdf->Cell(25, 7, 'Raza:', 1); $pdf->Cell(55, 7, utf8_decode($m['raza']), 1, 1);
$pdf->Cell(45, 7, 'Sexo:', 1); $pdf->Cell(65, 7, utf8_decode($m['sexo']), 1);
$pdf->Cell(25, 7, 'Color:', 1); $pdf->Cell(55, 7, utf8_decode($m['color']), 1, 1);
$pdf->Cell(45, 7, 'Peso:', 1); $pdf->Cell(65, 7, utf8_decode($m['peso'].' '.$m['tipo_peso']), 1);
$pdf->Cell(25, 7, 'Edad:', 1); $pdf->Cell(55, 7, utf8_decode($m['edad']), 1, 1);
$pdf->Cell(45, 7, utf8_decode('Dueño:'), 1); $pdf->Cell(145, 7, utf8_decode($m['user_nombre'].' '.$m['user_apellidos']), 1, 1);
$pdf->Cell(45, 7, utf8_decode('Teléfono:'), 1); $pdf->Cell(65, 7, $m['telefono'], 1);
$pdf->Cell(25, 7, 'Email:', 1); $pdf->Cell(55, 7, $m['correo'], 1, 1);
$pdf->Ln(5);

// ---- CITAS ----
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 8, utf8_decode(' HISTORIAL DE CITAS'), 1, 1, 'L', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(30, 7, 'Fecha', 1); $pdf->Cell(20, 7, 'Hora', 1); $pdf->Cell(50, 7, 'Doctor', 1); $pdf->Cell(90, 7, 'Motivo', 1, 1);
$pdf->SetFont('Arial','',8);
$citas_q = "SELECT * FROM citas WHERE id_mascota='$id_mascota' ORDER BY id_cita DESC";
$citas_r = mysqli_query($mysqli, $citas_q);
while ($c = mysqli_fetch_assoc($citas_r)) {
    $doc_q = mysqli_query($mysqli, "SELECT nombre, apellido FROM doctores WHERE id_doctor='".$c['doctor']."'");
    $doc = mysqli_fetch_assoc($doc_q);
    $doc_name = $doc ? $doc['nombre'].' '.$doc['apellido'] : 'N/A';
    $pdf->Cell(30, 6, $c['fecha_cita'], 1);
    $pdf->Cell(20, 6, $c['hora_cita'], 1);
    $pdf->Cell(50, 6, utf8_decode($doc_name), 1);
    $pdf->Cell(90, 6, utf8_decode(substr($c['motivo'], 0, 60)), 1, 1);
}
$pdf->Ln(5);

// ---- VISITAS ----
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 8, utf8_decode(' HISTORIAL DE VISITAS'), 1, 1, 'L', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25, 7, 'Fecha', 1); $pdf->Cell(55, 7, 'Motivo', 1); $pdf->Cell(55, 7, utf8_decode('Diagnóstico'), 1); $pdf->Cell(55, 7, 'Medicinas', 1, 1);
$pdf->SetFont('Arial','',8);
$visitas_q = "SELECT * FROM visitas WHERE id_mascota='$id_mascota' ORDER BY id_visita DESC";
$visitas_r = mysqli_query($mysqli, $visitas_q);
while ($v = mysqli_fetch_assoc($visitas_r)) {
    $pdf->Cell(25, 6, $v['fecha'], 1);
    $pdf->Cell(55, 6, utf8_decode(substr($v['motivo'], 0, 35)), 1);
    $pdf->Cell(55, 6, utf8_decode(substr($v['diagnostico'], 0, 35)), 1);
    $pdf->Cell(55, 6, utf8_decode(substr($v['medicinas_aplicadas'], 0, 35)), 1, 1);
}
$pdf->Ln(5);

// ---- INTERNAMIENTOS ----
if ($pdf->GetY() > 230) $pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 8, utf8_decode(' HISTORIAL DE INTERNAMIENTOS'), 1, 1, 'L', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25, 7, 'Entrada', 1); $pdf->Cell(25, 7, 'Salida', 1); $pdf->Cell(70, 7, 'Motivo', 1); $pdf->Cell(70, 7, 'Tratamiento', 1, 1);
$pdf->SetFont('Arial','',8);
$int_q = "SELECT * FROM internamientos WHERE id_mascota='$id_mascota' ORDER BY id_internamiento DESC";
$int_r = mysqli_query($mysqli, $int_q);
while ($i = mysqli_fetch_assoc($int_r)) {
    $pdf->Cell(25, 6, $i['fecha_entrada'], 1);
    $pdf->Cell(25, 6, $i['fecha_salida'] ?: 'Internado', 1);
    $pdf->Cell(70, 6, utf8_decode(substr($i['motivo'], 0, 45)), 1);
    $pdf->Cell(70, 6, utf8_decode(substr($i['tratamiento'], 0, 45)), 1, 1);
}
$pdf->Ln(5);

// ---- VACUNAS ----
if ($pdf->GetY() > 230) $pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(0, 109, 91);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 8, utf8_decode(' VACUNAS Y DESPARASITACIONES'), 1, 1, 'L', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(60, 7, 'Vacuna', 1); $pdf->Cell(40, 7, utf8_decode('Fecha aplicación'), 1); $pdf->Cell(40, 7, 'Meses', 1); $pdf->Cell(50, 7, utf8_decode('Próxima fecha'), 1, 1);
$pdf->SetFont('Arial','',8);
$vac_q = "SELECT * FROM vacunas WHERE id_mascota='$id_mascota' ORDER BY id_vacuna DESC";
$vac_r = mysqli_query($mysqli, $vac_q);
while ($va = mysqli_fetch_assoc($vac_r)) {
    $pdf->Cell(60, 6, utf8_decode($va['nombre_vacuna']), 1);
    $pdf->Cell(40, 6, $va['fecha_aplicacion'], 1);
    $pdf->Cell(40, 6, $va['tiempo_meses'].' meses', 1);
    $pdf->Cell(50, 6, $va['proxima_fecha'], 1, 1);
}

$pdf->Output('I', 'Historial_'.$m['nombre'].'.pdf');
?>