<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorExtra();
        if(isset($_GET['extra'])) {
            $resultado = $controlador->index($_GET['extra']);
        }
    }else {
        header('location: index.php');
    }

    switch ($_GET['extra']) {
      case 1:
?>
<center>
    <div>
        <h2>Tipos de Usuarios</h2>
        <br>
        <table class="formulario">
            <tr>
              <td><a href="?cargar=crearExtra&extra=<?php echo $_GET['extra'] ?>">Crear</a></td>
            </tr>
        </table>
        <br>
        <?php
            while($row = mysqli_fetch_assoc($resultado)){
        ?>
        <br>
        <table class="formulario">
            <tr>
                <td><b>ID: <?php echo $row['id_usuario']; ?></b></td>
                <td colspan="2"><b>Nombre: <?php echo $row['nombre_usuario']; ?></b></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="?cargar=editarExtra&id=<?php echo $row['id_usuario']; ?>&extra=<?php echo $_GET['extra'] ?>">Actualizar</a></td>
                <td><a href="?cargar=desactivarExtra&id=<?php echo $row['id_usuario']; ?>&extra=<?php echo $_GET['extra'] ?>">Desactivar</td>
            </tr>
        </table>
        <br>
    </div>
        <?php
            }
        ?>
</center>
<?php
      break;

      case 2:
      ?>
          <div>
              <center>
              <h2>Vacunas</h2>
              <br>
              <table class="formulario">
                  <tr>
                    <td><a href="?cargar=crearExtra&extra=<?php echo $_GET['extra'] ?>">Crear</a></td>
                  </tr>
              </table>
              </center>
              <br>
              <?php
                  while($row = mysqli_fetch_assoc($resultado)){
              ?>
              <br>
              <table class="formulario">
                  <tr>
                      <td><b>ID:</b></td>
                      <td><?php echo $row['id_vacuna']; ?></td>
                  </tr>
                  <tr>
                    <td><b>Nombre:</b></td>
                    <td><?php echo $row['nombre_vacuna']; ?></td>
                  </tr>
                  <tr>
                      <td><b>Especie:</b></td>
                      <td><?php echo $row['nombre_especie']; ?></td>
                  </tr>
                  <tr>
                      <td><a href="?cargar=editarExtra&id=<?php echo $row['id_vacuna']; ?>&extra=<?php echo $_GET['extra'] ?>">Actualizar</a></td>
                      <td><a href="?cargar=desactivarExtra&id=<?php echo $row['id_vacuna']; ?>&extra=<?php echo $_GET['extra'] ?>">Desactivar</td>
                  </tr>
              </table>
              <br>
          </div>
      <?php

    }
            break;

        case 3:
        ?>
            <div>
                <center>
                <h2>Especies</h2>
                <br>
                <table class="formulario">
                    <tr>
                      <td><a href="?cargar=crearExtra&extra=<?php echo $_GET['extra'] ?>">Crear</a></td>
                    </tr>
                </table>
                </center>
                <br>
                <?php
                    while($row = mysqli_fetch_assoc($resultado)){
                ?>
                <br>
                <table class="formulario">
                    <tr>
                        <td><b>ID:</b></td>
                        <td><?php echo $row['id_especie']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Nombre:</b></td>
                      <td><?php echo $row['nombre_especie']; ?></td>
                    </tr>
                    <tr>
                        <td><a href="?cargar=editarExtra&id=<?php echo $row['id_especie']; ?>&extra=<?php echo $_GET['extra'] ?>">Actualizar</a></td>
                        <td><a href="?cargar=desactivarExtra&id=<?php echo $row['id_especie']; ?>&extra=<?php echo $_GET['extra'] ?>">Desactivar</td>
                    </tr>
                </table>
                <br>
            </div>
        <?php

      }
              break;

          case 4:
              ?>
                  <div>
                      <center>
                      <h2>Razas</h2>
                      <br>
                      <table class="formulario">
                          <tr>
                            <td><a href="?cargar=crearExtra&extra=<?php echo $_GET['extra'] ?>">Crear</a></td>
                          </tr>
                      </table>
                      </center>
                      <br>
                      <?php
                          while($row = mysqli_fetch_assoc($resultado)){
                      ?>
                      <br>
                      <table class="formulario">
                          <tr>
                              <td><b>ID:</b></td>
                              <td><?php echo $row['id_raza']; ?></td>
                          </tr>
                          <tr>
                            <td><b>Nombre:</b></td>
                            <td><?php echo $row['nombre_raza']; ?></td>
                          </tr>
                          <tr>
                              <td><b>Especie:</b></td>
                              <td><?php echo $row['nombre_especie']; ?></td>
                          </tr>
                          <tr>
                              <td><a href="?cargar=editarExtra&id=<?php echo $row['id_especie']; ?>&extra=<?php echo $_GET['extra'] ?>">Actualizar</a></td>
                              <td><a href="?cargar=desactivarExtra&id=<?php echo $row['id_especie']; ?>&extra=<?php echo $_GET['extra'] ?>">Desactivar</td>
                          </tr>
                      </table>
                      <br>
                  </div>
              <?php

            }
                    break;

  }
?>
