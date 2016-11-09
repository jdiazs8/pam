<?php
    if(isset($_SESSION['idAdmin'])) {
        if(isset($_POST['guardar'])){
          $controlador = new ControladorExtra();
          $controlador->contestarMensaje($_POST['id'], $_POST['estado']);
        }

        $controlador = new ControladorExtra();
        $resultado = $controlador->verMensajes();
    }else {
        header('location: index.php');
    }
?>
<center>
    <div>
        <h2>Mensajes</h2>
        <br>
        <br>
        <?php
            while($row = mysqli_fetch_assoc($resultado)){
        ?>
        <br>
        <table class="formulario">
            <tr>
                <td><b>ID:</b></td>
                <td> <?php echo $row['id_contacto']; ?></td>
            </tr>
            <tr>
                <td><b>Fecha:</b></td>
                <td> <?php echo $row['fecha_contacto']; ?></td>
            </tr>
            <tr>
                <td><b>Nombre:</b></td>
                <td> <?php echo $row['nombre_contacto']; ?></td>
            </tr>
            <tr>
                <td><b>Correo:</b></td>
                <td> <?php echo $row['correo_contacto']; ?></td>
            </tr>
            <tr>
                <td><b>Tema:</b></td>
                <td> <?php echo $row['tema_contacto']; ?></td>
            </tr>
            <tr>
                <td><b>Mensaje:</b></td>
                <td> <?php echo $row['mensaje_contacto']; ?></td>
            </tr>
            <tr>
                <td><b>Tipo de usuario:</b></td>
                <td> <?php echo $row['nombre_usuario']; ?></td>
            </tr>
            <?php
              if($row['estado_contacto'] != 1) {
            ?>
            <tr>
              <td colspan="2">
                <form action="" method="post">
                  <input type="hidden" name="id" value="<?php echo $row['id_contacto']; ?>">
                  <select name="estado">
                    <option value="0">Seleccione una opción</option>
                    <option value="1">Mensaje contestado</option>
                  </select>
                  <input type="submit" name="guardar" class="boton" value="Guardar">
                </form>
              </td>
            </tr>
            <?php
              }
            ?>
        </table>
        <br>
    </div>
        <?php
            }
        ?>
</center>
