<?php
    include_once('clases/extra.php');

    class ControladorExtra {
        private $extra;

        public function __construct() {
            $this->extra = new Extra();

        }

        public function index($item) {
            $resultado = $this->extra->listar($item);
            return $resultado;

        }

        public function crear($nombre, $apellido, $identificacion, $correo, $contrasena) {
            $this->extra->set('nombre', $nombre);
            $this->extra->set('apellido', $apellido);
            $this->extra->set('identificacion', $identificacion);
            $this->extra->set('correo', $correo);
            $this->extra->set('contrasena', $contrasena);
            $this->extra->set('activado', 1);
            $this->extra->set('idUsuario', 2);

            $resultado = $this->extra->crear();

            return $resultado;

        }

        public function eliminar($id) {
            $this->extra->set('id', $id);
            $this->extra->set('activado', '0');
            $this->extra->eliminar();

        }

        public function ver($id) {
            $this->extra->set('id', $id);
            $datos = $this->extra->ver();

            return $datos;

        }

        public function editar($id, $nombre, $apellido, $identificacion, $correo, $contrasena, $direccion, $telefono, $celular, $pathFoto, $estFoto, $activado) {
            $this->extra->set('id', $id);
            $this->extra->set('nombre', $nombre);
            $this->extra->set('apellido', $apellido);
            $this->extra->set('identificacion', $identificacion);
            $this->extra->set('correo', $correo);
            $this->extra->set('contrasena', $contrasena);
            $this->extra->set('direccion', $direccion);
            $this->extra->set('telefono', $telefono);
            $this->extra->set('celular', $celular);
            $this->extra->set('pathFoto', $pathFoto);
            $this->extra->set('activado', $activado);

            $this->extra->editar($estFoto);

        }

        public function inicioSesion($usuario, $contrasena) {
            $this->extra->set('correo', $usuario);
            $this->extra->set('contrasena', md5($contrasena));

            $resultado = $this->extra->inicioSesion();

            return $resultado;

        }

        public function misMascotas($id) {
            $this->extra->set('id', $id);
            $resultado = $this->extra->misMascotas();
            return $resultado;
        }

        public function calificarVisita($calificacion, $comentario, $idVisita) {
          $this->extra->calificarVisita($calificacion, $comentario, $idVisita);
        }
    }
?>
