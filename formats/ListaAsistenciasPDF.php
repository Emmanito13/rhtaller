<?php
ob_start();
session_start();
include_once '../config/validateUser.php';
require "../controller/InterfaceRH.php";
$request = new InterfaceRH();
$dep = $_GET['dep'];
$dateStart = $_GET['dateStart'];
$dateEnd = $_GET['dateEnd'];
if ($dep == 'Todos') {
    $d = '%';
} else {
    $d = $dep;
}
$data = $request->getDepaEmployee($d);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de asistencias</title>    
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

    th {
        font-family: Arial, Helvetica, sans-serif;
        /* border-right: 1px solid black;
        border-left: 1px solid black; */
    }

    td {
        font-family: Arial, Helvetica, sans-serif;
        /* padding-bottom: 10px; */
        text-align: left;
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
</style>

<body>
    <footer>                
        Lista de Asistencias <?php echo $dep . ' ' . date('d-m-Y') ?> 
    </footer>
    <div class="header">
        <div class="title">Lista de Asistencias<img class="imgHeader" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/rhtaller/pictures/logo_georgio.png" alt="Without image"></div>
        <div class="dep"><b>Departamento: </b><?php echo $dep ?></div>
        <div class="subtitle"><u>Lunes-Sabado</u></div>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th><b>No. Lista</b></th>
                <th><b>Nombre del empleado</b></th>
                <th><b>Lun.D</b></th>
                <th><b>Lun.T</b></th>
                <th><b>Mar.D</b></th>
                <th><b>Mar.T</b></th>
                <th><b>Mie.D</b></th>
                <th><b>Mie.T</b></th>
                <th><b>Jue.D</b></th>
                <th><b>Jue.T</b></th>
                <th><b>Vie.D</b></th>
                <th><b>Vie.T</b></th>
                <th><b>Sab.D</b></th>
                <th><b>Sab.T</b></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($data)) {
            ?>
                <tr>
                    <td style="padding-bottom: 10px;padding-top: 10px;" colspan="14">No hay empleados en este departamento</td>
                </tr>
                <?php
            } else {
                foreach ($data as $d) {
                ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $d['Nlista'] ?></td>
                        <td><?php echo $d['nombre'] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <div class="footer-table">
        Asistencias del: <u><?php echo $dateStart ?></u> al: <u><?php echo $dateEnd ?></u>
    </div>

    <div class="footer-table">
        Total de empleados: <b><?php echo $total = (empty($data)) ? '0' : count($data) ?></b>
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

$dompdf->stream('Lista_asistencias_' . $dep . '.pdf', array("Attachment" => false));

?>