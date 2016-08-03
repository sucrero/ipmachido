<?php
    require_once 'Conexion.php';
    class Usuario{
        private $_con;

        public function __construct(){
            $this->_con = Conexion::enlaceBD();
        }
        
//        public function getUsuarios(){
//            try {
//                $query = $this->_con->prepare("SELECT * FROM usuarioget");
//                $query->execute();
//                return $query->fetchAll(PDO::FETCH_ASSOC);
//            } catch (PDOException $e) {
//                $e->getMessage();
//            }
//        }
//        
//        public function delUsuario($id){
//            try {
//                $query = $this->_con->prepare("DELETE FROM usuarioget WHERE id = ?");
//                $query->execute(array($id));
//            } catch (PDOException $e) {
//                $e->getMessage();
//            }
//        }
        
        public function insUsuario($login,$pass,$ced,$nom){
            try {
                $query = $this->_con->prepare("INSERT INTO usuario VALUE (null,?,?,?,?)");
                $query->execute(array($nom,$ced,$login,$pass));
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
        
//        public function updUsuario($id,$login,$pass,$nac,$ced,$nom,$tip,$creacion){
//            try {
//                $query = $this->_con->prepare("UPDATE usuarioget SET nomusu = ?,passusu = ?,nacusu = ?,cedusu = ?,nombre = ?,tipo = ?,creacion = ?");
//                $query->execute(array($id,$login,$pass,$nac,$ced,$nom,$tip,$creacion));
//            } catch (PDOException $e) {
//                $e->getMessage();
//            }
//        }
        

        public function ingresar(){
            $objUsuario = Conexion::enlaceBD();
            try {
                $sql = "INSERT INTO usuarioget (nomusu,passusu,nacusu,cedusu,nombre,tipo,creacion) VALUES (?,?,?,?,?,?,?)";
                $query = $objUsuario->db->prepare($sql);
                $query->execute(array($this->_login, $this->_clave, $this->_nac, $this->_cedula,  $this->_nombre,  $this->_tipo,  $this->_fecha));
                return 1;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        
//        public function buscar($sql){
//            $objUsuario = Conexion::enlaceBD();
//            try {
//                $query = $objUsuario->db->prepare($sql);
//                $query->execute();
//                $result = $query->fetchAll(PDO::FETCH_ASSOC);
//                return $result;
//            } catch (PDOException $e) {
//                return $e->getMessage();
//            }
//        }
//        
//        public function modificar($sql){
//            $objUsuario = Conexion::enlaceBD();
//            try {
//                $query = $objUsuario->db->prepare($sql);
//            } catch (Exception $ex) {
//                
//            }
//        }

        
//        public function modificar($sql,$conexion){
//            if($conexion->ejecutarSql($sql)){
//                if($conexion->registros > 0){
//                    return TRUE;
//                }else{
//                    return FALSE;
//                }
//            }
//        }
//        
//        public function __get($name){
//            return $this->$name;
//        }
        
        public function combinarClave($pas,$num){
            $patron = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $selt = sprintf('$2a$%02d$', $num);
            for($i = 0; $i < 22; $i++){
                $selt .= $patron[ rand(0, strlen($patron)-1) ];
            }
            return crypt($pas, $selt);
        }
        
        public function descombinarClave($clavenormal,$clavecifrada){
            if(crypt($clavenormal, $clavecifrada) == $clavecifrada){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        
        
        
        //
//                public function ingresar($conexion){
//            $sql = "INSERT INTO usuarioget (nomusu,passusu,nacusu,cedusu,nombre,tipo,creacion) VALUES 
//                ('$this->_login','$this->_clave','$this->_nac','$this->_cedula','$this->_nombre','$this->_tipo','$this->_fecha')";
//            if($consulta = $conexion->ejecutarSql($sql)){
//                return $consulta;
//            }
//        }
        
                
//        public function buscar($sql,$conexion){
//            if($conexion->ejecutarSql($sql)){
//                if($conexion->registros > 0){
//                    $consulta = $conexion->devolver_recordset();
//                    $f = $consulta['creacion'];
//                    $this->setPropiedades(strtoupper($consulta['nomusu']), $consulta['passusu'], $consulta['nacusu'], substr($f,8,2)."/".substr($f,5,2)."/".substr($f,0,4),
//                    $consulta['cedusu'],$consulta['nombre'],$consulta['tipo']);
//                    return TRUE;
//                }else{
//                    return FALSE;
//                }
//            }
//        }
    }