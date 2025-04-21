<?php
// Define una clave de encriptación. Cámbiala por una clave segura (puede ser cualquier combinación de letras y números).
$encryption_key = 'clave_secreta_segura';

// Función para encriptar datos
function encrypt($data, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

// Define el token y el chat_id que deseas encriptar
$token = "7461083785:AAER5RGqeq9zLxYKgDShvf2QR1elHeU_EQc";
$chat_id = "5157616506";

// Encripta los datos
$encrypted_token = encrypt($token, $encryption_key);
$encrypted_chat_id = encrypt($chat_id, $encryption_key);

// Muestra los valores encriptados
echo "Token encriptado: $encrypted_token\n";
echo "Chat ID encriptado: $encrypted_chat_id\n";
?>
