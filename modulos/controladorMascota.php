<?php
    include_once('clases/mascota.php');

    class ControladorMascota {
        private $mascota;

        public function __construct() {
            $this->mascota = new mascota();

        }

        public function index() {
            $resultado = $this->mascota->listar();
            return $resultado;

        }

        public function crear($nombre, $fechaNacimiento, $idEspecie, $idRaza, $idCliente) {
            $this->mascota->set('nombre', $nombre);
            $this->mascota->set('fechaNacimiento', $fechaNacimiento);
            $this->mascota->set('idEspecie', $idEspecie);
            $this->mascota->set('idRaza', $idRaza);
            $this->mascota->set('contrasena', $contrasena);
            $this->mascota->set('activado', 1);
            $this->mascota->set('idCliente', $idCliente);

            $resultado = $this->mascota->crear();

            return $resultado;

        }

        public function eliminar($id) {
            $this->mascota->set('id', $id);
            $this->mascota->set('activado', '0');
            $this->mascota->eliminar();

        }

        public function ver($id) {
            $this->mascota->set('id', $id);
            $datos = $this->mascota->ver();

            return $datos;

        }

        public function editar($id, $nombre, $apellido, $identificacion, $correo, $contrasena, $direccion, $telefono, $celular, $pathFoto, $activado) {
            $this->mascota->set('id', $id);
            $this->mascota->set('nombre', $nombre);
            $this->mascota->set('apellido', $apellido);
            $this->mascota->set('identificacion', $identificacion);
            $this->mascota->set('correo', $correo);
            $this->mascota->set('contrasena', $contrasena);
            $this->mascota->set('direccion', $direccion);
            $this->mascota->set('telefono', $telefono);
            $this->mascota->set('celular', $celular);
            $this->mascota->set('pathFoto', $pathFoto);
            $this->mascota->set('activado', $activado);

            $this->mascota->editar();

        }

        public function inicioSesion($usuario, $contrasena) {
            $this->mascota->set('correo', $usuario);
            $this->mascota->set('contrasena', md5($contrasena));

            $resultado = $this->mascota->inicioSesion();

            return $resultado;

        }

        public function cargarMascotas($id) {
            $this->mascota->set('id', $id);
            $resultador = $this->mascota->cargarMascotas();

            return $resultado;

        }

    }
?>
