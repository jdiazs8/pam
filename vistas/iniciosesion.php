<?php
    if(isset($_POST['iniciosesion'])) {
        if($_POST['perfil'] == 2) {
          $controlador = new ControladorCliente();

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
                      $mascotas = $controlador->misMascotas($_SESSION['id']);
                      $num = mysqli_num_rows($mascotas);

                      if($num != 0){
                          header('location: index.php');
                      }else {
                          header('location: index.php?cargar=sinMascotas');
                      }
                  }
            }else {
                $mensaje = 'Alguno de los datos ingresados no coincide o, no es un usuario registrado.';
            }
        }
    }else if($_POST['perfil'] == 3) {
      $controlador = new ControladorVeterinario();

      if(empty($_POST['usuario']) || empty($_POST['contrasena'])){
          $mensaje = 'Lo campos marcados con * deben estar diligenciados';
      }else {
          $resultado = $controlador->inicioSesion($_POST['usuario'], $_POST['contrasena']);

          if($resultado) {
              $_SESSION['idVeterinario'] = $resultado['id_usuario'];
              $_SESSION['id'] = $resultado['id_veterinario'];
              $_SESSION['activado'] = $resultado['activado_veterinario'];
              if($_SESSION['activado'] == '0') {
                  header('location: index.php?cargar=desactivado');
              }else {
                  header('location: index.php');
              }
          }else {
              $mensaje = 'Alguno de los datos ingresados no coincide o, no es un usuario registrado.';
          }
      }
    }

    if(!empty($mensaje)) {
        echo "<p class=\"mensaje\">". $mensaje ."</p>";

    }
  }

?>

<form action="#" method="post">
    <center><h2>Inicio de Sesión</h2></center>
    <br>
    <br>
    <br>
    <br>
    <select name="perfil">
        <option value="2">Dueño de mascotas</option>
        <option value="3">veterinario</option>
    </select>
    <input type="text" name="usuario" placeholder="Correo Electrónico*" required>
    <input type="password" name="contrasena" placeholder="Contraseña*" required>
    <br>
    <br>
    <br>
    <input type="submit" class="boton" name="iniciosesion" value="Iniciar Sesión">
</form>
