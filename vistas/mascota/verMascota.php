<?php
    if(isset($_SESSION['idCliente']) || isset($_SESSION['idVeterinario']) || isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorMascota();
        if(isset($_SESSION['id'])) {
            $row = $controlador->ver($_GET['id']);
            $resultado = $controlador->verHistorial($_GET['id']);
        }

        if(isset($_POST['calificar'])) {
          $controlador2 = new ControladorCliente();
          $controlador2->calificarVisita($_POST['calificacion'], $_POST['comentario'], $_POST['idVisita'], $_POST['idVeterinaria']);
          header('location: index.php?cargar=misMascotas&id='.$_SESSION['id']);
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
    <table class="formulario">
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
        <tr>
            <td><b>Veterinario encargado:</b></td>
            <td><?php echo $row['nombre_veterinario'].' '.$row['apellido_veterinario']; ?></td>
        </tr>

            <tr>
                <td><b>Carnet de vacunas:</b></td>
                <td><a href="?cargar=carnetVacunas&id=<?php echo $_GET['id'] ?>&especie=<?php echo $row['id_especie'] ?>" target="popup" onClick="window.open(this.href, this.target, 'width=350,height=420'); return false;">Vacunas</a></td>
            </tr>
    </table>
    <br>
    <br>
    <table class="formulario">
        <tr>
            <td><a href="javascript:history.back(-1);">Volver</a></td>
        </tr>
    </table>
    <br>
    <h2>Historial Médico</h2>
    <?php
        if(mysqli_num_rows($resultado) != 0) {
            while($row2 = mysqli_fetch_assoc($resultado)) {
    ?>
    <table class="formulario">
        <hr>
        <tr>
            <td><b>Fecha:</b></td>
            <td><?php echo $row2['fecha_visita_veterinaria'] ?></td>
        </tr>
        <tr>
            <td><b>Peso:</b></td>
            <td><?php echo $row2['peso_visita_veterinaria'] ?> Kg.</td>
        </tr>
        <tr>
            <td><b>Síntomas:</b></td>
            <td><?php echo $row2['sintomas_visita_veterinaria'] ?></td>
        </tr>
        <tr>
            <td><b>Diagnóstico:</b></td>
            <td><?php echo $row2['diagnostico_visita_veterinaria'] ?></td>
        </tr>
        <tr>
            <td><b>Observaciones:</b></td>
            <td><?php echo $row2['observaciones_visita_veterinaria'] ?></td>
        </tr>
        <tr>
            <td><b>Atendido en la clínica:</b>
            <td><?php echo $row2['nombre_veterinaria']; ?></td>
        </tr>
        <tr>
            <td><b>Médico a cargo:</b>
            <td class="firma"><em><?php echo $row2['nombre_veterinario'].' '.$row2['apellido_veterinario']; ?></em></td>
        </tr>
        <tr>
        <td colspan="2">
            <?php
                if($row2['calificado_visita_veterinaria']){
                    echo "<p class='mensaje'>Visita calificada</p>";
                }else if(!$row2['calificado_visita_veterinaria'] && isset($_SESSION['idCliente'])){
            ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <form action="" method="post">
                    <select name="calificacion">
                        <option value="0">Seleccione una calificación</option>
                        <option value="5">Excelente</option>
                        <option value="4">Muy bueno</option>
                        <option value="3">Bueno</option>
                        <option value="2">Malo</option>
                        <option value="1">Muy malo</option>
                    </select>
                    <input type="hidden" name="idVisita" value="<?php echo $row2['id_visita_veterinaria'] ?>">
                    <input type="hidden" name="idVeterinaria" value="<?php echo $row2['id_veterinaria'] ?>">
                    <textarea name="comentario" placeholder="Escribe tu comentario"></textarea>
                    <input type="submit" class="boton" name="calificar" value="calificar">
                </form>
            </td>
        </tr>

    <?php
  }else if(!$row2['calificado_visita_veterinaria'] && isset($_SESSION['idVeterinario'])){
    echo "<p class='mensaje'>Esta consulta no ha sido calificada.</p>";
  }

          }
          ?>
          </table>
          <?php
        }else {
            $mensaje = 'Tu mascota actualmente no cuenta con un historial médico para consultar';
        }

        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";
        }
    ?>
</center>
