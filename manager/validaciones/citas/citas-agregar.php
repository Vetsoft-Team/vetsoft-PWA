<?php 

session_start();

require("../../../conexion/conexion.php");

$id_mascota= addslashes($_POST['id_mascota']);
$fecha_cita= addslashes($_POST['fecha_cita']);
$hora_cita= addslashes($_POST['hora_cita']);
$doctor_cita= addslashes($_POST['doctor_cita']);
$motivo_cita= addslashes($_POST['motivo_cita']);
$telefono_cita = addslashes($_POST['telefono_cita']);

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

		// --- INICIO INTEGRACION WHATSAPP (ULTRAMSG) ---
		if(!empty($telefono_cita)) {
			// Obtener información para el mensaje
			$info_q = mysqli_query($mysqli, "SELECT m.nombre as mascota, u.nombre as dueno FROM mascotas m INNER JOIN usuarios u ON m.id_usuario = u.id_usuario WHERE m.id_mascota = '$id_mascota'");
			$dueno = "Cliente";
			$mascota = "mascota";
			if ($info = mysqli_fetch_assoc($info_q)) {
				$dueno = $info['dueno'];
				$mascota = $info['mascota'];
			}
			
			$doc_q = mysqli_query($mysqli, "SELECT nombre, apellido FROM doctores WHERE id_doctor = '$doctor_cita'");
			$nombre_doc = "";
			if ($doc = mysqli_fetch_assoc($doc_q)) {
				$nombre_doc = $doc['nombre'] . " " . $doc['apellido'];
			}

			// Formatear mensaje
			$mensaje = "Hola " . $dueno . "🐾\n\nSe ha agendado una cita para *" . $mascota . "*.\n\n📅 Fecha: " . $fecha_cita . "\n⏰ Hora: " . $hora_cita . "\n👨‍⚕️ Doctor: " . $nombre_doc . "\n📌 Motivo: " . $motivo_cita . "\n\n¡Los esperamos en VetSoft!";

			// Limpiar teléfono (solo números, el código de país debe estar incluido)
			$telefono_limpio = preg_replace('/[^0-9]/', '', $telefono_cita);

			// Petición a UltraMsg
			$params=array(
				'token' => '1cm48eng20hyyjnl',
				'to' => $telefono_limpio,
				'body' => $mensaje
			);
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api.ultramsg.com/instance178364/messages/chat",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => http_build_query($params),
			  CURLOPT_HTTPHEADER => array(
			    "content-type: application/x-www-form-urlencoded"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);
		}
		// --- FIN INTEGRACION WHATSAPP ---

		echo 0;

	}else{

		echo 2;

	}

}



?>