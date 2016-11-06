<?php
    include_once('clases/mascota.php');

    class ControladorMascota {
        private $mascota;

        public function __construct() {
            $this->mascota = new Mascota();

        }

        public function index() {
            $resultado = $this->mascota->listar();
            return $resultado;

        }

        public function crear($nombre, $fechaNacimiento, $idCliente, $idEspecie, $idRaza) {
            $this->mascota->set('nombre', $nombre);
            $this->mascota->set('fechaNacimiento', $fechaNacimiento);
            $this->mascota->set('activado', 1);
            $this->mascota->set('idCliente', $idCliente);
            $this->mascota->set('idEspecie', $idEspecie);
            $this->mascota->set('idRaza', $idRaza);

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

        public function editar($id, $nombre, $identificacion, $fechaNacimiento, $direccion, $pathFoto, $estFoto, $pathVacuna, $estVacuna, $idCliente, $idEspecie, $idRaza, $idVeterinario) {
            $this->mascota->set('id', $id);
            $this->mascota->set('nombre', $nombre);
            $this->mascota->set('identificacion', $identificacion);
            $this->mascota->set('fechaNacimiento', $fechaNacimiento);
            $this->mascota->set('direccion', $direccion);
            $this->mascota->set('pathFoto', $pathFoto);
            $this->mascota->set('pathVacuna', $pathVacuna);
            $this->mascota->set('idCliente', $idCliente);
            $this->mascota->set('idEspecie', $idEspecie);
            $this->mascota->set('idRaza', $idRaza);
            $this->mascota->set('activado', '1');
            $this->mascota->set('idVeterinario', $idVeterinario);

            $this->mascota->editar($estFoto, $estVacuna);

        }

        public function verHistorial($id) {
            $this->mascota->set('id', $id);

            $resultado = $this->mascota->verHistorial();

            return $resultado;

        }

        public function verVacunas($id) {
          $this->mascota->set('id', $id);

          $resultado = $this->mascota->verVacunas();

          return $resultado;
        }

        public function misMascotas($id) {
            $this->mascota->set('idCliente', $id);
            $resultado = $this->mascota->misMascotas();
            return $resultado;
        }
    }
?>
