<form action="" method="post" enctype="multipart/form-data">
    <?php
        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";

        }

    ?>
    <h2>Registro de usuario</h2>
    <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" required>
    <br>
    <input type="text" name="identificacion" maxlength="19" placeholder="identificacion">
    <br>
    <label>Fecha nacimiento o adopción</label>
    <br>
    <input type="date" name="fechaNacimiento" required>
    <br>
    <input type="text" name="direccion" maxlength="99" placeholder="Dirección">
    <br>
    <label>Foto</label>
    <input type="file" name="foto">
    <br>
    <label>Carné de vacunas</label>
    <input type="file" name="vacunas">
    <br>
    <select name="especie" id="especie">
        <option value="0">Mi mascota es...</option>
    </select>
    <br>
    <select name="raza" id="raza">
        <option value="0">Y es de raza...</option>
    </select>
    <input type="submit" class="boton" name="guardar" value="Registrar mascota">
</form>
