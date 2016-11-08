<?php
    if(isset($_SESSION['idVeterinario']) || isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorVeterinaria();
        if(isset($_SESSION['id'])) {
            $row = $controlador->ver($_GET['id']);
            $resultado = $controlador->verComentario($_GET['id']);
        }
    }else {
        header('location: index.php');
    }
?>
<center>
    <br>
    <h2>Vacunas</h2>
    <br>
    <br>
    <hr>
    <table class="formulario">
        <?php
            if(mysqli_num_rows($resultado) != 0) {
              while($row2 = mysqli_fetch_assoc($resultado)){
        ?>
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
                      <td><?php $row2['dosis_rvacuna'] ?></td>
                  </tr>
            </table>
            <hr>
                <?php
                }
            }else {
              $mensaje = 'Actualmente tu veterinario no tiene comentarios.';
            }
        ?>
        <?php
            if(!empty($mensaje)) {
                echo "<p class='mensaje'>". $mensaje ."</p>";

            }

        ?>
</center>
