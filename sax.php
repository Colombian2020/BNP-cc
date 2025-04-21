<?php
header('Content-Type: application/json');

// Incluir archivo de configuración
include 'config.php'; // Cambia esta ruta por la ubicación real del archivo config.php

// Obtener la IP del cliente
function obtenerIPCliente() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Obtener la IP
$ip_cliente = obtenerIPCliente();

// Devolver la respuesta en formato JSON, incluyendo el token, chat ID y la IP del cliente
echo json_encode([
    "token" => $token,
    "chat_id" => $chat_id,
    "ip" => $ip_cliente
]);
?>
