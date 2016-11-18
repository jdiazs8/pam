<?php
    if(isset($_SESSION['idVeterinario'])) {
        $controlador = new ControladorVeterinario();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id']);

        }


        if(isset($_POST['desactivar'])) {
            $controlador->eliminar($_GET['id']);
            if(isset($_SESSION['idAdmin'])){
                header('location: index.php?cargar=verVeterinarios');
            }else {
                header('location: index.php?cargar=cerrarSesion');
            }

        }

        $mensaje = '¿Realmente quieres desactivar tu cuenta?';

    }else {
        header('location: index.php');
    }
?>

<section>
<form action="" method="post">
    <?php
        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";

        }

    ?>
    <input type="submit" class="boton" name="desactivar" value="Desactivar">
</form>
</section>
