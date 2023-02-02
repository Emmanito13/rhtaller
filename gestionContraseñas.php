<?php
session_start();
include_once 'config/validateUser.php';
include 'lib/lib2.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="pictures/emma georgio-01-01.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/style_gestion_pass.css">
    <title>Gestion de contraseñas</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-auto text-center">
                <img class="img-title-gestion" src="pictures/intimidad.png" alt="WithoutImage">
            </div>
            <div class="col-auto text-center">
                <div class="title_gestion">
                    Gestión de contraseñas
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-auto text-center">
                    <input type="image" src="pictures/atras.png" alt="Submit" title="Volver" width="30" height="30" onclick=" location ='indexMenu.php'">
                </div>
                <div class="col-auto text-center">
                    <input type="image" src="pictures/plus.png" alt="Submit" title="Agregar usuario" width="30" height="30" onclick="formAddUser()">                    
                </div>
            </div>
            <?php include_once 'tables/TablaGestionPass.php' ?>                      
        </div>
    </div>
</body>

<!-- MODALS -->
<?php include_once 'modals/modalGestionUsuario.php' ?>
<!-- /MODALS -->

<!-- JAVASCRIPT -->
<script src="scripts/gestion.js"></script>
<!-- /JAVASCRIPT -->

</html>1