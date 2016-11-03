<?php
    if(isset($_SESSION['idCliente'])) {
        $controlador = new ControladorMascota();
        if(isset($_SESSION['id'])) {
            $row = $controlador->ver($_GET['id']);
            $row2 = $controlador->verHistorial($_GET['id']);
        }
    }else {
        header('location: index.php');

    }
?>

<center>
    <br>
    <h2><?php echo $row['nombre_mascota']; ?></h2>
    <br>
    <div class="redondo">
        <img class="foto-perfil" src="<?php echo $row['path_foto_mascota']; ?>" />
      </div>
    <br>
    <table>
        <tr>
            <td><b>Dueño:</b></td>
            <td><?php echo $row['nombre_cliente']." ". $row['apellido_cliente']; ?></td>
          </tr>
        <tr>
            <td><b>Identificacion:</b></td>
            <td><?php echo $row['identificacion_mascota']; ?></td>
        </tr>
        <tr>
            <td><b>Fecha de nacimiento:</b></td>
            <td><?php echo $row['fecha_nacimiento_mascota']; ?></td>
        </tr>
        <tr>
            <td><b>Mi mascota es:</b></td>
            <td><?php echo $row['nombre_especie']; ?></td>
        </tr>
        <tr>
            <td><b>Y es de raza:</b></td>
            <td><?php echo $row['nombre_raza']; ?></td>
        </tr>
        <tr>
            <td><b>Direccion:</b></td>
            <td><?php echo $row['direccion_mascota']; ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="formulario">
        <tr>
            <td><a href="?cargar=misMascotas&id=<?php echo $_SESSION['id']; ?>">Volver</a></td>
        </tr>
    </table>
    <br>
    <table class="formulario">
        <?php
            if(mysqli_fetch_assoc($row2)) {
                ?>
                  <h2>Historial Médico</h2>
                  <tr>
                  </tr>
            </table>
                <?php
            }else {
              $mensaje = 'Tu mascota actualmente no cuenta con un historial médico para consultar';
            }
        ?>
        <?php
            if(!empty($mensaje)) {
                echo "<p class='mensaje'>". $mensaje ."</p>";

            }

        ?>
</center>
