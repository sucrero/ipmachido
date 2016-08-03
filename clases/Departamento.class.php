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
    class Departamento {
        private $_con;
        private $_fechaReg;

        public function __construct(){
            $this->_con = Conexion::enlaceBD();
            $this->_fechaReg = date('Y-m-d H:i:s');
        }
 
        public function ingresarDpto($nombrecompleto,$nombreabrv,$nac,$ced,$nomb,$ape,$genero,$titulo,$tipo){
            try {
                $sql = "INSERT INTO departamentos (nombrecompleto,nombreabrv,fechaingreso,fechamod) VALUES 
                                                                        (?,?,?,?)";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1,strtoupper($nombrecompleto));
                $query->bindParam(2,strtoupper($nombreabrv));
                $query->bindParam(3,$this->_fechaReg);
                $query->bindParam(4,$this->_fechaReg);
                if($query->execute()){
                    $iddpto = $this->_con->db->lastInsertId('departamentos_id_seq');
                    print_r($iddpto);
                                        die();
                    $sql = "INSERT INTO responsable (nombre,apellido,titulo,cedula,fecha,fechamod,status,departamento,nacionalidad,genero,tipo) VALUES
                                                        (?,?,?,?,?,?,?,?,?,?,?)";
                    $query = $this->_con->db->prepare($sql);
                    $query->bindParam(1,strtoupper($nomb));
                    $query->bindParam(2,strtoupper($ape));
                    $query->bindParam(3,strtoupper($titulo));
                    $query->bindParam(4,$ced);
                    $query->bindParam(3,$this->_fechaReg);
                    $query->bindParam(4,$this->_fechaReg);
                    $query->bindParam(5,'1');
                    $query->bindParam(6,$iddpto);
                    $query->bindParam(7,strtoupper($nac));
                    $query->bindParam(8,strtoupper($genero));
                    $query->bindParam(9,strtoupper($tipo));
                    if($query->execute()){
                        return 1;
                    }else{
                        return 3;//ERROR AL INGRESAR RESPONSABLE
                    }
                    
                }else{
//                    print_r($this->_con->db->errorInfo()); exit();
                    return 2; //ERROR AL INGRESAR DPTO
                }
                
            } catch (PDOException $e) {
                return "Fallo el registro: ".$e->getMessage();
            }
        }
        
        public function numregistrodpto(){
            try {
                $query = $this->_con->db->prepare("SELECT COUNT(id) FROM departamentos");
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
        
        Public function eliminarDpto($id){
            try{
                $sql = "DELETE FROM departamentos WHERE id = ?";
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
        
        public function consultarDpto($id){
            try {
                $sql = "SELECT * FROM departamentos WHERE id = ?";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1,$id);
                $query->execute();
                return $query->fetchAll(PDO::FETCH_NUM);
            } catch (PDOException $e) {
                return "Falló al consultar el registro: ".$e->getMessage();
            }
        }
        
        public function modificarDpto($idregis, $nombrecompleto, $nombreabrv){
            try {
                $sql = "UPDATE departamentos SET nombrecompleto = ?, nombreabrv = ?, fechamod = ? WHERE id = ?";
                $query = $this->_con->db->prepare($sql);
                $query->bindParam(1,strtoupper($nombrecompleto));
                $query->bindParam(2,strtoupper($nombreabrv));
                $query->bindParam(3,$this->_fechaReg);
                $query->bindParam(4,$idregis);
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