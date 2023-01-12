<?php

session_start();
require "InterfaceRH.php";

$interface= new InterfaceRH();

switch ($_REQUEST["operador"]){
    case 'listar_turnos':
        echo json_encode($interface->listarTurnos());
        break;
}
?>