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
    class Responsable {
        private $_con;
        private $_fechaReg;

        public function __construct(){
            $this->_con = Conexion::enlaceBD();
            $this->_fechaReg = date('Y-m-d h:i:s');
        }

        public function ingresarResp($nombre,$apellido,$titulo,$cedula,$nac){
            try {
                $sql = "INSERT INTO responsable (nombre,apellido,titulo,cedula,fecha,fechamod,nacionalidad) VALUES 
                                                                        (?,?,?,?,?,?,?)";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1,strtoupper($nombrecompleto));
                $query->bindParam(2,strtoupper($nombreabrv));
                $query->bindParam(3,strtoupper($titulo));
                $query->bindParam(4,cedula);
                $query->bindParam(5,$this->_fechaReg);
                $query->bindParam(6,$this->_fechaReg);
                $query->bindParam(7,strtoupper($nac));
                if($query->execute()){
                    return 1;
                }else{
//                    print_r($this->_con->db->errorInfo()); exit();
                    return 2; //ERROR AL INGRESAR
                }
                
            } catch (PDOException $e) {
                return "Fallo el registro: ".$e->getMessage();
            }
        }
        
        public function numregistroResp(){
            try {
                $query = $this->_con->db->prepare("SELECT COUNT(id) FROM responsable");
                $query->execute();
                $result = $query->fetchColumn();
//                var_dump(is_null($result));  exit();
                if(is_null($result)){
                    $num = 1;
                }else{
                    $num = (int)$result+1;
                }
//                print_r("es: ".$num); exit();
                return $num;
            } catch (PDOException $e) {
                return "falla: ".$e->getMessage();
            }
        }
        
        Public function eliminarResp($id){
            try{
                $sql = "DELETE FROM responsable WHERE id = ?";
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
        
        public function consultarResp($id){
            try {
                $sql = "SELECT * FROM responsable WHERE id = ?";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1,$id);
                $query->execute();
                return $query->fetchAll(PDO::FETCH_NUM);
            } catch (PDOException $e) {
                return "Falló al consultar el registro: ".$e->getMessage();
            }
        }
        
        public function modificarResp($nombre,$apellido,$titulo,$cedula,$nac,$id){
            try {
                $sql = "UPDATE departamentos SET nombre = ?, apellido = ?, titulo = ?, cedula = ?, fechamod = ?, nacionalidad = ? WHERE id = ?";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1,strtoupper($nombre));
                $query->bindParam(2,strtoupper($apellido));
                $query->bindParam(3,strtoupper($titulo));
                $query->bindParam(4,strtoupper($cedula));
                $query->bindParam(5,$this->_fechaReg);
                $query->bindParam(6,strtoupper($nac));
                $query->bindParam(7,$id);
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
    }