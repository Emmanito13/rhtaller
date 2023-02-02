<?php
session_start();
include_once 'config/validateUser.php';
?>
<!doctype html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <title>Nómina</title>
    <link rel="shortcut icon" href="pictures/emma georgio-01-01.jpg" type="image/x-icon">
    <?php include('lib/lib2.php') ?>
    <link rel="stylesheet" href="css/style_nomina.css">

</head>

<body BGCOLOR=#CCC>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-auto text-center">
                <img class="img-title-nomina" src="pictures/nomina.png" alt="WithoutImage">
            </div>
            <div class="col-auto text-center">
                <div class="title_nomina">
                    Registro de nomina
                </div>
            </div>
        </div>

        <div class="row justify-content-left">
            <div class="col-auto">
                <input type="image" src="pictures/atras.png" alt="Submit" title="Volver" width="30" height="30" onclick=" location ='indexMenu.php'">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col">
                <div class="row mt-3">
                    <div class="col">
                        <?php include_once 'tables/TablaNomina.php' ?>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="row justify-content-center bg-dark text-bg-dark">
                    <div class="col-auto text-center">
                        <label class="form-label fw-bold fs-4">OPCIONES</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <label class="form-label fw-bold">Eliga un rango de fecha:</label>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-auto text-center">
                        <label class="form-label fw-normal">Inicio: </label>
                    </div>
                    <div class="col-auto text-center">
                        <input id="inputDateStart" type="date" class="form-control">
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-auto text-center">
                        <label class="form-label fw-normal">Fin: </label>
                    </div>
                    <div class="col-auto text-center">
                        <input id="inputDateEnd" type="date" class="form-control">
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="row justify-content-center">
                        <div class="col-auto text-center mb-3">
                            <button type="button" class="btn btn-success" onclick="askSaveNomina()"><i class="fa-solid fa-floppy-disk"></i> Guardar Nómina</button>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto text-center mb-3">
                            <button type="button" class="btn btn-danger" onclick="printNomina()"><i class="fa-solid fa-file-pdf"></i> Imprimir Nómina</button>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto text-center mb-3">
                            <button type="button" class="btn btn-primary" onclick="showRecordNomina()"><i class="fa-solid fa-folder-open"></i> Historial de Nóminas</button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center bg-dark text-bg-dark">
                    <div class="col-auto text-center">
                        <label class="form-label fw-bold fs-4">DATOS DE NÓMINA</label>
                    </div>
                </div>
                <div class="row justify-content-center my-3">
                    <div class="col-5 text-center me-3 mb-2 total">
                        <div class="row justify-content-sm-center mt-3">
                            <div class="col-auto text-center">
                                <label class="form-label fw-bold fs-5">EMPLEADOS:</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto text-center">
                                <label id="lbl_empleados" class="form-label fw-normal fs-5">250</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 text-center me-3 mb-2 total">
                        <div class="row justify-content-sm-center mt-3">
                            <div class="col-auto text-center">
                                <label class="form-label fw-bold fs-5">FALTANTES:</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto text-center">
                                <label id="lbl_faltantes" class="form-label fw-normal fs-5">250</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 text-center me-3 mb-2 total">
                        <div class="row justify-content-sm-center mt-3">
                            <div class="col-auto text-center">
                                <label class="form-label fw-bold fs-5">SUBTOTAL:</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto text-center">
                                <label id="lbl_subtotal" class="form-label fw-normal fs-5">250</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 text-center me-3 mb-2 total">
                        <div class="row justify-content-sm-center mt-3">
                            <div class="col-auto text-center">
                                <label class="form-label fw-bold fs-5">PRESTAMOS:</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto text-center">
                                <label id="lbl_prestamos" class="form-label fw-normal fs-5">250</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 text-center me-3 mb-2 total">
                        <div class="row justify-content-sm-center mt-3">
                            <div class="col-auto text-center">
                                <label class="form-label fw-bold fs-5">INFONAVIT:</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto text-center">
                                <label id="lbl_infonavit" class="form-label fw-normal fs-5">250</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 text-center me-3 mb-2 total">
                        <div class="row justify-content-sm-center mt-3">
                            <div class="col-auto text-center">
                                <label class="form-label fw-bold fs-5">TOTAL:</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto text-center">
                                <label id="lbl_total" class="form-label fw-normal fs-5">$ 13,400.00</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row-auto justify-content-center">                    
                </div>                                 -->
            </div>
        </div>
    </div>

</body>

<!-- MODALS -->
<?php include_once 'modals/modalRecordNomina.php'?> 
<?php include_once 'modals/modalFechasHistorial.php'?> 
<!-- /MODALS -->

<!-- JAVASCRIPT -->
<script src="scripts/nomina.js"></script>
<!-- /JAVASCRIPT -->


</html>