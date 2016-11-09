<?php
  $controlador = new ControladorExtra();
  if(isset($_POST['enviar'])){
    if(!isset($_GET['id'])) {
      $_GET['id'] = 4;
    }

    $resultado = $controlador->contacto($_POST['nombre'], $_POST['correo'], $_POST['tema'], $_POST['mensaje'], $_GET['id']);
    if($resultado) {
        $mensaje = 'El mensaje ha sido enviado';
    }else {
      $mensaje = 'Ocurrió un problema al momento de enviar tu mensaje, ¡intenta de nuevo!';
    }

  }
?>

<form action="" method="post">
  <?php
      if(!empty($mensaje)) {
          echo "<p class='mensaje'>". $mensaje ."</p>";
      }
  ?>
  <input type="text" name="nombre" placeholder="Contacto*" maxlength="99" required>
  <br>
  <input type="email" name="correo" placeholder="Correo*" maxlength="99" required>
  <br>
  <input type="text" name="tema" placeholder="Tema*" maxlength="49" required>
  <br>
  <textarea name="mensaje" placeholder="Mensaje*" maxlength="999" required></textarea>
  <input type="submit" class="boton" name="enviar" value="Enviar">
</form>
