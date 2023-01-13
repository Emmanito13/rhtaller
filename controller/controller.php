<?php

session_start();
require "InterfaceRH.php";

$interface= new InterfaceRH();

switch ($_REQUEST["operador"]){
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
}
?>