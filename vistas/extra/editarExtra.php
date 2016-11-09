<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorExtra();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id'], $_GET['extra']);
        }

        if(isset($_POST['actualizar'])) {
            if(empty($_POST['nombre'])){
                $mensaje = 'Lo campos marcados con * deben estar diligenciados';
            }else {
                $controlador->editar($_POST['nombre'], $_POST['asociado'], $_GET['id'], $_GET['extra'], $_POST['activado']);
                header('location: index.php?cargar=opcionExtras');
            }
        }
    }else {
        header('location: index.php');
    }

    switch ($_GET['extra']) {
      case 1:
        ?>
        <form action="" method="post">
          <?php
            if(!empty($mensaje)) {
              echo "<p class='mensaje'>". $mensaje ."</p>";
            }
          ?>
          <h2>Actualizar Usuario</h2>
          <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" value="<?php echo $row['nombre_usuario'] ?>" required>
          <br>
          <input type="text" name="activado" maxlength="1" placeholder="Activado*" value="<?php echo $row['activado_usuario'] ?>" required>
          <br>
          <input type="submit" class="boton" name="actualizar" value="Actualizar">
        </form>
        <?php
        break;

      case 2:
        ?>
        <form action="" method="post">
          <?php
            if(!empty($mensaje)) {
              echo "<p class='mensaje'>". $mensaje ."</p>";
            }

            $especies = $controlador->index(3);
          ?>
          <h2>Actualizar Vacuna</h2>
          <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" value="<?php echo $row['nombre_vacuna'] ?>" required>
          <br>
          <input type="text" name="activado" maxlength="1" placeholder="Activado*" value="<?php echo $row['activado_vacuna'] ?>" required>
          <br>
          <select name="asociado">
            <option value="0">Seleccionar Especie</option>
            <?php
              while($row = mysqli_fetch_assoc($especies)) {
                ?>
                  <option value="<?php echo $row['id_especie'] ?>"><?php echo $row['nombre_especie'] ?></option>
                <?php
              }
            ?>
          </select>
          <input type="submit" class="boton" name="actualizar" value="Actualizar">
        </form>
        <?php
        break;

      case 3:
        ?>
        <form action="" method="post">
          <?php
            if(!empty($mensaje)) {
              echo "<p class='mensaje'>". $mensaje ."</p>";
            }

          ?>
          <h2>Actualizar Especie</h2>
          <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" value="<?php echo $row['nombre_especie'] ?>" required>
          <br>
          <input type="text" name="activado" maxlength="1" placeholder="Activado*" value="<?php echo $row['activado_especie'] ?>" required>
          <br>
          <input type="submit" class="boton" name="actualizar" value="Actualizar">
        </form>
        <?php
        break;

        case 4:
          ?>
          <form action="" method="post">
            <?php
              if(!empty($mensaje)) {
                echo "<p class='mensaje'>". $mensaje ."</p>";
              }

              $especies = $controlador->index(3);
            ?>
            <h2>Actualizar Raza</h2>
            <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" value="<?php echo $row['nombre_raza'] ?>" required>
            <br>
            <input type="text" name="activado" maxlength="1" placeholder="Activado*" value="<?php echo $row['activado_raza'] ?>" required>
            <br>
            <select name="asociado">
              <option value="0">Seleccionar Especie</option>
              <?php
                while($row = mysqli_fetch_assoc($especies)) {
                  ?>
                    <option value="<?php echo $row['id_especie'] ?>"><?php echo $row['nombre_especie'] ?></option>
                  <?php
                }
              ?>
            </select>
            <input type="submit" class="boton" name="actualizar" value="Actualizar">
          </form>
          <?php
          break;
    }
?>
