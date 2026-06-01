<?php
/**
 * API de Notificaciones para VetSoft
 * Gestiona el envío de notificaciones de citas vía SMS o WhatsApp (UltraMsg, Evolution, Twilio, CallMeBot).
 */

require_once(__DIR__ . "/conexion.php");

// Auto-creación de columnas de base de datos en caso de que no existan
$db_check = mysqli_query($mysqli, "SHOW COLUMNS FROM configuracion LIKE 'api_tipo'");
if (mysqli_num_rows($db_check) == 0) {
    mysqli_query($mysqli, "ALTER TABLE configuracion 
        ADD COLUMN api_tipo VARCHAR(50) DEFAULT 'ultramsg',
        ADD COLUMN api_url VARCHAR(255) DEFAULT 'https://api.ultramsg.com/',
        ADD COLUMN api_key VARCHAR(255) DEFAULT '1cm48eng20hyyjnl',
        ADD COLUMN api_instance VARCHAR(100) DEFAULT 'instance178364',
        ADD COLUMN api_sid VARCHAR(100) DEFAULT '',
        ADD COLUMN api_token VARCHAR(100) DEFAULT '',
        ADD COLUMN api_origen VARCHAR(50) DEFAULT ''");
}

/**
 * Envía una notificación para una cita específica.
 *
 * @param mysqli $mysqli Objeto de conexión a base de datos.
 * @param string $id_mascota ID o nombre de la mascota.
 * @param int $id_cita ID de la cita agendada.
 * @param string $telefono_notif Teléfono destinatario.
 * @param int|bool $enviar_notif Si se debe enviar la notificación (1 o 0).
 * @return bool Retorna verdadero si se envió la petición (o no estaba configurada para enviar), falso en caso de error de cURL.
 */
function enviarNotificacionCita($mysqli, $id_mascota, $id_cita, $telefono_notif, $enviar_notif) {
    if (!$enviar_notif || empty($telefono_notif)) {
        return true;
    }

    // 1. Obtener los detalles de la cita de la base de datos
    $cita_q = mysqli_query($mysqli, "SELECT * FROM citas WHERE id_cita = '$id_cita'");
    $cita = mysqli_fetch_assoc($cita_q);
    if (!$cita) {
        return false;
    }

    $fecha_cita = $cita['fecha_cita'];
    $hora_cita = $cita['hora_cita'];
    $motivo = $cita['motivo'];
    $id_doctor = $cita['doctor'];

    // 2. Obtener el nombre del doctor
    $doc_q = mysqli_query($mysqli, "SELECT nombre, apellido FROM doctores WHERE id_doctor = '$id_doctor'");
    $doc = mysqli_fetch_assoc($doc_q);
    $nombre_doc = $doc ? $doc['nombre'] . " " . $doc['apellido'] : "Doctor Asignado";

    // 3. Obtener el nombre de la mascota y dueño
    $nombre_mascota = "";
    $nombre_dueno = "Cliente";

    if (is_numeric($id_mascota) && $id_mascota > 0) {
        $mascota_q = mysqli_query($mysqli, "SELECT m.nombre as mascota, u.nombre as dueno FROM mascotas m INNER JOIN usuarios u ON m.id_usuario = u.id_usuario WHERE m.id_mascota = '$id_mascota'");
        if ($m_info = mysqli_fetch_assoc($mascota_q)) {
            $nombre_mascota = $m_info['mascota'];
            $nombre_dueno = $m_info['dueno'];
        }
    } else {
        // En caso de urgencias donde la mascota es texto y no ID de base de datos
        $nombre_mascota = $id_mascota;
    }

    // 4. Formatear el mensaje
    $mensaje = "Hola " . $nombre_dueno . " 🐾\n\nTe confirmamos que se ha agendado la cita de *" . $nombre_mascota . "* en VetSoft.\n\n📅 *Fecha:* " . $fecha_cita . "\n⏰ *Hora:* " . $hora_cita . "\n👨‍⚕️ *Doctor:* " . $nombre_doc . "\n📌 *Motivo:* " . $motivo . "\n\n¡Te esperamos en nuestra veterinaria! 🐶🐱";

    // 5. Obtener configuración de API de la base de datos
    $config_q = mysqli_query($mysqli, "SELECT api_tipo, api_url, api_key, api_instance, api_sid, api_token, api_origen FROM configuracion WHERE id_configuracion = '1'");
    $config = mysqli_fetch_assoc($config_q);
    if (!$config) {
        return false;
    }

    $api_tipo = $config['api_tipo'];
    $api_url = rtrim($config['api_url'], '/') . '/';
    $api_key = $config['api_key'];
    $api_instance = $config['api_instance'];
    $api_sid = $config['api_sid'];
    $api_token = $config['api_token'];
    $api_origen = $config['api_origen'];

    // Sanitizar número de teléfono (solo dígitos)
    $telefono = preg_replace('/[^0-9]/', '', $telefono_notif);

    switch ($api_tipo) {
        case 'ultramsg':
            if (empty($api_key) || empty($api_instance)) {
                return false;
            }
            $params = array(
                'token' => $api_key,
                'to' => $telefono,
                'body' => $mensaje
            );
            $url = "https://api.ultramsg.com/" . $api_instance . "/messages/chat";
            
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
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
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            return !$err;

        case 'evolution':
            if (empty($api_url) || empty($api_instance) || empty($api_key)) {
                return false;
            }
            $url = $api_url . "message/sendText/" . $api_instance;
            $data = array(
                "number" => $telefono,
                "text" => $mensaje
            );
            $payload = json_encode($data);

            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_TIMEOUT => 15,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "apikey: " . $api_key
                ),
            ));
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            return !$err;

        case 'twilio':
            if (empty($api_sid) || empty($api_token) || empty($api_origen)) {
                return false;
            }
            // Para Twilio, si el origen empieza por whatsapp:, nos aseguramos que el destino también
            $to = $telefono;
            $from = $api_origen;
            if (strpos($from, 'whatsapp:') === 0 && strpos($to, 'whatsapp:') !== 0) {
                $to = 'whatsapp:+' . $to;
            } else if (strpos($to, 'whatsapp:') !== 0 && strpos($to, '+') !== 0) {
                $to = '+' . $to;
            }

            $url = "https://api.twilio.com/2010-04-01/Accounts/" . $api_sid . "/Messages.json";
            $data = array(
                'From' => $from,
                'To' => $to,
                'Body' => $mensaje
            );

            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_USERPWD => $api_sid . ":" . $api_token,
                CURLOPT_TIMEOUT => 15,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0
            ));
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            return !$err;

        case 'callmebot':
            if (empty($api_key)) {
                return false;
            }
            $url = "https://api.callmebot.com/whatsapp.php?phone=" . $telefono . "&text=" . urlencode($mensaje) . "&apikey=" . $api_key;
            
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0
            ));
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            return !$err;

        case 'none':
        default:
            return true;
    }
}
?>
