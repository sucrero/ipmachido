<?php
    require_once 'Conexion.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of persona
 *
 * @author Oswaldo Franco
 * 
 */
    class Pc {
        private $_con;
        private $_fechaReg;

        public function __construct(){
            $this->_con = Conexion::enlaceBD();
            $this->_fechaReg = date('Y-m-d h:i:s');
        }

        public function ingresarPc($nombrepc,$nombreusu,$mac,$ip,$ubicacion,$departamento,$observacion){
            try {
                $sql ="SELECT * FROM equipo WHERE nombrepc = upper(?)";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1, $nombrepc);
                $query->execute();
                $num = count($query->fetchAll());
                if($num >= 1){
                    return 3; //NOMBRE DE PC REPETIDO
                }  else {
                    $sql ="SELECT * FROM equipo WHERE nombreusu = upper(?)";
                    $query = $this->_con->db->prepare($sql);
                    $query->bindParam(1, $nombreusu);
                    $query->execute();
                    $num = count($query->fetchAll());
//                    print_r("este: ".$num); exit();
                    if($num >= 1){
                        return 4; //NOMBRE DE USUARIO REPETIDO
                    }  else {
                        $mactemp = str_split($mac, 2);
                        $macfin = "";
                        for($i = 0; $i < count($mactemp);$i++){
                            if($macfin == "")
                                $macfin = $mactemp[$i];
                            else
                                $macfin .= ':'.$mactemp[$i];
                        }
//                        print_r($macfin);exit();
                        $sql = "SELECT * FROM equipo WHERE mac = ?";
                        $query = $this->_con->db->prepare($sql);
                        $query->bindParam(1, $macfin);
                        $query->execute();
                        $num = count($query->fetchAll());
//                        print_r("mac: ".$num); exit();
                        if($num >= 1){
                            return 5; //NOMBRE DE MAC REPETIDO
                        }  else {
                            $ip .= "/32";
                            $sql ="SELECT * FROM equipo WHERE direccionip = ?";
                            $query = $this->_con->db->prepare($sql);
                            $query->bindParam(1, $ip);
                            $query->execute();
                            $num = count($query->fetchAll());
//                            print_r("ip: ".$num); exit();
                            if($num >= 1){
                                return 6; //IP REPETIDO
                            }  else {
                                $sql = "INSERT INTO equipo (nombrepc,nombreusu,mac,direccionip,ubicacion,fechamod,fcehaingreso,departamento,observacion) VALUES 
                                                                                        (?,?,?,?,?,?,?,?,?)";
                                $query = $this->_con->db->prepare($sql);
                                $query->bindParam(1,strtoupper($nombrepc));
                                $query->bindParam(2,strtoupper($nombreusu));
                                $query->bindParam(3,strtoupper($mac));
                                $query->bindParam(4,$ip);
                                $query->bindParam(5,strtoupper($ubicacion));
                                $query->bindParam(6,$this->_fechaReg);
                                $query->bindParam(7,$this->_fechaReg);
                                $query->bindParam(8,strtoupper($departamento));
                                $query->bindParam(9,strtoupper($observacion));
                                if($query->execute()){
                                     print_r($this->_con->db->errorInfo()); exit();
                                    return 1;
                                }else{
                                    print_r($this->_con->db->errorInfo()); exit();
                                    return 2; //ERROR AL INGRESAR
                                }

                            }

                        }
                        
                    }
                }
          

                
            } catch (PDOException $e) {
                return "Fallo el registro: ".$e->getMessage();
            }
        }
        
        public function numregistro(){
            try {
                $query = $this->_con->db->prepare("SELECT COUNT(id) FROM equipo");
                $query->execute();
                $result = $query->fetchColumn();
                if(is_null($result)){
                    $num = 1;
                }else{
                    $num = (int)$result+1;
                }
                return $num;
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
        
        Public function eliminarpc($id){
            try{
                $sql = "DELETE FROM equipo WHERE id = ?";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1,$id);
                if($query->execute()){
//                    print_r($this->_con->db->errorInfo()); exit();
                    return 1;
                }else{
//                    print_r($this->_con->db->errorInfo()); exit();
                    return 2; //ERROR AL INGRESAR
                }
            } catch (PDOException $e) {
                return "Fallo la eliminacion del registro: ".$e->getMessage();
            }
        }
        
        public function consultarpc($id){
            try {
                $sql = "SELECT * FROM equipo WHERE id = ?";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1,$id);
                $query->execute();
                return $query->fetchAll(PDO::FETCH_NUM);
            } catch (PDOException $e) {
                return "Falló al consultar el registro: ".$e->getMessage();
            }
        }
        
        public function modificarPc($idregis, $nombrepc, $nombreusu, $mac, $ip, $ubi, $dpto, $obs){
            try {
                $sql = "UPDATE equipo SET nombrepc = ?, nombreusu = ?, mac = ?, direccionip = ?, ubicacion = ?, fechamod = ?,
                                            departamento = ?, observacion = ? WHERE id = ?";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1,strtoupper($nombrepc));
                $query->bindParam(2,strtoupper($nombreusu));
                $query->bindParam(3,strtoupper($mac));
                $query->bindParam(4,$ip);
                $query->bindParam(5,strtoupper($ubi));
                $query->bindParam(6,$this->_fechaReg);
                $query->bindParam(7,strtoupper($dpto));
                $query->bindParam(8,strtoupper($obs));
                $query->bindParam(9,$idregis);
                if($query->execute()){
                    return 1;
                }else{
//                    print_r($this->_con->db->errorInfo()); exit();
                    return 2; //ERROR AL MODIFICAR
                }
                
            } catch (PDOException $e) {
                return "Fallo modificar: ".$e->getMessage();
            }
        }
        
