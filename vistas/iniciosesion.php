<?php
    $controlador = new ControladorCliente();

    if(isset($_POST['iniciosesion'])) {
      if(empty($_POST['usuario']) || empty($_POST['contrasena'])){
          $mensaje = 'Lo campos marcados con * deben estar diligenciados';
      }else {
          $resultado = $controlador->inicioSesion($_POST['usuario'], $_POST['contrasena']);

          if($resultado) {
              $_SESSION['idCliente'] = $resultado['id_usuario'];
              $_SESSION['id'] = $resultado['id_cliente'];
              $_SESSION['activado'] = $resultado['activado_cliente'];
              if($_SESSION['activado'] == '0') {
                  header('location: index.php?cargar=desactivado');
              }else {
                  $mascotas = $controlador->cargarMascotas($_SESSION['id']);

                  if($mascotas){
                      header('location: index.php');
                  }else {
                      header('location: index.php?cargar=sinMascotas');
                  }
              }

          }else {
              $mensaje = 'Alguno de los datos ingresados no coincide o, no es un usuario registrado.';
          }
      }
    }

    if(!empty($mensaje)) {
        echo "<p class=\"mensaje\">". $mensaje ."</p>";

    }

?>

<form action="#" method="post">
    <center><h2>Inicio de Sesión</h2></center>
    <br>
    <br>
    <br>
    <br>
    <br>
    <input type="text" name="usuario" placeholder="Correo Electrónico*" required>
    <input type="password" name="contrasena" placeholder="Contraseña*" required>
    <br>
    <br>
    <br>
    <input type="submit" class="boton" name="iniciosesion" value="Iniciar Sesión">
</form>
