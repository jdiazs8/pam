<?php
    if(isset($_SESSION['idCliente']) || isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorCliente();
        if(isset($_SESSION['id'])) {
            $row = $controlador->ver($_GET['id']);

        }

        if(isset($_POST['contrasena']) && isset($_POST['contrasena2'])) {
            if(strcmp($_POST['contrasena'], $_POST['contrasena2'])) {
                $mensaje = 'Las contraseñas deben coincidir.';
            }else{
                if(isset($_POST['actualizar'])) {
                    if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['identificacion']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['contrasena2'])){
                        $mensaje = 'Lo campos marcados con * deben estar diligenciados';
                    }else {
                        $controlador->editar($_GET['id'], $_POST['nombre'], $_POST['apellido'], $_POST['identificacion'], $_POST['correo'], $_POST['contrasena'], $_POST['direccion'], $_POST['telefono'], $_POST['celular'], $_FILES['foto']['name'], $_FILES['foto']['tmp_name'], $_POST['activado']);
                        header('location: index.php?cargar=verCliente&id='.$row['id_cliente']);
                    }
                }
            }

        }else {
            $mensaje = 'Recuerde reingresar la contraseña y estas deben coincidir';

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
    <h2>Actualizar Datos Cliente</h2>
    <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" value="<?php echo $row['nombre_cliente'] ?>" required>
    <br>
    <input type="text" name="apellido" maxlength="29" placeholder="Apellido*" value="<?php echo $row['apellido_cliente'] ?>" required>
    <br>
    <input type="text" name="identificacion" maxlength="10" placeholder="identificacion*" value="<?php echo $row['identificacion_cliente'] ?>" required>
    <br>
    <input type="email" name="correo" maxlength="99" placeholder="Correo electrónico" value="<?php echo $row['correo_cliente'] ?>" required>
    <br>
    <input type="text" name="direccion" maxlength="99" placeholder="Direccion de residencia" value="<?php echo $row['direccion_cliente'] ?>" >
    <br>
    <input type="text" name="telefono" maxlength="10" placeholder="No.teléfono fijo" value="<?php echo $row['telefono_cliente'] ?>" >
    <br>
    <input type="text" name="celular" maxlength="10" placeholder="No. celular" value="<?php echo $row['celular_cliente'] ?>" >
    <br>
    <label>Foto</label>
    <input type="file" name="foto" >
    <br>
    <?php
      if(isset($_SESSION['idAdmin'])){
    ?>
    <input type="text" name="activado" placeholder="Activado*" value="<?php echo $row['activado_cliente'] ?>" required>
    <?php
      }
    ?>
    <input type="password" name="contrasena" maxlength="49" placeholder="Contraseña*" required>
    <br>
    <input type="password" name="contrasena2" maxlength="49" placeholder="Contraseña*" required>
    <br>
    <input type="submit" class="boton" name="actualizar" value="Actualizar">
</form>
