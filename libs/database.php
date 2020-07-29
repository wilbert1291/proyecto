<?php
    class Database {
        private $handler;
        private $host;
        private $db;
        private $user;
        private $password;
        private $charset;
        private static $instancia = null;
        
        
        
        private function __construct() {
            $this->handler = constant('HANDLER');
            $this->host = constant('HOST');
            $this->db = constant('DB');
            $this->user = constant('USER');
            $this->password = constant('PASSWORD');
            $this->charset = constant('CHARSET');    
            
            try {
                self::$instancia = new PDO("{$this->handler}:dbname={$this->db};host={$this->host};charset={$this->charset}", $this->user, $this->password);
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede conectar a la base de datos. <br> Detalle: ' . $e->getMessage();
                exit;
            }
        }
        public static function getInstancia(){
            if(!self::$instancia){
                new self();
            }
            return self::$instancia;
        }
        
        public static function cerrar(){
            self::$instancia = null;
        }
    }
?>