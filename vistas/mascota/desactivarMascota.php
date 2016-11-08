<?php
    if(isset($_SESSION['idCliente']) || isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorMascota();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id']);

        }


        if(isset($_POST['desactivar'])) {
            $controlador->eliminar($_GET['id']);
            if(isset($_SESSION['idAdmin'])){
                header('location: index.php?cargar=verMascotas');
            }else {
                header('location: index.php?cargar=misMascotas&id='.$_SESSION['id']);
            }

        }

        $mensaje = "¿Realmente quieres eliminar la información de {$row['nombre_mascota']}?";

    }else {
        header('location: index.php');
    }
?>

<form action="" method="post">
    <?php
        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";

        }

    ?>
    <input type="submit" class="boton" name="desactivar" value="Eliminar">
</form>
