<?php 

session_start();

require("../../../conexion/conexion.php");

$id_mascota= addslashes($_POST['id_mascota']);
$fecha_cita= addslashes($_POST['fecha_cita']);
$hora_cita= addslashes($_POST['hora_cita']);
$doctor_cita= addslashes($_POST['doctor_cita']);
$motivo_cita= addslashes($_POST['motivo_cita']);

date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d h:i:s');



$checkemail=mysqli_query($mysqli,"SELECT * FROM citas WHERE fecha_cita='$fecha_cita' and hora_cita='$hora_cita' and doctor='$doctor_cita' ");
$check_mail=mysqli_num_rows($checkemail);
if($check_mail>0){

	echo 1;

}else{



	$insertar = mysqli_query($mysqli, "INSERT INTO citas (id_mascota, fecha_cita, hora_cita, doctor, motivo, fecha_registro, estado) VALUES('$id_mascota', '$fecha_cita', '$hora_cita', '$doctor_cita', '$motivo_cita', '$fecha', '0')");

	if ($insertar) {

		$citas_="SELECT max(id_cita) FROM citas ";
		$citas=mysqli_query($mysqli,$citas_);
		while ($cita=mysqli_fetch_row ($citas)){

			$id_cita=$cita[0];

			$insertar1 = mysqli_query($mysqli, "INSERT INTO calendario (id_mascota, id_cita, title, color, start, end) VALUES('$id_mascota', '$id_cita', '$motivo_cita', '#1F9C00', '$fecha_cita $hora_cita', '')");

		}

		// --- INICIO INTEGRACION WHATSAPP (CALLMEBOT) ---
		$info_q = mysqli_query($mysqli, "SELECT m.nombre as mascota, u.telefono, u.nombre as dueno FROM mascotas m INNER JOIN usuarios u ON m.id_usuario = u.id_usuario WHERE m.id_mascota = '$id_mascota'");
		if ($info = mysqli_fetch_assoc($info_q)) {
			$doc_q = mysqli_query($mysqli, "SELECT nombre, apellido FROM doctores WHERE id_doctor = '$doctor_cita'");
			$doc = mysqli_fetch_assoc($doc_q);
			
			if(!empty($info['telefono'])) {
				$telefono = preg_replace('/[^0-9]/', '', $info['telefono']);
				$nombre_doc = $doc ? $doc['nombre'] . " " . $doc['apellido'] : "";
				
				$mensaje = "Hola " . $info['dueno'] . "🐾\n\nSe ha agendado una cita para *" . $info['mascota'] . "*.\n\n📅 Fecha: " . $fecha_cita . "\n⏰ Hora: " . $hora_cita . "\n👨‍⚕️ Doctor: " . $nombre_doc . "\n📌 Motivo: " . $motivo_cita . "\n\n¡Los esperamos en VetSoft!";
				
				// Reemplaza con tu API Key real obtenida de CallMeBot enviando un WhatsApp al bot
				$apikey = "TU_API_KEY_CALLMEBOT"; 
				
				$url = "https://api.callmebot.com/whatsapp.php?phone=" . $telefono . "&text=" . urlencode($mensaje) . "&apikey=" . $apikey;
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 3); // Timeout corto para evitar bloqueos
				$response = curl_exec($ch);
				curl_close($ch);
			}
		}
		// --- FIN INTEGRACION WHATSAPP ---

		echo 0;

	}else{

		echo 2;

	}

}



?>