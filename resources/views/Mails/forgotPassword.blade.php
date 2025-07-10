<!--
    Vista: Mails/forgotPassword.blade.php
    Descripción: Plantilla de correo para recuperación de contraseña.
    Incluye enlace seguro para restablecer la contraseña y mensaje personalizado.
    Última actualización: 2025-07-10
-->
    <!--
        Estructura visual del correo:
        - Encabezado con logo.
        - Mensaje personalizado con nombre del usuario (si está disponible).
        - Botón/enlace para restablecer la contraseña.
        - Mensaje de advertencia si no solicitó el cambio.
        - Pie de página con derechos reservados.
    -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <title>¿Olvido su contraseña?</title>
    <style>
        body {
            background-color: #003675;
            font-family: "Roboto", serif;
            font-style: normal;
            background-image: url('vendors/images/Sherpa.png');
            background-repeat: no-repeat;
        }

        .emailHead {
            display: flex;
            justify-content: center;
            background: white;
            margin: auto;
            max-width: 600px;
            padding: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            /* Sombra suave */

        }

        .emailBody {
            display: flex;
            justify-content: center;
            margin: auto;
            max-width: 600px;
            padding: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            background: rgba(0, 46, 96, 0.75) !important;
        }

        footer {
            display: flex;
            justify-content: center;
            color: white;
            position: initial;
            font-size: 15px;
            margin-top: 25px
        }

        .emailcontent {
            text-align: center !important;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Encabezado con logo de la empresa -->
        <div class="emailHead">
            <img src="{{ asset('vendors/images/logo-himalaya-login.png') }}" alt="logo-himalaya">
        </div>
        <!-- Cuerpo principal del correo -->
        <div class="emailBody">
            <div class="emailcontent">
                <h3>Recupera tu contraseña</h3>
                @if (isset($emailUser->nombre))
                    <p>Hola, {{ $emailUser->nombre}}</p>
                @else
                    Invitado
                @endif
                <p>Hemos recibido tu solicitud para restablecer tu contraseña. Para continuar, por favor haz clic en el
                    botón que aparece a continuación. Este enlace es único y tiene un tiempo limitado de validez.</p>
                <p>
                    <!-- Botón/enlace seguro para restablecer contraseña -->
                    <a href="{{ route('Restablecer contraseña', ['email' => $emailUser->email, 'token' => $token]) }}"
                        class="btn btn-success">
                        Restablecer contraseña
                    </a>
                </p>
                <p>Si no solicitaste este cambio, puedes ignorar este mensaje. Tu cuenta permanecerá segura y no se
                    realizarán cambios en tu contraseña.</p>
                <p>Gracias por utilizar nuestro servicio.</p>
            </div>
        </div>
    </div>


    <!-- Pie de página con derechos reservados -->
    <footer>
        © 2025 HimalayaDigital. Todos los derechos reservados.
    </footer>

</body>

</html>
