<?php

session_start();
require "InterfaceRH.php";

$interface = new InterfaceRH();

switch ($_REQUEST["operador"]) {
    case 'listar_turnos':
        echo json_encode($interface->listarTurnos());
        break;

    case 'listar_contratos':
        echo json_encode($interface->listarContratos());
        break;

    case 'listar_empresas':
        echo json_encode($interface->listarEmpresas());
        break;

    case 'listar_departamentos':
        echo json_encode($interface->listarDepartamentos());
        break;

    case 'listar_puestos':
        echo json_encode($interface->listarPuestos());
        break;

    case 'listar_jefes':
        echo json_encode($interface->listarJefes());
        break;

    case 'turno_by_name':
        echo json_encode($interface->getTurnoByName($_POST['nombreTurno']));
        break;

    case 'contrato_by_name':
        echo json_encode($interface->getContratoByName($_POST['nombreContrato']));
        break;

    case 'empresa_by_name':
        echo json_encode($interface->getEmpresaByName($_POST['nombreEmpresa']));
        break;

    case 'depa_by_name':
        echo json_encode($interface->getDepaByName($_POST['nombreDepa']));
        break;

    case 'puesto_by_name':
        echo json_encode($interface->getPuestoByName($_POST['nombrePuesto']));
        break;

    case 'jefe_by_name':
        echo json_encode($interface->getJefeByName($_POST['nombreJefe']));
        break;

    case "listNomina":
        $data = $interface->listNomina();

        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $list[] = array(
                    "Nlista" => $data[$i]['Nlista'],
                    "nombre" => $data[$i]['nombre'],
                    "mdia" => getMdias($data[$i]['mdias'], $data[$i]['idE']),
                    "faltantes" => "$" . $data[$i]['faltantes'],
                    "subtotal" => "$" . $data[$i]['subtotal'],
                    "prestamo" => getPrestamo($data[$i]['prestamo'], $data[$i]['idE'], $data[$i]['subtotal']),
                    "infonavit" => getInfonavit($data[$i]['infonavit'], $data[$i]['idE']),
                    "total" => "$" . $data[$i]['total'],
                    "pago" => getPago($data[$i]['pago'], $data[$i]['idE'])
                );
            }

            $result = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        } else {
            $list[] = array(
                "Nlista" => "No hay empleados en este turno",
                "nombre" => " ",
                "mdia" => " ",
                "faltantes" => " ",
                "subtotal" => " ",
                "prestamo" => " ",
                "infonavit" => " ",
                "total" => " ",
                "pago" => " "
            );

            $result = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        }

        break;

    case 'updateMDias':
        if ($_POST['mdias'] > 12) {
            $response = 'limit';
        } else {
            if ($interface->updateMDias($_POST['idE'], $_POST['mdias'])) {
                $response = 'success';
            } else {
                $response = 'fail';
            }
        }
        echo $response;
        break;

    case 'updatePrestamo':
        if ($interface->updatePrestamo($_POST['idE'], $_POST['prestamo'])) {
            $response = 'success';
        } else {
            $response = 'fail';
        }
        echo $response;
        break;

    case 'updateInfonavit':
        if ($interface->updateInfonavit($_POST['idE'], $_POST['infonavit'])) {
            $response = 'success';
        } else {
            $response = 'fail';
        }
        echo $response;
        break;

    case 'updatePago':
        if ($interface->updatePago($_POST['idE'], $_POST['newPago'])) {
            $response = 'success';
        } else {
            $response = 'fail';
        }
        echo $response;
        break;

    case 'getListEmployee':
        if(empty($interface->listNomina())){
            echo json_encode('empty');
        }else{
            echo json_encode($interface->listNomina());
        }
        break;

    case 'saveNomina':
        if ($interface->saveNomina(
            $_POST['dateStart'],
            $_POST['dateEnd'],
            $_POST['empleados'],
            $_POST['totalBruto'],
            $_POST['totalFaltantes'],
            $_POST['subtotal'],
            $_POST['totalInfonavit'],
            $_POST['totalPrestamo'],
            $_POST['totalNoAprobados'],
            $_POST['totalNeto']
        )) {
            $response = 'success';
        } else {
            $response = 'fail';
        }
        echo $response;
        break;

    case 'overwriteNoimina':
        if ($interface->overWriteNomina(
            $_POST['id'],
            $_POST['empleados'],
            $_POST['totalBruto'],
            $_POST['totalFaltantes'],
            $_POST['subtotal'],
            $_POST['totalInfonavit'],
            $_POST['totalPrestamo'],
            $_POST['totalNoAprobados'],
            $_POST['totalNeto']
        )) {
            $response = 'success';
        } else {
            $response = 'fail';
        }
        echo $response;
        break;

    case 'existEntryNomina':
        if (!empty($interface->existEntryNomina($_POST['dateStart'], $_POST['dateEnd']))) {
            if ($interface->existEntryNomina($_POST['dateStart'], $_POST['dateEnd'])[0] == 'error') {
                $response = json_encode("error");
            } else {
                $response = json_encode($interface->existEntryNomina($_POST['dateStart'], $_POST['dateEnd']));
            }
        } else {
            $response = json_encode("empty");
        }
        echo $response;
        break;

    case 'listRecordNomina':
        $data = $interface->listRecordNomina();

        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $list[] = array(
                    "finicio" => date_format(date_create($data[$i]['fechai']),'d-m-Y'),
                    "ffinal" => date_format(date_create($data[$i]['fechaf']),'d-m-Y'),
                    "empleados" => $data[$i]['empleados'],
                    "tbruto" => "$" . number_format($data[$i]['totalbruto'],2),
                    "tfaltante" => "$" . number_format($data[$i]['totalfaltantes'],2),
                    "subtotal" => "$" . number_format($data[$i]['subtotal'],2),
                    "infonavit" => "$" . number_format($data[$i]['totalinfonavit'],2),
                    "prestamos" => "$" . number_format($data[$i]['totalprestamos'],2),
                    "tnoaprobados" => "$" . number_format($data[$i]['totalnoaprobados'],2),
                    "tneto" => "$" . number_format($data[$i]['totalneto'],2)
                );
            }

            $result = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        } else {
            $list[] = array(
                "finicio" => 'No hay nominas guardadas',
                "ffinal" => ' ',
                "empleados" => ' ',
                "tbruto" => ' ',
                "tfaltante" => ' ',
                "subtotal" => ' ',
                "infonavit" => ' ',
                "prestamos" => ' ',
                "tnoaprobados" => ' ',
                "tneto" => ' '
            );

            $result = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        }
        break;
}

