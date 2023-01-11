<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <!-- jquery -->
    <script src="lib/jQuery/jquery-3.6.3.min.js"></script>
    <!-- Toastr -->

    <!-- CSS -->
    <link rel="stylesheet" href="lib/Toastr/toastr.min.css">
    <!-- JavaScript -->
    <script src="lib/Toastr/toastr.min.js"></script>
    <!-- Bootstrap -->

    <!-- CSS -->
    <link rel="stylesheet" href="lib/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="lib/bootstrap-5.2.3-dist/js/bootstrap.min.js"></script>
    <!-- icons -->
    <link rel="stylesheet" href="lib/bootstrap-5.2.3-dist/css/bootstrap-icons-1.10.2/bootstrap-icons.css">

    

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Compiled iconos -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- FontAwesone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="styles/login.css">
</head>

<body>
    <div class="container contenedor-principal">
        <div class="row">
            <div>
                
                    <div class="row justify-content-center py-0">
                        <div class="col-auto text-center">
                            <img id="imgLogo" src="img/logo_georgio.png" alt="Not picture">
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
                    </div>
                    <div class="btn-container">
                        <button id="ingresar" name="ingresar" onclick="login()" class=" btn btn-ingresar"><i class="material-icons right">login</i>Ingresar</button>
                    </div>
                
            </div>
        </div>
    </div>
</body>

<!-- JAVASCRIPT -->
<script src="js/login.js"></script>
<!-- /JAVASCRIPT -->

</html>