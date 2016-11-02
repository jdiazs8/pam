<?php
    $controlador = new ControladorCliente();

    if(isset($_POST['iniciosesion'])) {
        $resultado = $controlador->inicioSesion($_POST['usuario'], $_POST['contrasena']);

        if($resultado) {
            echo "paso 1<br>";
            $_SESSION['idCliente'] = $resultado['id_usuario'];
            $_SESSION['id'] = $resultado['id_cliente'];
            header('location: index.php');

        }else {
            $mensaje = 'Alguno de los datos ingresados no coincide o, no es un usuario registrado.';
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
    <input type="text" name="usuario" placeholder="Correo Electrónico" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <br>
    <br>
    <br>
    <input type="submit" class="boton" name="iniciosesion" value="Iniciar Sesión">
</form>