function getMdias($mdias, $idE)
{
    $m = "'" . $mdias . "'";
    $id = "'" . "input-mdays-" . $idE . "'";
    return "<input id=" . $id . " maxlength='2'  min='1' max='12' onchange='changeMDias(" . $idE . ")' class='form-control input-mdays' type='number' value=" . $m . ">";
}

function getPrestamo($pretsamo, $idE, $subtotal)
{
    $p = "'" . $pretsamo . "'";
    $id = "'" . "input-prestamo-" . $idE . "'";
    return "<input id=" . $id . " class='form-control input-prestamo' onchange='changePrestamo(" . $idE . "," . $subtotal . ")' type='number' value=" . $p . ">";
}

function getInfonavit($infonavit, $idE)
{
    $i = "'" . $infonavit . "'";
    $id = "'" . "input-infonavit-" . $idE . "'";
    return "<input id=" . $id . " class='form-control input-infonavit' onchange='changeInfonavit(" . $idE . ")' type='number' value=" . $i . ">";
}

function getPago($pago, $idE)
{
    $id = "'" . "btn-pago-" . $idE . "'";
    $p = '"' . $pago . '"';

    if ($pago == 'Aprobado') {
        return "<button id=" . $id . " type='button' onclick='changePago(" . $idE . "," . $p . ")' class='btn btn-success'>" . $pago . "</button>";
    } else {
        return "<button id=" . $id . " type='button' onclick='changePago(" . $idE . "," . $p . ")' class='btn btn-danger'>" . $pago . "</button>";
    }
}
