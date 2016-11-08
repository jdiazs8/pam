<?php
    if(isset($_SESSION['idVeterinario']) || isset($_SESSION['idAdmin'])){
        $controlador = new ControladorVeterinaria();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id']);
        }

        if(isset($_POST['guardar'])) {
            if(empty($_POST['nombre']) || empty($_POST['nit']) || empty($_POST['direccion']) || empty($_POST['celular'])){
                $mensaje = 'Lo campos marcados con * deben estar diligenciados';
            }else {
                if(!isset($_SESSION['idAdmin'])){
                  $_POST['activado'] = 1;
                }
                $controlador->editar($_GET['id'], $_POST['nombre'], $_POST['nit'], $_POST['direccion'], $_POST['telefono'], $_POST['celular'], $_FILES["foto"]['name'], $_FILES["foto"]['tmp_name'], $_SESSION['id'], $_POST['activado']);
                header('location: index.php?cargar=misVeterinarias&id='.$_SESSION['id']);
            }
        }

    }else {
        header('location: index.php');
    }



?>

<form action="" method="post" enctype="multipart/form-data">
    <?php
        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";

        }

    ?>

    <h2>Actualizar de veterinaria</h2>
    <input type="text" name="nombre" maxlength="50" placeholder="Nombre*" value="<?php echo $row['nombre_veterinaria'] ?>" required>
    <br>
    <input type="text" name="nit" maxlength="14" placeholder="NIT*" value="<?php echo $row['nit_veterinaria'] ?>" required>
    <br>
    <input type="text" name="direccion" maxlength="99" placeholder="Dirección*" value="<?php echo $row['direccion_veterinaria'] ?>" required>
    <br>
    <input type="number" name="telefono" maxlength="10" placeholder="No. Teléfono*" value="<?php echo $row['telefono_veterinaria'] ?>">
    <br>
    <input type="number" name="celular" maxlength="10" placeholder="No. Celular*" value="<?php echo $row['celular_veterinaria'] ?>" required>
    <br>
    <?php
      if(isset($_SESSION['idAdmin'])){
    ?>
    <input type="text" name="activado"  placeholder="Activado*" value="<?php echo $row['activado_veterinaria'] ?>" required>
    <?php
      }
    ?>
    <label>Foto</foto>
    <input type="file" name="foto">
    <input type="submit" class="boton" name="guardar" value="Actualizar veterinaria">
</form>
