<?php
    include_once('clases/veterinario.php');

    class ControladorVeterinario {
        private $veterinario;

        public function __construct() {
            $this->veterinario = new Veterinario();

        }

        public function index() {
            $resultado = $this->veterinario->listar();
            return $resultado;

        }

        public function crear($nombre, $apellido, $identificacion, $tprofesional, $correo, $contrasena, $direccion, $celular, $activado) {
            $this->veterinario->set('nombre', $nombre);
            $this->veterinario->set('apellido', $apellido);
            $this->veterinario->set('identificacion', $identificacion);
            $this->veterinario->set('tprofesional', $tprofesional);
            $this->veterinario->set('correo', $correo);
            $this->veterinario->set('contrasena', $contrasena);
            $this->veterinario->set('direccion', $direccion);
            $this->veterinario->set('celular', $celular);
            $this->veterinario->set('activado', 1);
            $this->veterinario->set('idUsuario', 3);

            $resultado = $this->veterinario->crear();

            return $resultado;

        }

        public function eliminar($id) {
            $this->veterinario->set('id', $id);
            $this->veterinario->set('activado', '0');
            $this->veterinario->eliminar();

        }

        public function ver($id) {
            $this->veterinario->set('id', $id);
            $datos = $this->veterinario->ver();

            return $datos;

        }

        public function editar($id, $nombre, $apellido, $identificacion, $tprofesional, $correo, $contrasena, $direccion, $telefono, $celular, $pathFoto, $estFoto, $activado) {
            $this->veterinario->set('id', $id);
            $this->veterinario->set('nombre', $nombre);
            $this->veterinario->set('apellido', $apellido);
            $this->veterinario->set('identificacion', $identificacion);
            $this->veterinario->set('tprofesional', $tprofesional);
            $this->veterinario->set('correo', $correo);
            $this->veterinario->set('contrasena', $contrasena);
            $this->veterinario->set('direccion', $direccion);
            $this->veterinario->set('telefono', $telefono);
            $this->veterinario->set('celular', $celular);
            $this->veterinario->set('pathFoto', $pathFoto);
            $this->veterinario->set('activado', $activado);

            $this->veterinario->editar($estFoto);

        }

        public function inicioSesion($usuario, $contrasena) {
            $this->veterinario->set('correo', $usuario);
            $this->veterinario->set('contrasena', md5($contrasena));

            $resultado = $this->veterinario->inicioSesion();

            return $resultado;

        }

        public function misVeterinarias($id) {
            $this->veterinario->set('id', $id);
            $resultado = $this->veterinario->misVeterinarias();
            return $resultado;
        }

        public function miConsultorio($id) {
            $this->veterinario->set('idVeterinario', $id);
            $resultado = $this->veterinario->miConsultorio();
            return $resultado;
        }
    }
?>
