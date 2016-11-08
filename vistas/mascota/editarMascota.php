<?php
    if(isset($_SESSION['idCliente']) || isset($_SESSION['idAdmin'])){
        $controlador = new ControladorMascota();
        $controlador2 = new ControladorVeterinario();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id']);
            $resultado = $controlador2->index();
        }

        if(isset($_POST['guardar'])) {
            if(empty($_POST['nombre']) || empty($_POST['fechaNacimiento']) || empty($_POST['raza'])){
                $mensaje = 'Lo campos marcados con * deben estar diligenciados';
            }else {
                if($_POST['especie'] == 0){
                  $_POST['especie'] = $row['id_especie'];
                }
                $controlador->editar($_GET['id'], $_POST['nombre'], $_POST['identificacion'], $_POST['fechaNacimiento'], $_POST['direccion'], $_FILES["foto"]['name'], $_FILES["foto"]['tmp_name'], $_FILES["vacunas"]['name'], $_FILES["vacunas"]['tmp_name'], $_SESSION['id'], $_POST['especie'], $_POST['raza'], $_POST['idVeterinario'], $_POST['activado']);
                header('location: index.php?cargar=misMascotas&id='.$_SESSION['id']);
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
    <h2>Actualizar Mascota</h2>
    <input type="text" name="nombre" maxlength="50" placeholder="Nombre*" value="<?php echo $row['nombre_mascota'] ?>" required>
    <br>
    <input type="text" name="identificacion" maxlength="19" placeholder="Identificación" value="<?php echo $row['identificacion_mascota'] ?>">
    <br>
    <label>Fecha nacimiento o adopción*</label>
    <br>
    <input type="date" name="fechaNacimiento" value="<?php echo $row['fecha_nacimiento_mascota'] ?>" required>
    <br>
    <input type="text" name="direccion" maxlength="99" placeholder="Dirección" value="<?php echo $row['direccion_mascota'] ?>">
    <br>
    <label>Mi mascota es...</label><br>
    <select name="especie" id="especies" required>
        <option value="<?php echo $row['id_especie'] ?>"><?php echo $row['nombre_especie'] ?></option>
    </select>
    <br>
    <label>Y es de raza...</label>
    <select name="raza" id="razas" required>
        <option value="<?php echo $row['id_raza'] ?>"><?php echo $row['nombre_raza'] ?></option>
    </select>
    <label>Mi veterinario es: <?php echo $row['nombre_veterinario'].' '.$row['apellido_veterinario'] ?></label><br>
    <label>Cambiar a:</label>
    <select name="idVeterinario" id="veterinario" required>
        <?php
          while($row2 = mysqli_fetch_assoc($resultado)) {
        ?>
        <option value="<?php echo $row2['id_veterinario']; ?>"><?php echo $row2['nombre_veterinario'].' '.$row2['apellido_veterinario']; ?></option>
        <?php
          }
        ?>
    </select>
    <label>Foto</foto>
    <input type="file" name="foto">
    <label>Foto Vacunas</label>
    <input type="file" name="vacunas">
    <?php
      if(isset($_SESSION['idAdmin'])){
    ?>
    <input type="text" name="activado"  placeholder="Activado*" value="<?php echo $row['activado_mascota'] ?>" required>
    <?php
      }
    ?>
    <input type="submit" class="boton" name="guardar" value="Actualizar mascota">
</form>
