<?php
    if(isset($_SESSION['idCliente'])){
        $controlador = new ControladorMascota();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id']);
        }

        if(isset($_POST['guardar'])) {
            if(empty($_POST['nombre']) || empty($_POST['fechaNacimiento']) || empty($_POST['especie']) || empty($_POST['raza'])){
                $mensaje = 'Lo campos marcados con * deben estar diligenciados';
            }else {
                $archivo = $_FILES["foto"]['name'];

                if($archivo != "") {
                    $ruta = "usuarios/clientes/{$_SESSION['id']}/imagenes/mascotas/{$_GET['id']}/{$_GET['id']}.jpg";
                    if(copy($_FILES['foto']['tmp_name'], $ruta)) {
                        $estatus = 'ok';
                    }

                }else {
                    $ruta = $row['path_foto_mascota'];
                }

                $archivo2 = $_FILES["vacunas"]['name'];

                if($archivo2 != "") {
                    $ruta2 = "usuarios/clientes/{$_SESSION['id']}/imagenes/mascotas/{$_GET['id']}/vacunas{$_GET['id']}.jpg";
                    if(copy($_FILES['vacunas']['tmp_name'], $ruta2)) {
                        $estatus = 'ok';
                    }

                }else {
                    $ruta2 = $row['path_foto_mascota'];
                }

                $controlador->editar($_GET['id'], $_POST['nombre'], $_POST['identificacion'], $_POST['fechaNacimiento'], $_POST['direccion'], $ruta, $ruta2, $_SESSION['id'], $_POST['especie'], $_POST['raza']);
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
    <select name="especie" id="especie" required>
        <option value="<?php echo $row['id_especie'] ?>"><?php echo $row['nombre_especie'] ?></option>
    </select>
    <br>
    <select name="raza" id="raza" required>
        <option value="<?php echo $row['id_raza'] ?>"><?php echo $row['nombre_raza'] ?></option>
    </select>
    <label>Foto</foto>
    <input type="file" name="foto">
    <label>Foto Vacunas</label>
    <input type="file" name="vacunas">
    <input type="submit" class="boton" name="guardar" value="Registrar mascota">
</form>
