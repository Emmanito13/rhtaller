<?php

session_start();
require "Request.php";

$request = new Request();

if(empty($_POST['user']) || empty($_POST['pass'])){
    echo json_encode('requerid');
}else{
    switch($request->login($_POST['user'],$_POST['pass'])){
        case 'successs':
            echo json_encode('successs');
            break;

        case 'fail':
            echo json_encode('fail');
            break;

        case 'error':
            echo json_encode('error');
            break;
    }
}

?>
