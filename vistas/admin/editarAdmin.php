<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorAdmin();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id']);

        }

        if(isset($_POST['contrasena']) && isset($_POST['contrasena2'])) {
            if(strcmp($_POST['contrasena'], $_POST['contrasena2'])) {
                $mensaje = 'Las contraseñas deben coincidir.';
            }else{
                if(isset($_POST['actualizar'])) {
                    if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['activado'])){
                        $mensaje = 'Lo campos marcados con * deben estar diligenciados';
                    }else {
                        $controlador->editar($_POST['idAdmin'], $_POST['nombre'], $_POST['correo'], $_POST['contrasena'], $_POST['activado']);
                        header('location: index.php?cargar=verAdmins&id='.$row['id_admin']);
                    }
                }
            }

        }else {
            $mensaje = 'Recuerde reingresar las contraseñas y estas deben coincidir';
        }

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
    <h2>Actualizar Datos Admin</h2>
    <input type="hidden" name="idAdmin" value="<?php echo $row['id_admin'] ?>" required>
    <br>
    <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" value="<?php echo $row['nombre_admin'] ?>" required>
    <br>
    <input type="email" name="correo" maxlength="99" placeholder="Correo electrónico*" value="<?php echo $row['correo_admin'] ?>" required>
    <br>
    <input type="text" name="activado" maxlength="1" placeholder="Estado de la cuenta*" value="<?php echo $row['activado_admin'] ?>" required>
    <br>
    <input type="password" name="contrasena" maxlength="49" placeholder="Contraseña*" required>
    <br>
    <input type="password" name="contrasena2" maxlength="49" placeholder="Contraseña*" required>
    <br>
    <input type="submit" class="boton" name="actualizar" value="Actualizar">
</form>
