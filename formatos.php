<?php
session_start();
include_once 'config/validateUser.php';
include 'lib/lib.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Formatos y Listas impresas</title>
    <link rel="shortcut icon" href="pictures/emma georgio-01-01.jpg" type="image/x-icon">  
    
</head>

<body BGCOLOR=#CCC>


    <p>&nbsp;</p>


    <div class="container my-4">

        <div class="fw-bold container-header py-5" style="text-align:center; color: #203C6C;">
            <h1 style="font-size: 50px;"><input type="image" src="pictures/formato.png" width="3.3%" height="auto" tabindex="-1"> Formatos</h1>
        </div>        
        <div class="row justify-content-center">
            <div class="col-sm-auto">
                <input type="image" src="pictures/atras.png" alt="Submit" title="Volver" width="30" height="30" onclick=" location ='indexMenu.php'">
            </div>
            <div class="col-sm-4">
                <div class="list-group">
                <a href="" data-bs-toggle="modal" data-bs-target="#modalListaAsistencia" onclick="modalDepa()" class="list-group-item list-group-item-action list-group-item-secondary">Lista de Asistencia</a>                                        
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalListaPerFem" onclick="modalFemenino()" class="list-group-item list-group-item-action list-group-item-warning">Lista de personal Femenino</a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalListaPerMasc" onclick="modalMasculino()" class="list-group-item list-group-item-action list-group-item-secondary">Lista de personal Masculino</a>                    
                    <a href="formats/ListaImssPDF.php" class="list-group-item list-group-item-action list-group-item-warning">Lista IMSS</a>
                    <a href="formats/ListaNoImssPDF.php" class="list-group-item list-group-item-action list-group-item-secondary">Personal sin IMSS</a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalListaCumple" class="list-group-item list-group-item-action list-group-item-warning">Lista de Cumpleaños</a>                                        
                </div>
            </div>
        </div>
    </div>
</body>

<!-- MODALS -->
<?php
include_once 'modals/modalListaAsistencia.php';
include_once 'modals/modalPerFemenino.php';
include_once 'modals/modalPerMasculino.php';
include_once 'modals/modalCumple.php';
?>
<!-- /MODALS -->

<!-- JAVASCRIPT -->
<script src="scripts/formatos.js"></script>
<!-- JAVASCRIPT -->

</html>