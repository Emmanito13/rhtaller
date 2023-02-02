<?php
define('METHOD', 'AES-256-CBC');
define('SECRET_KEY', '$ALATRISTE@2023');
define('SECRET_IV', '101712');
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

    function listUsers() {
        
        $query = "SELECT * FROM usuarios";
        $result = $this->cnx->prepare($query);        
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

    public static function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    // public static function decryption($string)
    // {
    //     $key = hash('sha256', SECRET_KEY);
    //     $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    //     $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
    //     return $output;
    // }

    function registerUser ($name,$lastname,$userName,$rol,$pass) {            
        $query = "INSERT INTO usuarios(name, lastname, username, pass, rol) VALUES (?,?,?,?,?)";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $name);
        $result->bindParam(2, $lastname);
        $result->bindParam(3, $userName);
        $result->bindParam(4, $pass);
        $result->bindParam(5, $rol);

        if ($result->execute()) {
            return true;
        }else{
            return false;
        }
    }

    function getUser($id) {

        $query = "SELECT * FROM usuarios where idusuario = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $id);       
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

    function editUser($id, $name, $lastname, $username, $rol) {
        $query = "UPDATE usuarios SET  name = ?, lastname = ?, username = ?, rol = ? WHERE idusuario = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $name);
        $result->bindParam(2, $lastname);
        $result->bindParam(3, $username);
        $result->bindParam(4, $rol);
        $result->bindParam(5, $id);

        if ($result->execute()) {
            return true;
        }else{
            return false;
        }  
    }

    function isOldPass($id, $pass){

        $query = "SELECT * FROM usuarios where pass = ? AND idusuario = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $pass);
        $result->bindParam(2, $id);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {                
                return true;
            }else{
                return  false;
            }    
        }else{
            return false;
        }
    }

    function changePassUser($id, $pass){

        $query = "UPDATE usuarios SET  pass = ? WHERE idusuario = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $pass);
        $result->bindParam(2, $id);

        if ($result->execute()) {
            return true;
        }else{
            return false;
        }
    }

    function deleteUser($id) {
        $query = "DELETE FROM usuarios WHERE idusuario = ?";
        $result = $this->cnx->prepare($query);        
        $result->bindParam(1, $id);

        if ($result->execute()) {
            return true;
        }else{
            return false;
        }
    }


}



?>