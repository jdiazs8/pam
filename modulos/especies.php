<!DOCTYPE html>

<html lang="es">
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  </head>

  <body>
    <?php
      $conexion = mysqli_connect('localhost', 'root', '', 'db_pam');
      $sql = "SELECT * FROM tb_especies";
      $resultado = mysqli_query($conexion, $sql);

      echo '<option value="0">Mi mascota es...*</option>';
      while($row = mysqli_fetch_assoc($resultado)) {
        echo '<option value="'.$row['id_especie'].'">'.utf8_encode($row['nombre_especie']).'</option>'."\n";
      }
    ?>
  </body>
</html>
