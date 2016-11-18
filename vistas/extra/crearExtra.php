<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorExtra();

        if(isset($_POST['guardar'])) {
            if(empty($_POST['nombre'])){
                $mensaje = 'Lo campos marcados con * deben estar diligenciados';
            }else {
                if(!isset($_POST['asociado'])) {
                  $_POST['asociado'] = '';
                }

                $resultado = $controlador->crear($_POST['nombre'], $_GET['extra'], $_POST['asociado']);

                if($resultado) {
                    header('location: index.php?cargar=opcionExtras');
                }else {
                    $mensaje = 'Ocurrió un error al momento de registrar tu mascota, por favor intenta de nuevo.';
                }
            }
        }
    }else {
        header('location: index.php');
    }

    switch ($_GET['extra']) {
      case 1:
      ?>
      <section>
      <form action="" method="post">
        <?php
          if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";
          }

        ?>
        <h2>Registro de usuario</h2>
        <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" required>
        <input type="submit" class="boton" name="guardar" value="Registrar Usuario">
      </form>
      </section>
      <?php
      break;

      case 2:
      ?>
      <section>
      <form action="" method="post">
        <?php
          if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";
          }

          $especies = $controlador->index(3);
        ?>
        <h2>Registro de vacunas</h2>
        <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" required>
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
        <input type="submit" class="boton" name="guardar" value="Registrar Vacuna">
      </form>
    </section>
      <?php
      break;

      case 3:
      ?>
      <section>
      <form action="" method="post">
        <?php
          if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";
          }
        ?>
        <h2>Registro de especies</h2>
        <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" required>
        <input type="submit" class="boton" name="guardar" value="Registrar Especie">
      </form>
    </section>
      <?php
      break;

      case 4:
      ?>
      <section>
      <form action="" method="post">
        <?php
          if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";
          }

          $especies = $controlador->index(3);
        ?>
        <h2>Registro de razas</h2>
        <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" required>
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
        <input type="submit" class="boton" name="guardar" value="Registrar raza">
      </form>
    </section>
      <?php
      break;

    }
 ?>
