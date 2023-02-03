<?php
ob_start();
session_start();
include_once '../config/validateUser.php';
require "../controller/InterfaceRH.php";
$request = new InterfaceRH();
$dateStart = $_GET['dateStart'];
$dateEnd = $_GET['dateEnd'];
$data = $request->listNomina();

$total_no_empleados = 0;
$total_b_sueldo = 0;
$total_no_sueldo = 0;
$total_b_faltantes = 0;
$total_no_faltantes = 0;
$total_b_subtotal = 0;
$total_no_subtotal = 0;
$total_b_infonavit = 0;
$total_no_infonavit = 0;
$total_b_prestamos = 0;
$total_no_prestamos = 0;
$total_b_total = 0;
$total_no_total = 0;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nómina del <?php echo $dateStart . " al " . $dateEnd ?></title>    
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
        margin-top: 40px;
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

    .dep {
        font-family: Arial, 'Times New Roman', Times, serif, sans-serif;
        font-weight: normal;
        font-size: 16px;
        margin: 0 auto;
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
        Nómina del <u><?php echo $dateStart?></u> al <u><?php echo $dateEnd ?></u>
    </footer>
    <div class="header">
        <div class="title">Nomina<img class="imgHeader" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/recursoshumanos/rhtaller/pictures/logo_georgio.png" alt="Without image"></div>
    </div>

    <table id="table_nomina" border="1">
        <thead>
            <tr>
                <th><b>No. Lista</b></th>
                <th><b>Nombre del empleado</b></th>
                <th><b>Sueldo Semanal</b></th>
                <th><b>Medios Dias</b></th>
                <th><b>Faltantes</b></th>
                <th><b>Subtotal</b></th>
                <th><b>Infonavit</b></th>
                <th><b>Prestamos</b></th>
                <th><b>Total</b></th>
                <th><b>Observaciones</b></th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (empty($data)) {
            ?>
                <tr>
                    <td style="padding-bottom: 10px;padding-top: 10px;" colspan="14">No hay empleados para esta nómina</td>
                </tr>
                <?php
            } else {
                foreach ($data as $d) {
                    $total_b_sueldo += $d['sueldo'];
                    $total_b_faltantes += $d['faltantes'];
                    $total_b_subtotal += $d['subtotal'];
                    $total_b_infonavit += $d['infonavit'];                          
                    $total_b_prestamos += $d['prestamo'];                                                                                 
                    $total_b_total += $d['total'];                    

                    if ($d['pago'] == 'Aprobado') {
                        $style = '';
                    } else {
                        $style = 'style="background-color: rgba(243,34,34,0.5);"';
                        $total_no_empleados++;
                        $total_no_sueldo += $d['sueldo'];
                        $total_no_faltantes += $d['faltantes'];
                        $total_no_subtotal += $d['subtotal'];
                        $total_no_infonavit += $d['infonavit'];
                        $total_no_prestamos += $d['prestamo'];
                        $total_no_total += $d['total'];
                    }

                ?>
                    <tr <?php echo $style ?>>
                        <td style="text-align: center;"><?php echo $d['Nlista'] ?></td>
                        <td style="text-align: start;"><?php echo $d['nombre'] ?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['sueldo'])?></td>
                        <td style="text-align: center;"><?php echo $d['mdias'] ?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['faltantes'],2) ?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['subtotal'],2) ?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['infonavit'],2)?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['prestamo'],2)?></td>
                        <td style="text-align: center;">$<?php echo number_format($d['total'],2) ?></td>
                        <td style="text-align: center;"><?php echo $d['pago'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>

    <div class="title_desglose">DESGLOSE</div>

    <table border="1">
        <thead>
            <tr>
                <th><b></b></th>
                <th><b>Empleados</b></th>
                <th><b>Sueldo Semanal</b></th>                
                <th><b>Faltantes</b></th>
                <th><b>Subtotal</b></th>
                <th><b>Infonavit</b></th>
                <th><b>Prestamos</b></th>
                <th><b>Total</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: right;"><b>TOTAL BRUTO DE NÓMINA:</b></td>
                <td style="text-align: center;"><?php echo count($data)?></td>                
                <td style="text-align: center;">$<?php echo number_format($total_b_sueldo) ?></td>
                <td style="text-align: center;">$<?php echo number_format($total_b_faltantes,2) ?></td>
                <td style="text-align: center;">$<?php echo number_format($total_b_subtotal,2) ?></td>
                <td style="text-align: center;">$<?php echo number_format($total_b_infonavit,2) ?></td>
                <td style="text-align: center;">$<?php echo number_format($total_b_prestamos,2) ?></td>
                <td style="text-align: center;">$<?php echo number_format($total_b_total,2) ?></td>
            </tr>

            <tr>
                <td style="text-align: right;"><b>TOTAL DE NÓMINA 'NO HACER SOBRE':</b></td>
                <td style="text-align: center;color: red;"><?php echo $total_no_empleados ?></td>
                <td style="text-align: center;color: red;">$<?php echo number_format($total_no_sueldo) ?></td>         
                <td style="text-align: center;color: red;">$<?php echo number_format($total_no_faltantes,2) ?></td>
                <td style="text-align: center;color: red;">$<?php echo number_format($total_no_subtotal,2) ?></td>
                <td style="text-align: center;color: red;">$<?php echo number_format($total_no_infonavit,2) ?></td>
                <td style="text-align: center;color: red;">$<?php echo number_format($total_no_prestamos,2) ?></td>
                <td style="text-align: center;color: red;">$<?php echo number_format($total_no_total,2) ?></td>
            </tr>

            <tr>
                <td style="text-align: right;"><b>TOTAL NETO:</b></td>
                <td style="text-align: center;font-size: 14px;"><b><?php echo count($data) - $total_no_empleados ?></b></td>
                <td style="text-align: center;font-size: 14px;"><b>$<?php echo number_format($total_b_sueldo - $total_no_sueldo)?></b></td>
                <td style="text-align: center;font-size: 14px;"><b>$<?php echo number_format($total_b_faltantes - $total_no_faltantes,2)?></b></td>
                <td style="text-align: center;font-size: 14px;"><b>$<?php echo number_format($total_b_subtotal - $total_no_subtotal,2)?></b></td>
                <td style="text-align: center;font-size: 14px;"><b>$<?php echo number_format($total_b_infonavit - $total_no_infonavit,2)?></b></td>
                <td style="text-align: center;font-size: 14px;"><b>$<?php echo number_format($total_b_prestamos - $total_no_prestamos,2)?></b></td>  
                <td style="text-align: center;font-size: 14px;"><b>$<?php echo number_format($total_b_total - $total_no_total,2)?></b></td>
            </tr>
        </tbody>
    </table>

    <div class="nomina-final">Costo final nómina: <div class="total-nomina">$<?php echo number_format($total_b_total - $total_no_total,2)?></div></div>

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

$dompdf->stream('Nomina_' . $dateStart . "_" . $dateEnd . '.pdf', array("Attachment" => false));

?>