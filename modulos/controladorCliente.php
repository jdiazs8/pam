<?php
    include_once('clases/cliente.php');

    class ControladorCliente {
        private $cliente;

        public function __construct() {
            $this->cliente = new Cliente();

        }

        public function index() {
            $resultado = $this->cliente->listar();
            return $resultado;

        }

        public function crear($nombre, $apellido, $identificacion, $correo, $contrasena) {
            $this->cliente->set('nombre', $nombre);
            $this->cliente->set('apellido', $apellido);
            $this->cliente->set('identificacion', $identificacion);
            $this->cliente->set('correo', $correo);
            $this->cliente->set('contrasena', $contrasena);
            $this->cliente->set('activado', 1);
            $this->cliente->set('idUsuario', 2);

            $resultado = $this->cliente->crear();

            return $resultado;

        }

        public function eliminar($id) {
            $this->cliente->set('id', $id);
            $this->cliente->set('activado', '0');
            $this->cliente->eliminar();

        }

        public function ver($id) {
            $this->cliente->set('id', $id);
            $datos = $this->cliente->ver();

            return $datos;

        }

        public function editar($id, $nombre, $apellido, $identificacion, $correo, $contrasena, $direccion, $telefono, $celular, $pathFoto, $estFoto, $activado) {
            $this->cliente->set('id', $id);
            $this->cliente->set('nombre', $nombre);
            $this->cliente->set('apellido', $apellido);
            $this->cliente->set('identificacion', $identificacion);
            $this->cliente->set('correo', $correo);
            $this->cliente->set('contrasena', $contrasena);
            $this->cliente->set('direccion', $direccion);
            $this->cliente->set('telefono', $telefono);
            $this->cliente->set('celular', $celular);
            $this->cliente->set('pathFoto', $pathFoto);
            $this->cliente->set('activado', $activado);

            $this->cliente->editar($estFoto);

        }

        public function inicioSesion($usuario, $contrasena) {
            $this->cliente->set('correo', $usuario);
            $this->cliente->set('contrasena', md5($contrasena));

            $resultado = $this->cliente->inicioSesion();

            return $resultado;

        }

        public function misMascotas($id) {
            $this->cliente->set('id', $id);
            $resultado = $this->cliente->misMascotas();
            return $resultado;
        }

        public function calificarVisita($calificacion, $comentario, $idVisita, $idVeterinaria) {
          $this->cliente->calificarVisita($calificacion, $comentario, $idVisita, $idVeterinaria);
        }
    }
?>
