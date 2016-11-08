<?php
    $controlador = new ControladorAdmin();

    if(isset($_POST['contrasena']) && isset($_POST['contrasena2'])) {
        if(strcmp($_POST['contrasena'], $_POST['contrasena2'])) {
            $mensaje = 'Las contraseñas deben coincidir.';
        }else{
            if(isset($_POST['guardar'])) {
                if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['contrasena2'] || empty($_POST['acuerdo']))){
                    $mensaje = 'Lo campos marcados con * deben estar diligenciados';
                }else {
                    $resultado = $controlador->crear($_POST['nombre'], $_POST['correo'], $_POST['contrasena']);

                    if($resultado) {
                        $mensaje = 'Se ha registrado un nuevo administrador.';
                        echo "<center>";
                          echo "<table class='formulario'>";
                            echo "<tr>";
                              echo "<td><a href='?cargar=verAdmins'>Listado de Administradores</a></td>";
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

<form action="" method="post">
    <?php
        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";

        }

    ?>
    <h2>Registro de usuario</h2>
    <input type="text" name="nombre" maxlength="29" placeholder="Nombre*" required>
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
            <td><a href="#">Acepto los términos y con...*</a></td>
        </tr>
    </table>
    <br>
    <input type="submit" class="boton" name="guardar" value="Registrarme">
</form>