//        public function buscarPer($nac,$ced){
//            try {
//                $query = $this->_con->db->prepare("SELECT * FROM participante WHERE nac = ? AND cedula = ?");
//                $query->execute(array(strtoupper($nac),$ced));
//                if($query->fetchColumn() > 0){
//                    return 0;
//                }else{
//                    return 1;
//                }
////                $val = $query->rowCount();
////                print_r("hola :".$query->fetchColumn()." // "); exit();
////                print_r($this->_con->db->errorInfo()); exit();
////                return $query->rowCount();
//            } catch (PDOException $e) {
//                $e->getMessage();
//            }
//        }
        
//        public function buscarNrotran($nrotran){
//            try {
//                $query = $this->_con->db->prepare("SELECT * FROM participante WHERE nrotrans = ?");
//                $query->execute(array($nrotran));
////                print_r($this->_con->db->errorInfo()); exit();
////            print_r("holas: ".$query->fetchColumn()." /n");exit();
//                 if($query->fetchColumn() > 0){
//                    return 0;
//                }else{
//                    return 1;
//                }
//            } catch (PDOException $e) {
//                $e->getMessage();
//            }
//        }

//        public function modificarPer($id,$nac,$cedula,$nombre,$apellido,$telmovil,$telfijo,$fecnac,$correo,$club,$edodir,$mundir,$direccion,$banco,$tiptran,$numtran,
//                                                                $fectran,$bancodest,$genero,$talla,$pais,$confirmado, $numero){
//            try {
//                $sql = "UPDATE participante SET nac = ?, cedula = ?, nombre = ?, apellido = ?, celular = ?, telefonofijo = ?, fechanac = ?, correo = ?, club = ?, estadodir = ?,
//                                                                        municipiodir = ?, direccion = ?, tipotrans = ?, nrotrans = ?, fechatrans = ?, bancodest = ?, genero = ?,
//                                                                        talla = ?, pais = ?, banco = ?, confirmado = ?, numero = ? WHERE id = ?)";
//                $query = $this->_con->db->prepare($sql);
//                $query->execute(array($nac,$cedula,$nombre,$apellido,$telmovil,$telfijo,$fecnac,$correo,$club,$edodir,$mundir,$direccion, $tiptran,$numtran,$fectran,
//                                                            $bancodest,$genero,$talla,$pais,$banco, $confirmado, $numero,$id ));
//            } catch (PDOException $e) {
//                $e->getMessage();
//            }
//        }
//        
//        public function confirPer($id){
//            try {
//                $query = $this->_con->db->prepare("UPDATE participante SET confirmado = ? WHERE id = ?");
//                $query->execute(array(1,$id));
//            } catch (PDOException $e) {
//                $e->getMessage();
//            }
//        }
//        


    }