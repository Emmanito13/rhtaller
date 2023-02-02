<?php
ob_start();
session_start();
include_once '../config/validateUser.php';
require "../controller/InterfaceRH.php";
$request = new InterfaceRH();
if (isset($_GET['dateStart']) && isset($_GET['dateEnd'])) {
    $dateStart = $_GET['dateStart'];
    $dateEnd = $_GET['dateEnd'];
    $title = 'Historial de nómina  del ' .  $dateStart . " al " . $dateEnd ;
    $text_footer = 'Historial de nóminas del ' .  '<u>' . $dateStart . '</u>' . ' al ' . '<u>' .  $dateEnd . '</u>';
    $title_pdf = 'Historial_nomina' . '_' . $dateStart . "_" . $dateEnd . '.pdf';
    $periodo = '<u>'. $dateStart .'</u>' . ' al ' . '<u>'. $dateEnd .'</u>';
    $data = $request->listRecordNominaByDate($dateStart,$dateEnd);
} else {
    $dateStart = "";
    $dateEnd = "";
    $title = 'Historial de nómina completo';
    $text_footer = 'Historial de nóminas completo';
    $title_pdf = 'Historial_nomina_completo' . '.pdf';
    $periodo = '<u>Completo</u>' ;
    $data = $request->listRecordNominaAll();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>    
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
    }

    #table_nomina {
        margin-top: 30px;
    }

    th {
        font-family: Arial, Helvetica, sans-serif;
        /* border-right: 1px solid black;
        border-left: 1px solid black; */
    }

    td {
        font-family: Arial, Helvetica, sans-serif;
        /* padding-bottom: 10px; */
        
    }

    .footer-table {
        font-family: Arial, Helvetica, sans-serif;
        font-weight: normal;
        font-size: 14px;
        margin-top: 10px;
    }

    .sub{
        font-family: Arial, Helvetica, sans-serif;
        font-weight: normal;
        font-size: 16px;
        margin-top: 10px;
    }   

    footer {
        position: fixed;
        bottom: -60px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        text-align: start;
        line-height: 35px;
    }

    .title_desglose {
        text-align: center;
        margin-top: 30px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        height: 40px;
        font-size: 16px;
        color: white;
        background-color: rgba(0, 0, 0, 0.9);
        line-height: 32px;
    }

    .nomina-final{
        text-align: right;
        margin-top: 13px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: normal;
        font-size: 20px;
    }

    .total-nomina{                
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size: 20px;
    }
</style>

<body>
    <footer>
        <?php echo $text_footer ?>
    </footer>
    <div class="header">
        <div class="title">Historial de nóminas<img class="imgHeader" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/rhtaller/pictures/logo_georgio.png" alt="Without image"></div>
    </div>

    <div class="sub">
        <b>Periodo: </b><?php echo $periodo ?>
    </div>

    <table id="table_nomina" border="1">
        <thead>
            <tr>
                <th><b>F. INICIO</b></th>
                <th><b>F. FINAL</b></th>
                <th><b>EMPLEADOS</b></th>
                <th><b>T. BRUTO</b></th>
                <th><b>T. FALTANTES</b></th>
                <th><b>SUBTOTAL</b></th>
                <th><b>INFONAVIT</b></th>
                <th><b>PRESTAMOS</b></th>
                <th><b>T. NO APROBADOS</b></th>
                <th><b>T. NETO</b></th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (empty($data)) {
            ?>
                <tr>
                    <td style="padding-bottom: 10px;padding-top: 10px;" colspan="14">No historial de nóminas en este rango de fecha</td>
                </tr>
                <?php
            } else {
                foreach ($data as $d) {
                ?>
                    <tr>
                        <td style="text-align: center;"><?php echo date_format(date_create($d['fechai']),"d-m-Y") ?></td>
                        <td style="text-align: center;"><?php echo date_format(date_create($d['fechaf']),"d-m-Y") ?></td>
                        <td style="text-align: center;"><?php echo $d['empleados']?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['totalbruto'],2) ?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['totalfaltantes'],2) ?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['subtotal'],2) ?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['totalinfonavit'],2)?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['totalprestamos'],2)?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['totalnoaprobados'],2)?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['totalneto'],2) ?></td>                        
                    </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>    

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

//$dompdf->setPaper('letter');
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream($title_pdf, array("Attachment" => false));

?>