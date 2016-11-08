<?php
    include_once('clases/admin.php');

    class ControladorAdmin {
        private $admin;

        public function __construct() {
            $this->admin = new Admin();

        }

        public function index() {
            $resultado = $this->admin->listar();
            return $resultado;

        }

        public function crear($nombre, $correo, $contrasena) {
            $this->admin->set('nombre', $nombre);
            $this->admin->set('correo', $correo);
            $this->admin->set('contrasena', $contrasena);
            $this->admin->set('activado', 1);
            $this->admin->set('idUsuario', 1);

            $resultado = $this->admin->crear();

            return $resultado;

        }

        public function eliminar($id) {
            $this->admin->set('id', $id);
            $this->admin->set('activado', '0');
            $this->admin->eliminar();

        }

        public function ver($id) {
            $this->admin->set('id', $id);
            $datos = $this->admin->ver();

            return $datos;

        }

        public function editar($id, $nombre, $correo, $contrasena, $activado) {
            $this->admin->set('id', $id);
            $this->admin->set('nombre', $nombre);
            $this->admin->set('correo', $correo);
            $this->admin->set('contrasena', $contrasena);
            $this->admin->set('activado', $activado);

            $this->admin->editar();

        }

        public function verClientes() {
          $resultado = $this->admin->verClientes();
          return $resultado;
        }

        public function verMascotas() {
          $resultado = $this->admin->verMascotas();
          return $resultado;
        }

        public function inicioSesion($usuario, $contrasena) {
            $this->admin->set('correo', $usuario);
            $this->admin->set('contrasena', md5($contrasena));

            $resultado = $this->admin->inicioSesion();

            return $resultado;

        }
    }
?>
