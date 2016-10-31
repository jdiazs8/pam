<?php
    class Enrutador {
        public function cargarVista($vista) {
            switch($vista) {
                case 'inicio':
                    include_once('vistas/'.$vista.'.php');
                    break;
                    
                case 'crearcliente':
                    include_once('vistas/'.$vista.'.php');
                    break;
                    
                case 'vercliente':
                    include_once('vistas/'.$vista.'.php');
                    break;
                    
                case 'iniciosesion':
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