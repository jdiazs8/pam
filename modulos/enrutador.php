<?php
    class Enrutador {
        public function cargarVista($vista) {
            switch($vista) {
//-----------------------------------------Inicio-------------------------------
                case 'inicio':
                    include_once('vistas/'.$vista.'.php');
                    break;

//-----------------------------------Cliente------------------------------------
                case 'crearCliente':
                    include_once('vistas/cliente/'.$vista.'.php');
                    break;

                case 'verCliente':
                    include_once('vistas/cliente/'.$vista.'.php');
                    break;

                case 'editarCliente':
                    include_once('vistas/cliente/'.$vista.'.php');
                    break;

                case 'desactivarCliente':
                    include_once('vistas/cliente/'.$vista.'.php');
                    break;
//-----------------------------------Mascota------------------------------------
                case 'crearMascota':
                    include_once('vistas/mascota/'.$vista.'.php');
                    break;

                case 'verMascota':
                    include_once('vistas/mascota/'.$vista.'.php');
                    break;

                case 'editarMascota':
                    include_once('vistas/mascota/'.$vista.'.php');
                    break;

                case 'desactivarMascota':
                    include_once('vistas/mascota/'.$vista.'.php');
                    break;

                case 'sinMascotas':
                    include_once('vistas/mascota/'.$vista.'.php');
                    break;

                case 'misMascotas':
                    include_once('vistas/mascota/'.$vista.'.php');
                    break;

                case 'carnetVacunas':
                    include_once('vistas/mascota/'.$vista.'.php');
                    break;

//-----------------------------------Veterinario--------------------------------
                case 'crearVeterinario':
                    include_once('vistas/veterinario/'.$vista.'.php');
                    break;

                case 'verVeterinario':
                    include_once('vistas/veterinario/'.$vista.'.php');
                    break;

                case 'editarVeterinario':
                    include_once('vistas/veterinario/'.$vista.'.php');
                    break;

                case 'desactivarVeterinario':
                    include_once('vistas/veterinario/'.$vista.'.php');
                    break;

                case 'miConsultorio':
                    include_once('vistas/veterinario/'.$vista.'.php');
                    break;

                case 'ingresarHistorial':
                    include_once('vistas/veterinario/'.$vista.'.php');
                    break;

//-----------------------------------Veterinaria------------------------------------
                case 'crearVeterinaria':
                    include_once('vistas/veterinaria/'.$vista.'.php');
                    break;

                case 'verVeterinaria':
                    include_once('vistas/veterinaria/'.$vista.'.php');
                    break;

                case 'editarVeterinaria':
                    include_once('vistas/veterinaria/'.$vista.'.php');
                    break;

                case 'desactivarVeterinaria':
                    include_once('vistas/veterinaria/'.$vista.'.php');
                    break;

                case 'misVeterinarias':
                    include_once('vistas/veterinaria/'.$vista.'.php');
                    break;

                case 'comentariosveterinaria':
                    include_once('vistas/veterinaria/'.$vista.'.php');
                    break;

//---------------------------------otros----------------------------------------
                case 'cerrarSesion':
                    include_once('modulos/'.$vista.'.php');
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
