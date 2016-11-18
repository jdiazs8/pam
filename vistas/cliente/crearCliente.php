<?php
    $controlador = new ControladorCliente();

    if(isset($_POST['contrasena']) && isset($_POST['contrasena2'])) {
        if(strcmp($_POST['contrasena'], $_POST['contrasena2'])) {
            $mensaje = 'Las contraseñas deben coincidir.';
        }else{
            if(isset($_POST['guardar'])) {
                if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['identificacion']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['contrasena2'] || empty($_POST['acuerdo']))){
                    $mensaje = 'Lo campos marcados con * deben estar diligenciados';
                }else {
                    $resultado = $controlador->crear($_POST['nombre'], $_POST['apellido'], $_POST['identificacion'], $_POST['correo'], $_POST['contrasena']);

                    if($resultado) {
                        $mensaje = 'Se ha registrado como usuario.';
                        echo "<center>";
                          echo "<table class='formulario'>";
                            echo "<tr>";
                              echo "<td><a href='?cargar=inicioSesion'>Iniciar Sesión</a></td>";
                            echo "</tr>";
                          echo "</table>";
                        echo "</center>";

                    }else {
                        $mensaje = 'Alguno de los datos ingresados ya está registrado.';
                    }
                }
            }
        }
    }
?>
<section>
<form action="" method="post" enctype="multipart/form-data">
    <?php
        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";

        }

    ?>
    <h2>Registro de usuario</h2>
    <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" required>
    <br>
    <input type="text" name="apellido" maxlength="29" placeholder="Apellido*" required>
    <br>
    <input type="text" name="identificacion" maxlength="10" placeholder="identificacion*" required>
    <br>
    <input type="email" name="correo" maxlength="99" placeholder="Correo electrónico*" required>
    <br>
    <input type="password" name="contrasena" maxlength="49" placeholder="Contraseña*" required>
    <br>
    <input type="password" name="contrasena2" maxlength="49" placeholder="Contraseña*" required>
    <br>
    <table>
        <tr>
            <td><input type="checkbox" class="check" name="acuerdo" required></td>
            <td><a href="?cargar=terminos&target="popup" onClick="window.open(this.href, this.target, 'width=350,height=420'); return false;">Acepto los términos y con...*</a></td>
        </tr>
    </table>
    <br>
    <input type="submit" class="boton" name="guardar" value="Registrarme">
</form>
</section>
