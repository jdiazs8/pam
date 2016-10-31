<?php
    $controlador = new ControladorCliente();
    
    if(isset($_POST['contrasena']) && isset($_POST['contrasena2'])) {
        if(strcmp($_POST['contrasena'], $_POST['contrasena2'])) {
            $mensaje = 'Las contraseñas deben coincidir.';
        }else{
            if(isset($_POST['guardar'])) {
                $resultado = $controlador->crear($_POST['nombre'], $_POST['apellido'], $_POST['identificacion'], $_POST['correo'], $_POST['contrasena']);

                if($resultado) {
                    $mensaje = 'Se ha registrado como usuario.';
                    echo "<a href='?cargar=iniciosesion'>Iniciar Sesión</a>";

                }else {
                    $mensaje = 'Alguno de los datos ingresados ya está registrado.';
                }

            }
        }   
    }
?>

<section>
    <?php
        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";
            
        }
    
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <h2>Registro de usuario</h2>
        <input type="text" name="nombre" maxlength="29" placeholder="Nombre" required>
        <br>
        <input type="text" name="apellido" maxlength="29" placeholder="Apellido" required>
        <br>
        <input type="text" name="identificacion" maxlength="10" placeholder="identificacion" required>
        <br>
        <input type="email" name="correo" maxlength="99" placeholder="Correo electrónico" required>
        <br>
        <input type="password" name="contrasena" maxlength="49" placeholder="Contraseña" required>
        <br>
        <input type="password" name="contrasena2" maxlength="49" placeholder="Contraseña" required>
        <br>
        <input type="submit" name="guardar" value="Registrarme">
        <?php
            if(isset($_SESSION['idCliente'])){
                ?>    
                <?php
            }
        ?>
    </form>
</section>
