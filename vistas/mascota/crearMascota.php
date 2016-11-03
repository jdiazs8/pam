<?php
    if(isset($_SESSION['idCliente'])) {
        $controlador = new ControladorMascota();

        if(isset($_POST['guardar'])) {
            if(empty($_POST['nombre']) || empty($_POST['fechaNacimiento']) || empty($_POST['especie']) || empty($_POST['raza'])){
                $mensaje = 'Lo campos marcados con * deben estar diligenciados';
            }else {
                $resultado = $controlador->crear($_POST['nombre'], $_POST['fechaNacimiento'], $_SESSION['id'], $_POST['especie'], $_POST['raza']);

                if($resultado) {
                    $mensaje = 'Se ha registrado tu mascota.';
                }
            }
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
    <h2>Registro de usuario</h2>
    <input type="text" name="nombre" maxlength="50" placeholder="Nombre*" required>
    <br>
    <label>Fecha nacimiento o adopción*</label>
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
