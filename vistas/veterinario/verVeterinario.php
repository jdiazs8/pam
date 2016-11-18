<?php
    if(isset($_SESSION['idVeterinario']) || isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorVeterinario();
        if(isset($_SESSION['id'])) {
            $row = $controlador->ver($_GET['id']);

        }
    }else {
        header('location: index.php');

    }
?>
<section>
<center>
    <h2><?php echo $row['nombre_veterinario'].' '.$row['apellido_veterinario']; ?></h2>
    <br>
    <div class="redondo">
        <img class="foto-perfil" src="<?php echo $row['path_foto_veterinario']; ?>" />
      </div>
    <br>
    <table>
        <tr>
            <td><b>Cedula:</b></td>
            <td><?php echo $row['identificacion_veterinario']; ?></td>
        </tr>
        <tr>
            <td><b>Correo:</b></td>
            <td><?php echo $row['correo_veterinario']; ?></td>
        </tr>
        <tr>
            <td><b>Direccion:</b></td>
            <td><?php echo $row['direccion_veterinario']; ?></td>
        </tr>
        <tr>
            <td><b>Teléfono:</b></td>
            <td><?php echo $row['telefono_veterinario']; ?></td>
        </tr>
        <tr>
            <td><b>Celular:</b></td>
            <td><?php echo $row['celular_veterinario']; ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="formulario">
        <tr>
            <?php
              if(isset($_SESSION['idAdmin'])) {
            ?>
            <td><a href="?cargar=verClientes">Volver</a></td>
            <?php
              }
            ?>
            <td><a href="?cargar=editarVeterinario&id=<?php echo $row['id_veterinario']; ?>">Actualizar</a></td>
            <td><a href="?cargar=desactivarVeterinario&id=<?php echo $row['id_veterinario']; ?>">Desactivar</a></td>
        </tr>
    </table>
</center>
</section>
