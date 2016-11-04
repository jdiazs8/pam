<?php
    require_once('conexion.php');

    abstract class Usuario {
        protected $id;
        protected $nombre;
        protected $apellido;
        protected $identificacion;
        protected $correo;
        protected $contrasena;
        protected $direccion;
        protected $telefono;
        protected $celular;
        protected $pathFoto;
        protected $activado;
        protected $fechaRegistro;
        protected $fechaUM;
        protected $idUsuario;

        public function __construct() {
            $this->con = new Conexion();
            $this->con->conectar();

        }

        public function set($atributo, $contenido) {
            $this->$atributo = $contenido;

        }

        public function get($atributo) {
            return $this->$atributo;

        }

        abstract protected function listar();
        abstract protected function crear();
        abstract protected function eliminar();
        abstract protected function ver();
        abstract protected function editar($estFoto);

    }
?>
