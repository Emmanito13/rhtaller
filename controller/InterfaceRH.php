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
        $query = "SELECT * FROM departamento ORDER BY nombre DESC";
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

    function getDepaEmployee($depa){
        $query = "SELECT T.Nlista, CONCAT(E.Nombre, ' ', E.Apellidos) AS nombre  
        FROM empleado AS E 
        INNER JOIN trabajo as T ON E.idE = T.idE
        INNER JOIN departamento as D ON T.idDepartamento = D.idDepa
        WHERE T.estatus = 'activo'
        AND D.nombre LIKE ?
        ORDER BY T.Nlista ASC";

        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$depa);

        if($result->execute()){
            if($result->rowCount() > 0){
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

    function getEmployeeFemale($depa){
        $query = "SELECT T.Nlista, CONCAT(E.Nombre,' ',E.Apellidos) AS nombre 
        FROM empleado as E 
        INNER JOIN trabajo as T ON E.idE = T.idE 
        INNER JOIN departamento as D ON T.idDepartamento = D.idDepa 
        WHERE E.Sexo = 'F' 
        AND D.nombre LIKE ? 
        AND T.estatus = 'activo' 
        ORDER BY T.Nlista ASC;";

        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$depa);

        if($result->execute()){
            if($result->rowCount() > 0){
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

    function getEmployeeMale($depa){
        $query = "SELECT T.Nlista, CONCAT(E.Nombre,' ',E.Apellidos) AS nombre 
        FROM empleado as E 
        INNER JOIN trabajo as T ON E.idE = T.idE 
        INNER JOIN departamento as D ON T.idDepartamento = D.idDepa 
        WHERE E.Sexo = 'M' 
        AND D.nombre LIKE ? 
        AND T.estatus = 'activo' 
        ORDER BY T.Nlista ASC;";
        
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$depa);

        if($result->execute()){
            if($result->rowCount() > 0){
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

    function getEmployeeSS(){
        $query = "SELECT T.Nlista, CONCAT(E.Nombre, ' ', E.Apellidos) AS nombre, I.idimss as listaimss
        FROM empleado AS E 
        INNER JOIN trabajo as T ON E.idE = T.idE
        INNER JOIN imss as I ON E.idE = I.idE
        WHERE T.estatus = 'activo'
        AND I.idimss NOT LIKE '0' 
        ORDER BY T.Nlista ASC";
        
        $result = $this->cnx->prepare($query);        
        if($result->execute()){
            if($result->rowCount() > 0){
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

    function getEmployeeNoSS(){
        $query = "SELECT T.Nlista, CONCAT(E.Nombre, ' ', E.Apellidos) AS nombre, D.nombre as depa, T.Fingreso, TIMESTAMPDIFF(YEAR,E.Fnacimiento,CURDATE()) as edad
        FROM empleado AS E 
        INNER JOIN trabajo as T ON E.idE = T.idE
        INNER JOIN departamento as D ON T.idDepartamento = D.idDepa
        INNER JOIN imss as I ON E.idE = I.idE        
        WHERE T.estatus = 'activo'
        AND I.idimss LIKE '0' OR i.idimss IS NULL 
        ORDER BY T.Nlista ASC";
        
        $result = $this->cnx->prepare($query);        
        if($result->execute()){
            if($result->rowCount() > 0){
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

    function getBirthdayByMonth($month){
        $query = "SELECT T.Nlista, CONCAT(E.Nombre, ' ', E.Apellidos) AS nombre, E.Fnacimiento
        FROM empleado AS E 
        INNER JOIN trabajo as T ON E.idE = T.idE        
        WHERE T.estatus = 'activo'
        AND MONTH(E.Fnacimiento) = ?
        ORDER BY T.Nlista ASC";
        
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$month);

        if($result->execute()){
            if($result->rowCount() > 0){
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

    function listNomina(){
        
        $query = "SELECT E.idE, T.Nlista, 
        CONCAT(E.Nombre, ' ', E.Apellidos) AS nombre,
        T.Sueldo as sueldo,
        T.mdias, ROUND((T.Sueldo) - ((T.Sueldo / 12)*(T.mdias)),2)  as faltantes,
        ROUND((T.Sueldo)-((T.Sueldo / 12)* (12-T.mdias)),2) as subtotal, 
        T.prestamo, T.infonavit,
        (ROUND((T.Sueldo)-((T.Sueldo / 12)* (12-T.mdias)),2))- (T.prestamo + T.infonavit) as total,
        T.pago
        FROM empleado as E 
        INNER JOIN trabajo AS T ON E.idE = T.idE
        INNER JOIN turno AS TU ON T.idTurno = TU.idTurno
        WHERE T.estatus = 'activo'
        ORDER BY T.Nlista ASC"; 
        
        $result = $this->cnx->prepare($query);        

        if($result->execute()){
            if($result->rowCount() > 0){
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

    function updateMDias ($idE,$mdias) {
        $query = "UPDATE trabajo SET mdias = ? WHERE idE = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $mdias);
        $result->bindParam(2, $idE); 
        if ($result->execute()) {  
            return true;
        } else {
            return false;
        }
    }

    function updatePrestamo ($idE, $prestamo) {
        $query = "UPDATE trabajo SET prestamo = ? WHERE idE = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $prestamo);
        $result->bindParam(2, $idE); 
        if ($result->execute()) {  
            return true;
        } else {
            return false;
        }        
    }

    function updateInfonavit ($idE, $infonavit) {
        $query = "UPDATE trabajo SET infonavit = ? WHERE idE = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $infonavit);
        $result->bindParam(2, $idE); 
        if ($result->execute()) {  
            return true;
        } else {
            return false;
        }        
    }

    function updatePago ($idE, $newPago) {
        $query = "UPDATE trabajo SET pago = ? WHERE idE = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $newPago);
        $result->bindParam(2, $idE); 
        if ($result->execute()) {  
            return true;
        } else {
            return false;
        }        
    }

    function saveNomina($dateStart, $dateEnd, $empleados, $totalBruto, $totalFantantes, $subtotal, $totalInfonavit, $totalPrestamo, $totalNoAprobados, $totalNeto) {
        $query = "INSERT INTO nominas(fechai,fechaf,empleados,totalbruto,totalfaltantes,subtotal,totalinfonavit,totalprestamos,totalnoaprobados,totalneto) 
                    VALUES (?,?,?,?,?,?,?,?,?,?)";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1, $dateStart);
        $result->bindParam(2, $dateEnd); 
        $result->bindParam(3, $empleados); 
        $result->bindParam(4, $totalBruto); 
        $result->bindParam(5, $totalFantantes); 
        $result->bindParam(6, $subtotal); 
        $result->bindParam(7, $totalInfonavit); 
        $result->bindParam(8, $totalPrestamo);
        $result->bindParam(9, $totalNoAprobados);
        $result->bindParam(10, $totalNeto);         
        if ($result->execute()) {  
            return true;
        } else {
            return false;
        }
    }

    function overWriteNomina($id, $empleados, $totalBruto, $totalFantantes, $subtotal, $totalInfonavit, $totalPrestamo, $totalNoAprobados, $totalNeto) {
        $query = "UPDATE nominas SET empleados = ?, totalbruto = ?, totalfaltantes = ?, subtotal = ?, totalinfonavit = ?, totalprestamos = ?, totalnoaprobados = ?, totalneto = ? 
                    WHERE id = ?";
        $result = $this->cnx->prepare($query);         
        $result->bindParam(1, $empleados); 
        $result->bindParam(2, $totalBruto); 
        $result->bindParam(3, $totalFantantes); 
        $result->bindParam(4, $subtotal); 
        $result->bindParam(5, $totalInfonavit); 
        $result->bindParam(6, $totalPrestamo);
        $result->bindParam(7, $totalNoAprobados);
        $result->bindParam(8, $totalNeto); 
        $result->bindParam(9, $id); 
        if ($result->execute()) {  
            return true;
        } else {
            return false;
        }
    }

    function existEntryNomina($dateStart, $dateEnd){
        $query = "SELECT id,fechai,fechaf,totalneto FROM nominas WHERE fechai = ? AND fechaf = ?";
        $result = $this->cnx->prepare($query);        
        $result->bindParam(1, $dateStart); 
        $result->bindParam(2, $dateEnd);
        
        if($result->execute()){
            if($result->rowCount() > 0){
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;                
                }
                return $data;
            }else{
                $data = [];
            }
        }else{
            return $data = ['error'];
        }
    }

    function listRecordNomina(){
        $query = "SELECT * FROM nominas ORDER BY fechai DESC;";

        $result = $this->cnx->prepare($query);

        if($result->execute()){
            if($result->rowCount() > 0){
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

    function listRecordNominaByDate($dateStart, $dateEnd){
        $query = "SELECT * FROM nominas 
                    WHERE fechai BETWEEN ? AND ?
                    ORDER BY fechai DESC;";

        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$dateStart);
        $result->bindParam(2,$dateEnd);

        if($result->execute()){
            if($result->rowCount() > 0){
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

    function listRecordNominaAll(){
        $query = "SELECT * FROM nominas
                    ORDER BY fechai DESC;";

        $result = $this->cnx->prepare($query);             

        if($result->execute()){
            if($result->rowCount() > 0){
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
