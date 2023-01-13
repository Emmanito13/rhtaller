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


}




?>