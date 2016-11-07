<!DOCTYPE html>

<html lang="es">
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  </head>

  <body>
    <?php
      if($_POST['especie']) {
          $conexion = mysqli_connect('localhost', 'root', '', 'db_pam');
          $especie = $_POST['especie'];
          $sql = "SELECT * FROM tb_razas WHERE id_especie = '{$especie}'";
          $resultado = mysqli_query($conexion, $sql);

          while($row = mysqli_fetch_assoc($resultado)) {
            echo '<option value="'.$row['id_raza'].'">'.utf8_encode($row['nombre_raza']).'</option>'."\n";
          }
        }
    ?>
  </body>
</html>
