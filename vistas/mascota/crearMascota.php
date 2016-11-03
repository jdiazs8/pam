<?php
    $controlador = new ControladorMascota();

            if(isset($_POST['guardar'])) {
                if(empty($_POST['nombre']) || empty($_POST['fechaNacimiento']) || empty($_POST['especie']) || empty($_POST['raza'])){
                    $mensaje = 'Lo campos marcados con * deben estar diligenciados';
                }else {
                    /*$archivo = $_FILES["foto"]['name'];

                    if($archivo != "") {
                        $ruta = "usuarios/clientes/{$_SESSION['id']}/imagenes/mascotas/{$_POST['nombre']}.jpg";
                        if(copy($_FILES['foto']['tmp_name'], $ruta)) {
                            $estatus = 'ok';
                        }

                    }else {
                        $ruta = $row['path_foto_mascota'];
                    }*/

                    /*$archivo2 = $_FILES["vacunas"]['name'];
                    /*
                    if($archivo2 != "") {
                        $ruta2 = "usuarios/clientes/{$_SESSION['id']}/imagenes/mascotas/vacunas{$_POST['nombre']}.jpg";
                        if(copy($_FILES['vacunas']['tmp_name'], $ruta2)) {
                            $estatus = 'ok';
                        }

                    }else {
                        $ruta2 = $row['path_foto_mascota'];
                    }*/

                    $resultado = $controlador->crear($_POST['nombre'], $_POST['fechaNacimiento'], $_SESSION['id'], $_POST['especie'], $_POST['raza']);

                    if($resultado) {
                        $mensaje = 'Se ha registrado tu mascota.';
                    }
                }
            }

?>


<form action="" method="post">
    <?php
        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";

        }

    ?>
    <h2>Registro de usuario</h2>
    <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" required>
    <br>
    <label>Fecha nacimiento o adopción</label>
    <br>
    <input type="date" name="fechaNacimiento" required>
    <br>
    <select name="especie" id="especie" required>
        <option value="1">Mi mascota es...*</option>
    </select>
    <br>
    <select name="raza" id="raza" required>
        <option value="1">Y es de raza...*</option>
    </select>
    <input type="submit" class="boton" name="guardar" value="Registrar mascota">
</form>
