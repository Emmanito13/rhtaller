<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="pictures/emma georgio-01-01.jpg" type="image/x-icon">
    <title>LOGIN</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Compiled iconos -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- FontAwesone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- jquery -->
    <script src="lib/jquery-3.6.3.min.js"></script>

    <!-- Bootstrap -->
    <!-- CSS -->
    <link rel="stylesheet" href="lib/bootstrap5/css/bootstrap.min.css">
    <!-- JavaScript -->
    <script src="lib/bootstrap5/js/bootstrap.min.js"></script>

    <!-- Toastr -->
    <!-- JavaScript -->
    <script src="lib/Toastr/toastr.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="lib/Toastr/toastr.min.css">


    <link rel="stylesheet" href="css/login.css">

   

</head>

<body>
    <div class="container contenedor-principal">
        <div class="row">
            <div>
                <div class="row justify-content-center py-0">
                    <div class="col-auto text-center">
                        <img id="imgLogo" src="pictures/logo_georgio.png" alt="Not picture">
                    </div>
                    <div class="col-auto text-center">
                        <h2 class="titulo-login">RECURSOS HUMANOS</h2>
                    </div>
                </div>
                <p class="nota-login">Ingrese sus datos para iniciar sesión</p>
                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    <input name="usuario" id="user" type="text" class="validate" required>
                    <label for="user">Usuario</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">vpn_key</i>
                    <input name="contra" id="pass" type="password" class="validate" required>
                    <label for="pass">Contraseña</label>
                    <span id="viewPass" toggle="#password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
                </div>
                <div class="btn-container">
                    <button id="ingresar" name="ingresar" onclick="login()" class=" btn btn-ingresar"><i class="material-icons right">login</i>Ingresar</button>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- JAVASCRIPT -->
<script src="scripts/login.js"></script>
<!-- /JAVASCRIPT -->

</html>