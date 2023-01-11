<?php
require "../config/ConectionDB.php";

class Request{
    public $cnx;

    function __construct(){
        $this->cnx = Conexion::ConectarDB();
    }

    function login($user, $pass){
        
        $query = "SELECT * FROM usuarios WHERE idusuario = ? AND pasusuario = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$user);
        $result->bindParam(2,$pass);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                return 'successs';
            }else{
                return 'fail';
            }       
        }else{
            return 'error';
        }
    }

}



?>