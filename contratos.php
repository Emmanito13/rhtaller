<?php
session_start();
include_once 'config/validateUser.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Personal Temporal</title>
    <link rel="shortcut icon" href="pictures/emma georgio-01-01.jpg">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <?php include "lib/lib2.php" ?>
    <link rel="stylesheet" href="css/style_contratos.css">
</head>

<body>
    <div class="conteiner my-4">
        <div class="container-header" style="text-align:center; background: #FFF; color: #8B0000;">
            <h1>Personal temporal</h1>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-start mb-3">
                <div class="col-auto text-center">
                    <input type="image" src="pictures/atras.png" alt="Submit" title="Volver" width="30" height="30" onclick=" location ='formatosbaja.php'">

                </div>
            </div>
            <?php include_once 'tables/TablaContratos.php' ?>
        </div>
    </div>
</body>

<!-- MODALS -->
<?php include_once 'modals/modalDocumentos.php' ?>
<!-- /MODALS -->

<!-- JAVASCRIPT -->
<script src="scripts/contratos.js"></script>
<!-- /JAVASCRIPT -->

</html>