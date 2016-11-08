<?php
    if(isset($_SESSION['idVeterinario']) || isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorVeterinaria();
        if(isset($_SESSION['id'])) {
            $row = $controlador->ver($_GET['id']);
            $resultado = $controlador->verComentario($_GET['id']);
        }
    }else {
        header('location: index.php');

    }
?>

<center>
    <br>
    <h2><?php echo $row['nombre_veterinaria']; ?></h2>
    <br>
    <div class="redondo">
        <img class="foto-perfil" src="<?php echo $row['path_foto_veterinaria']; ?>" />
      </div>
    <br>
    <table class="formulario">
        <tr>
            <td><b>Dueño:</b></td>
            <td><?php echo $row['nombre_veterinario']." ". $row['apellido_veterinario']; ?></td>
          </tr>
        <tr>
            <td><b>NIT:</b></td>
            <td><?php echo $row['nit_veterinaria']; ?></td>
        </tr>
        <tr>
            <td><b>Direccion:</b></td>
            <td><?php echo $row['direccion_veterinaria']; ?></td>
        </tr>
        <tr>
            <td><b>Teléfono:</b></td>
            <td><?php echo $row['telefono_veterinaria']; ?></td>
        </tr>
        <tr>
            <td><b>Celular:</b></td>
            <td><?php echo $row['celular_veterinaria']; ?></td>
        </tr>
        <tr>
            <td><b>Puntos:</b></td>
            <td><?php
                    if($row['cantidad_votos_veterinaria'] > 0) {
                        echo $row['total_puntos_veterinaria'] / $row['cantidad_votos_veterinaria'];
                    }else {
                        echo 'Aun no tiene puntuación';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Comentarios:</b></td>
            <td><a href="?cargar=comentariosVeterinaria&id=<?php echo $row['id_veterinaria'] ?>" target="popup" onClick="window.open(this.href, this.target, 'width=350,height=420'); return false;">Comentarios</a></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="formulario">
        <tr>
            <td><a href="javascript:history.back(-1);">Volver</a></td>
        </tr>
    </table>
</center>
