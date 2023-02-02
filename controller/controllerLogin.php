<?php

session_start();
require "Request.php";

$request = new Request();

switch ($_REQUEST['opc']) {
    case 'validateUser':
        if(empty($_POST['user']) || empty($_POST['pass'])){ 
            echo json_encode('requerid');
        }else{
            if(!empty($request->login($_POST['user'],$request->encryption($_POST['pass'])))){
                $data = $request->login($_POST['user'],$request->encryption($_POST['pass']));
                $_SESSION['log'] = 'true';
                $_SESSION['rol'] = $data[0]['rol'];
                echo json_encode($data);
            }else{
                echo json_encode('empty');
            }    
        }        
        break;    
}

?>
