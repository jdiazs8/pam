<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorExtra();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id'], $_GET['extra']);

        }


        if(isset($_POST['desactivar'])) {
            $controlador->eliminar($_GET['id'], $_GET['extra']);
                header('location: index.php?cargar=opcionExtras');

        }

        $mensaje = '¿Realmente quieres desactivar este item?';

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
