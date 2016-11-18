<?php
    if(isset($_SESSION['idCliente']) || isset($_SESSION['idAdmin']) || isset($_SESSION['idVeterinario'])) {
        $controlador = new ControladorMascota();
        if(isset($_SESSION['id'])) {
            $row = $controlador->ver($_GET['id']);
            $resultado = $controlador->verVacunas($_GET['id']);
        }
    }else {
        header('location: index.php');
    }
?>
<section>
<center>
    <br>
    <h2>Vacunas</h2>
    <br>
    <table class="formulario">
        <tr>
            <td><a href="javascript:window.close();">Cerrar</a></td>
            <?php
                if(isset($_SESSION['idVeterinario']) || isset($_SESSION['idAdmin'])) {
            ?>
                  <td><a href="?cargar=ingresarVacuna&id=<?php echo $_GET['id']; ?>&especie=<?php echo $_GET['especie'] ?>">Ingresar Vacuna</a></td>
            <?php
                }
            ?>
        </tr>
    </table>
    <br>
    <div class="redondo">
        <img class="vacuna" src="<?php echo $row['path_foto_cvacunas']; ?>" />
    </div>
    <br>
    <hr>
    <?php
        if(mysqli_num_rows($resultado) != 0) {
          while($row2 = mysqli_fetch_assoc($resultado)){
    ?>
    <table class="formulario">

                  <tr>
                      <td><b>Laboratorio:</b></td>
                      <td><?php echo $row2['laboratorio_rvacuna'] ?></td>
                  </tr>
                  <tr>
                      <td><b>Cepa:</b></td>
                      <td><?php echo $row2['cepa_rvacuna'] ?></td>
                  </tr>
                  <tr>
                      <td><b>Lote:</b></td>
                      <td><?php echo $row2['lote_rvacuna'] ?></td>
                  </tr>
                  <tr>
                      <td><b>Fecha de expiración:</b></td>
                      <td><?php echo $row2['fecha_exp_rvacuna'] ?></td>
                  </tr>
                  <tr>
                      <td><b>Fecha de aplicación:</b></td>
                      <td><?php echo $row2['fecha_apli_rvacuna'] ?></td>
                  </tr>
                  <tr>
                      <td><b>No. de dosis:</b></td>
                      <td><?php echo $row2['dosis_rvacuna'] ?></td>
                  </tr>
            </table>
            <hr>
                <?php
                }
                echo "<br><br>";
            }else {
              $mensaje = 'Actualmente tu mascota no cuenta con un historial de vacunas.';
            }
        ?>
        <?php
            if(!empty($mensaje)) {
                echo "<p class='mensaje'>". $mensaje ."</p>";

            }

        ?>
</center>
</section>
