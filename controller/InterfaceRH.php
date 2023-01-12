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
        }
        return false;
    }


}




?>