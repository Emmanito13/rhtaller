<?php

session_start();
require "Request.php";

$request = new Request();

if(empty($_POST['user']) || empty($_POST['pass'])){ 
    echo json_encode('requerid');
}else{
    if(!empty($request->login($_POST['user'],$_POST['pass']))){
        $data = $request->login($_POST['user'],$_POST['pass']);
        $_SESSION['log'] = 'true';
        $_SESSION['rol'] = $data[0]['rol'];
        echo json_encode($data);
    }else{
        echo json_encode('empty');
    }    
}

?>
