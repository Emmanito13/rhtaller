<?php
require "../config/ConectionDB.php";

class Request{
    public $cnx;

    function __construct(){
        $this->cnx = Conexion::ConectarDB();
    }

    function login($user, $pass){
        
        $query = "SELECT * FROM usuarios WHERE username = ? AND pass = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$user);
        $result->bindParam(2,$pass);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;                    
                }
                return $data;
            }else{
                $data = [];
            }    
        }else{
            return $data = [];
        }
    }

}



?>