<?php 
require "../config/ConectionDB.php";

class InterfaceRH
{
    public $cnx;

    function __construct()
    {
        $this->cnx =  Conexion::ConectarDB();
    }

    function listarTurnos(){
        $query = "SELECT * FROM turno";
        $result = $this->cnx->prepare($query);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }    

    function listarContratos(){
        $query = "SELECT * FROM contrato";
        $result = $this->cnx->prepare($query);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function listarEmpresas(){
        $query = "SELECT * FROM empresa";
        $result = $this->cnx->prepare($query);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function listarDepartamentos(){
        $query = "SELECT * FROM departamento";
        $result = $this->cnx->prepare($query);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function listarPuestos(){
        $query = "SELECT * FROM puesto";
        $result = $this->cnx->prepare($query);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function listarJefes(){
        $query = "SELECT * FROM jefe";
        $result = $this->cnx->prepare($query);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function getTurnoByName($name){
        $query = "SELECT * FROM turno WHERE horario = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$name);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function getContratoByName($name){
        $query = "SELECT * FROM contrato WHERE nombre = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$name);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function getEmpresaByName($name){
        $query = "SELECT * FROM empresa WHERE nombre = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$name);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function getDepaByName($name){
        $query = "SELECT * FROM departamento WHERE nombre = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$name);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function getPuestoByName($name){
        $query = "SELECT * FROM puesto WHERE nombre = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$name);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }

    function getJefeByName($name){
        $query = "SELECT * FROM jefe WHERE nombre = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$name);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return $datos = [];
            }
        }else{            
            return $datos = [];
        }
    }


}




?>