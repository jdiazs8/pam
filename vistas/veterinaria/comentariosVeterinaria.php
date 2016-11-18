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
<section>
<center>
    <br>
    <h2>Comentarios</h2>
    <br>
    <table class="formulario">
        <tr>
            <td><a href="javascript:window.close();">Cerrar</a></td>
        </tr>
    </table>
    <br>
    <hr>
    <?php
        if(mysqli_num_rows($resultado) != 0) {
          while($row2 = mysqli_fetch_assoc($resultado)){
    ?>
    <table class="formulario">

                  <tr>
                      <td><b>Fecha:</b></td>
                      <td><?php echo $row2['fecha_comentario_veterinaria'] ?></td>
                  </tr>
                  <tr>
                      <td><b>Comentario:</b></td>
                      <td><?php echo $row2['texto_comentario_veterinaria'] ?></td>
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
</section>
