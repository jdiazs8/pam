<?php
    include_once('modulos/enrutador.php');
    include_once('modulos/controladorCliente.php');

    if(!isset($_GET['cargar'])) {
        $_GET['cargar'] = 'inicio';
    }
?>

<!DOCTYPE html>


<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>PAM Portal de Apoyo a Mascotas</title>
    </head>
    
    <body>
       <h1>Página principal</h1>
        <section>
            <?php  
                $enrutador = new Enrutador();
                if($enrutador->validarGET($_GET['cargar'])) {
                    $enrutador->cargarVista($_GET['cargar']);
                    
                }
            ?>
        </section>
        
        <footer>
            Todos los derechos reservados &copy;PAM
        </footer>    
    </body>
    
</html>