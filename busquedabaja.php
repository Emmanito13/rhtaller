<?php
session_start();
include_once 'config/validateUser.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Busqueda de bajas</title>
    <!-- <link rel="shortcut icon" href="../iconos/favicon.png"> -->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <?php include "lib/lib.php" ?>
    <link rel="stylesheet" href="css/style_busqueda_baja.css">
    <link rel="shortcut icon" href="pictures/emma georgio-01-01.jpg" type="image/x-icon">  
    <script src="scripts/funciones.js"></script>
</head>

<body>
    <div class="conteiner my-4">
        <div class="container-header" style="text-align:center; background: #FFF; color: #8B0000;">
            <h1>Archivo de personal dado de baja</h1>
        </div>
        <div class="container-fluid">
            <input type="image" src="pictures/atras.png" alt="Submit" title="Volver" width="30" height="30" onclick=" location ='formatosbaja.php'">
            <div class="container-fluid" id="tabla"></div>
        </div>
    </div>
</body>

</html>



<script type="text/javascript">
    $(document).ready(function() {

        $('#tabla').load('tables/TablaBajas.php');

    });
</script>