<?php
/**
 * Description of conexion
 *
 * @author Osaldo Franco
 * 
 */
class Conexion {
    //put your code here
    public  $db;
    private $driver;
    private $host;
    private $user;
    private $pass;
    private $database;
    private static $instancia;
    
    private function __construct(){
        $db_cfg = require_once 'config.php';
        $this->driver = $db_cfg["driver"];
        $this->host = $db_cfg["host"];
        $this->user = $db_cfg["user"];
        $this->pass = $db_cfg["pass"];
        $this->database = $db_cfg["database"]; 
        try {
            $this->db = new PDO("$this->driver:host=$this->host;dbname=$this->database;user=$this->user;password=$this->pass");
        } 
        catch (PDOException $e) {
            echo 'Fallo la conexion: ' . $e->getMessage();
        }                            
    }
        
    public static function enlaceBD(){ 
       if (!isset(self::$instancia)){
            self::$instancia = new self;            
        }
        return self::$instancia;     
    }
    
    // Evita que el objeto se pueda clonar
    public function __clone(){
       trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }
    // Evita que el objeto se deserialice
    public function __wakeup(){
        trigger_error("No puede deserializar una instancia de ". get_class($this) ." class.", E_USER_ERROR );
    }
    
    public function __destruct(){  
         self::$instancia= NULL;  
    }
}