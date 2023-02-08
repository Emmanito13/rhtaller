<?php
session_start();
require "InterfaceRH.php";
// $username = $_SESSION['username'];
// $rol = $_SESSION['rol'];
$interface = new InterfaceRH();

switch ($_REQUEST["opc"]) {
    case "listUsersContracts":
        $data = $interface->listUsersContracts();

        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $list[] = array(
                    "Nlista" => getNlista($data[$i]['Nlista'], $data[$i]['pendingdays']),
                    "name" => getName($data[$i]['name'], $data[$i]['pendingdays']),
                    "Fingreso" => getFingreso($data[$i]['Fingreso'], $data[$i]['pendingdays']),
                    "duracion" => getDuracion($data[$i]['timecontract'], $data[$i]['pendingdays']),
                    "diast" => getDiasT($data[$i]['timeelapsed'], $data[$i]['pendingdays']),
                    "diasp" => getDiasP($data[$i]['pendingdays']),
                    "cambiar" => getButtonChange($data[$i]['idE'],$data[$i]['timecontract']),
                    "documentos" => getButtonFiles($data[$i]['idE'])
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
                "Nlista" => 'No hay empleados con contrato de 90 dias',
                "name" => '',
                "Fingreso" => '',
                "duracion" => '',
                "diast" => '',
                "diasp" => '',
                "cambiar" => '',
                "documentos" => ''
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

    case 'getContractsById':
        if (!empty($interface->getContractsById($_POST['id']))) {
            echo json_encode($interface->getContractsById($_POST['id']));
        } else {
            echo json_encode('empty');
        }

        break;

    case 'updateContract':
        if($interface->updateContract($_POST['idE'], $_POST['duracion'])){
            $response = 'success';
        }else{
            $response = 'error';
        }
        echo $response;
        break;

    case 'updateTimeContract':
        if($interface->updateTimeContract($_POST['idE'], $_POST['timecontract'])){
            $response = 'success';
        }else{
            $response = 'error';
        }
        echo $response;        
        break;
    
        case 'getTimeContract':
        if (!empty($interface->getTimeContract($_POST['id']))) {
            echo json_encode($interface->getTimeContract($_POST['id']));
        } else {
            echo json_encode('empty');
        }

        break;
    
    case 'getDocumentsById':
        if (!empty($interface->getDocumentsById($_POST['id']))) {
            echo json_encode($interface->getDocumentsById($_POST['id']));
        } else {
            echo json_encode('empty');
        }
        break;
}

function getNlista($Nlista, $pendingdays)
{
    if ($pendingdays <= 0) {
        return "<div style='color:red'>" . $Nlista . "</div>";
    } else {
        return "<div>" . $Nlista . "</div>";
    }
}

function getName($name, $pendingdays)
{
    if ($pendingdays <= 0) {
        return "<div style='color:red'>" . $name . "</div>";
    } else {
        return "<div>" . $name . "</div>";
    }
}

function getFingreso($Fingreso, $pendingdays)
{
    if ($pendingdays <= 0) {
        return "<div style='color:red'>" . $Fingreso . "</div>";
    } else {
        return "<div>" . $Fingreso . "</div>";
    }
}

function getDuracion($duracion, $pendingdays)
{
    if ($pendingdays <= 0) {
        return "<div style='color:red'>" . $duracion . "</div>";
    } else {
        return "<div>" . $duracion . "</div>";
    }
}

function getDiasT($diast, $pendingdays)
{
    if ($pendingdays <= 0) {
        return "<div style='color:red'>" . $diast . "</div>";
    } else {
        return "<div>" . $diast . "</div>";
    }
}

function getDiasP($pendingdays)
{
    if ($pendingdays <= 0) {
        return "<div style='color:red'>" . $pendingdays . "</div>";
    } else {
        return "<div>" . $pendingdays . "</div>";
    }
}


function getButtonChange($idE, $duracion)
{
    switch($duracion){
        case 90:
            return "<button type='button' class='btn btn-primary' onclick='renewContract(" . $idE .",". $duracion . ")'><i class='fa-sharp fa-solid fa-arrow-up'></i> Renovar</button>";
            break;

        case 180:
            return "<button type='button' class='btn btn-success' onclick='renewContract(" . $idE .",". $duracion . ")'><i class='fa-sharp fa-solid fa-arrow-up'></i> Planta</button>";
            break;
    }    
}

function getButtonFiles($idE)
{
    return "<input type='image' src='pictures/documentos.png' title='Documentos presentados' width='30' height='30' onclick='documentsDelivered(" . $idE . ")'>";
}
