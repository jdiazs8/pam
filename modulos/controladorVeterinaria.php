<?php
    include_once('clases/veterinaria.php');

    class ControladorVeterinaria {
        private $veterinaria;

        public function __construct() {
            $this->veterinaria = new Veterinaria();

        }

        public function index() {
            $resultado = $this->veterinaria->listar();
            return $resultado;

        }

        public function crear($nombre, $nit, $idVeterinario, $direccion, $celular) {
            $this->veterinaria->set('nombre', $nombre);
            $this->veterinaria->set('nit', $nit);
            $this->veterinaria->set('idVeterinario', $idVeterinario);
            $this->veterinaria->set('direccion', $direccion);
            $this->veterinaria->set('celular', $celular);
            $this->veterinaria->set('activado', '1');

            $resultado = $this->veterinaria->crear();

            return $resultado;

        }

        public function eliminar($id) {
            $this->veterinaria->set('id', $id);
            $this->veterinaria->set('activado', '0');
            $this->veterinaria->eliminar();

        }

        public function ver($id) {
            $this->veterinaria->set('id', $id);
            $datos = $this->veterinaria->ver();

            return $datos;

        }

        public function editar($id, $nombre, $nit, $direccion, $telefono, $celular, $pathFoto, $estFoto, $idVeterinario, $activado) {
            $this->veterinaria->set('id', $id);
            $this->veterinaria->set('nombre', $nombre);
            $this->veterinaria->set('nit', $nit);
            $this->veterinaria->set('direccion', $direccion);
            $this->veterinaria->set('telefono', $telefono);
            $this->veterinaria->set('celular', $celular);
            $this->veterinaria->set('pathFoto', $pathFoto);
            $this->veterinaria->set('idVeterinario', $idVeterinario);
            $this->veterinaria->set('activado', $activado);

            $this->veterinaria->editar($estFoto);

        }

        public function verComentario($id) {
          $this->veterinaria->set('id', $id);

          $resultado = $this->veterinaria->verComentario();

          return $resultado;
        }

        public function misVeterinarias($id) {
            $this->veterinaria->set('idVeterinario', $id);
            $resultado = $this->veterinaria->misVeterinarias();
            return $resultado;
        }
    }
?>
