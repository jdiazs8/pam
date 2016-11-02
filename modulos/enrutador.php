<?php
    class Enrutador {
        public function cargarVista($vista) {
            switch($vista) {
                case 'inicio':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'crearCliente':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'verCliente':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'editarCliente':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'desactivarCliente':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'cerrarSesion':
                    include_once('modulos/'.$vista.'.php');
                    break;

                case 'sinMascotas':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'crearMascota':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'inicioSesion':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'fotos':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'desactivado':
                    include_once('vistas/'.$vista.'.php');
                    break;

                case 'contacto':
                    include_once('vistas/'.$vista.'.php');
                    break;

                default:
                    include_once('vistas/error.php');
                    break;

            }

        }

        public function validarGET($variable) {
            if(!isset($variable)) {
                include_once('vistas/inicio.php');
            }else {
                return true;

            }

        }

    }
?>
