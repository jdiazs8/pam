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

        public function crear($nombre, $extra, $asociado) {
            $this->extra->set('nombre', $nombre);
            $this->extra->set('asociado', $asociado);

            $resultado = $this->extra->crear($extra);

            return $resultado;
        }

        public function eliminar($id, $extra) {
            $this->extra->set('id', $id);
            $this->extra->set('activado', '0');
            $this->extra->eliminar($extra);

        }

        public function ver($id, $item) {
            $this->extra->set('id', $id);
            $datos = $this->extra->ver($item);

            return $datos;

        }

        public function editar($nombre, $asociado, $id, $extra, $activado) {
            $this->extra->set('id', $id);
            $this->extra->set('nombre', $nombre);
            $this->extra->set('apellido', $asociado);
            $this->extra->set('activado', $activado);

            $this->extra->editar($extra);
        }

        public function contacto($nombre, $correo, $tema, $mensaje, $id) {
          $resultado = $this->extra->contacto($nombre, $correo, $tema, $mensaje, $id);

          return $resultado;
        }

        public function verMensajes() {
          $resultado = $this->extra->verMensajes();

          return $resultado;
        }

        public function contestarMensaje($id, $estado) {
          $this->extra->contestarMensaje($id, $estado);
        }
    }
?>
