<?php
    session_start();
    include_once('modulos/enrutador.php');
    include_once('modulos/controladorCliente.php');
    include_once('modulos/controladorMascota.php');
    include_once('modulos/controladorVeterinario.php');
    include_once('modulos/controladorVeterinaria.php');
    include_once('modulos/controladorExtra.php');
    include_once('modulos/controladorAdmin.php');

    if(!isset($_GET['cargar'])) {
        $_GET['cargar'] = 'inicio';
    }
?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/fonts.css">
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="js/main.js"></script>
        <link rel="stylesheet" href="css/flexslider.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="js/jquery.flexslider.js"></script>
        <script src="js/function.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(window).load(function() {
                $('.flexslider').flexslider();
            });
        </script>
        <title>PAM Portal de Apoyo a Mascotas</title>
    </head>

    <body background="imagenes/fondo.png">
        <?php
            if(isset($_SESSION['idCliente'])) {
                include_once('vistas/cabeceraCliente.php');
            }else if(isset($_SESSION['idVeterinario'])) {
                include_once('vistas/cabeceraVeterinario.php');
            }else if(isset($_SESSION['idAdmin'])) {
                include_once('vistas/cabeceraAdmin.php');
            }else {
                include_once('vistas/cabeceraNoRegistro.php');
            }
        ?>
        <section>
            <?php
                $enrutador = new Enrutador();
                if($enrutador->validarGET($_GET['cargar'])) {
                    $enrutador->cargarVista($_GET['cargar']);
                }
            ?>
        </section>


        <?php
              include_once('vistas/piePagina.php');
        ?>
    </body>

</html>
