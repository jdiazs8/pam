<?php
    if(isset($_SESSION['idCliente'])) {
        $controlador = new ControladorCliente();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id']);

        }

        if(isset($_POST['contrasena']) && isset($_POST['contrasena2'])) {
            if(strcmp($_POST['contrasena'], $_POST['contrasena2'])) {
                $mensaje = 'Las contraseñas deben coincidir.';
            }else{
                if(isset($_POST['actualizar'])) {
                    $controlador->editar($_GET['id'], $_POST['nombre'], $_POST['apellido'], $_POST['identificacion'], $_POST['correo'], $_POST['contrasena'], $_POST['direccion'], $_POST['telefono'], $_POST['celular'], $_POST['pathFoto'], '1');
                    header('location: index.php?cargar=vercliente&id='.$row['id_cliente']);

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
    <input type="text" name="nombre" maxlength="29" placeholder="Nombre" value="<?php echo $row['nombre_cliente'] ?>" required>
    <br>
    <input type="text" name="apellido" maxlength="29" placeholder="Apellido" value="<?php echo $row['apellido_cliente'] ?>" required>
    <br>
    <input type="text" name="identificacion" maxlength="10" placeholder="identificacion" value="<?php echo $row['identificacion_cliente'] ?>" required>
    <br>
    <input type="email" name="correo" maxlength="99" placeholder="Correo electrónico" value="<?php echo $row['correo_cliente'] ?>" required>
    <br>
    <input type="password" name="contrasena" maxlength="49" placeholder="Contraseña" required>
    <br>
    <input type="password" name="contrasena2" maxlength="49" placeholder="Contraseña" required>
    <br>
    <input type="text" name="direccion" maxlength="99" placeholder="Direccion de residencia" value="<?php echo $row['direccion_cliente'] ?>" >
    <br>
    <input type="text" name="telefono" maxlength="10" placeholder="No.teléfono fijo" value="<?php echo $row['telefono_cliente'] ?>" >
    <br>
    <input type="text" name="celular" maxlength="10" placeholder="No. celular" value="<?php echo $row['celular_cliente'] ?>" >
    <br>
    <input type="text" name="pathFoto" maxlength="10" placeholder="Direccion foto" value="<?php echo $row['path_foto_cliente'] ?>" >
    <br>
    <input type="submit" class="boton" name="actualizar" value="Actualizar">
</form>
