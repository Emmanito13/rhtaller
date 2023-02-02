<?php
session_start();
include_once '../config/validateUser.php';
ob_start();
date_default_timezone_set('America/Mexico_City') ;
require "../controller/InterfaceRH.php";
$request = new InterfaceRH();
$data = $request->getEmployeeSS();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de personal con seguro social</title>    
</head>
<style>
    .header {
        justify-content: space-between;
        margin: 0 auto;
        line-height: 50px;
    }

    .title {
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size: 22px;
    }

    .subtitle {
        font-family: Arial, Helvetica, sans-serif;
        font-weight: normal;
        font-size: 16px;
        margin-left: 45%;
    }

    .imgHeader {
        width: 200px;
        height: auto;
        float: right;
    }

    table {
        width: 100%;
        overflow: hidden;
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 12px;
        margin-top: 45px;
    }

    th {
        font-family: Arial, Helvetica, sans-serif;
        /* border-right: 1px solid black;
        border-left: 1px solid black; */
    }

    td {
        font-family: Arial, Helvetica, sans-serif;
        /* padding-bottom: 10px; */
        text-align: center;
    }

    .footer-table{
        font-family: Arial, Helvetica, sans-serif;
        font-weight: normal;
        font-size: 14px;
        margin-top: 10px;
    }

    .dep{
        font-family: Arial, 'Times New Roman', Times, serif, sans-serif;
        font-weight: normal;
        font-size: 16px;
        margin: 0 auto;        
    }
</style>

<body>
    <div class="header">
        <div class="title">Lista de personal con Seguro Social (IMSS)<img class="imgHeader" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/rhtaller/pictures/logo_georgio.png" alt="Without image"></div>        
    </div>

    <table border="1">
        <thead>
            <tr>
                <th><b>No. Lista</b></th>
                <th><b>Nombre del empleado</b></th>             
                <th><b>No. Lista Imss</b></th>             
            </tr>
        </thead>
        <tbody>
        <?php
            if (empty($data)) {
                ?>
                <tr>
                    <td style="padding-bottom: 10px;padding-top: 10px;" colspan="3" >No hay empleados con seguro social</td>
                </tr>                
            <?php
            } else {
                foreach($data as $d){
                    ?>
                    <tr>
                        <td><?php echo $d['Nlista']?></td>
                        <td><?php echo $d['nombre']?></td>
                        <td><?php echo $d['listaimss']?></td>
                    </tr>
                <?php
                }                   
            }
            ?>          
        </tbody>
    </table>    
    <div class="footer-table">
        Total de empleados: <b><?php echo $total = (empty($data)) ? '0' : count($data) ?></b>
    </div>

    <div class="footer-table">
        Fecha de impresión: <u><?php echo date("d-m-Y") ?></u>
    </div>

</body>

</html>

<?php

$html = ob_get_clean();

require_once '../lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

//opciones para agregar imagenes;
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);

$dompdf->setPaper('letter');
$dompdf->render();

$dompdf->stream('Lista_personal_IMSS.pdf', array("Attachment" => false));

?>