<?php
    class Conexion {
        private $host;
        private $user;
        private $pass;
        private $db;
        
        public function __construct() {
            $this->host = 'localhost';
            $this->user = 'root';
            $this->pass = '';
            $this->db = 'db_pam';
    
        }
        
        public function conectar() {
            $this->con = mysqli_connect($this->host, $this->user, $this->pass);
            mysqli_select_db($this->con, $this->db);
            mysqli_set_charset($this->con, 'utf8');
            
        }
        
        public function consultaSimple($sql) {
            mysqli_query($this->con, $sql);
            
        }
        
        public function consultaRetorno($sql) {
            $consulta = mysqli_query($this->con, $sql);
            return $consulta;
            
        }
        
    }

    $con = new Conexion();
    $con->conectar();

?>