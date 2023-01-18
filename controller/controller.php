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
}
