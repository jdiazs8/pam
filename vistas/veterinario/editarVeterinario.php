<?php
    if(isset($_SESSION['idVeterinario'])) {
        $controlador = new ControladorVeterinario();
        if(isset($_SESSION['id'])) {
            $row = $controlador->ver($_SESSION['id']);

        }

        if(isset($_POST['contrasena']) && isset($_POST['contrasena2'])) {
            if(strcmp($_POST['contrasena'], $_POST['contrasena2'])) {
                $mensaje = 'Las contraseñas deben coincidir.';
            }else{
                if(isset($_POST['actualizar'])) {
                    if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['identificacion']) || empty($_POST['tprofesional']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['contrasena2'] || empty($_POST['direccion']) || empty($_POST['celular']) || empty($_POST['acuerdo']))){
                        $mensaje = 'Lo campos marcados con * deben estar diligenciados';
                    }else {
                        $controlador->editar($_SESSION['id'], $_POST['nombre'], $_POST['apellido'], $_POST['identificacion'], $_POST['tprofesional'], $_POST['correo'], $_POST['contrasena'], $_POST['direccion'], $_POST['telefono'], $_POST['celular'], $_FILES['foto']['name'], $_FILES['foto']['tmp_name'], '1');
                        header('location: index.php?cargar=verVeterinario&id='.$row['id_veterinario']);
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
<center>
    <form action="" method="post" enctype="multipart/form-data">
        <?php
            if(!empty($mensaje)) {
                echo "<p class='mensaje'>". $mensaje ."</p>";

            }

        ?>
        <h2>Actualizar Datos Veterinario</h2>
        <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" value="<?php echo $row['nombre_veterinario'] ?>" required>
        <br>
        <input type="text" name="apellido" maxlength="29" placeholder="Apellido*" value="<?php echo $row['apellido_veterinario'] ?>" required>
        <br>
        <input type="text" name="identificacion" maxlength="10" placeholder="identificacion*" value="<?php echo $row['identificacion_veterinario'] ?>" required>
        <br>
        <input type="text" name="tprofesional" maxlength="19" placeholder="No. tarjeta profesional" value="<?php echo $row['tprofesional_veterinario'] ?>">
        <br>
        <input type="email" name="correo" maxlength="99" placeholder="Correo electrónico" value="<?php echo $row['correo_veterinario'] ?>" required>
        <br>
        <input type="text" name="direccion" maxlength="99" placeholder="Direccion de residencia" value="<?php echo $row['direccion_veterinario'] ?>" >
        <br>
        <input type="text" name="telefono" maxlength="10" placeholder="No.teléfono fijo" value="<?php echo $row['telefono_veterinario'] ?>" >
        <br>
        <input type="text" name="celular" maxlength="10" placeholder="No. celular" value="<?php echo $row['celular_veterinario'] ?>" >
        <br>
        <label>Foto</label>
        <input type="file" name="foto" >
        <br>
        <input type="password" name="contrasena" maxlength="49" placeholder="Contraseña*" required>
        <br>
        <input type="password" name="contrasena2" maxlength="49" placeholder="Contraseña*" required>
        <br>
        <input type="submit" class="boton" name="actualizar" value="Actualizar">
    </form>
</center>
