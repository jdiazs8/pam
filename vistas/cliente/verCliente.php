<?php
    if(isset($_SESSION['idCliente'])) {
        $controlador = new ControladorCliente();
        if(isset($_SESSION['id'])) {
            $row = $controlador->ver($_SESSION['id']);
        }
    }else {
        header('location: index.php');

    }
?>

<center>
    <h2><?php echo $row['nombre_cliente'].' '.$row['apellido_cliente']; ?></h2>
    <br>
    <div class="redondo">
        <img class="foto-perfil" src="<?php echo $row['path_foto_cliente']; ?>" />
      </div>
    <br>
    <table>
        <tr>
            <td><b>Cedula:</b></td>
            <td><?php echo $row['identificacion_cliente']; ?></td>
        </tr>
        <tr>
            <td><b>Correo:</b></td>
            <td><?php echo $row['correo_cliente']; ?></td>
        </tr>
        <tr>
            <td><b>Direccion:</b></td>
            <td><?php echo $row['direccion_cliente']; ?></td>
        </tr>
        <tr>
            <td><b>Teléfono:</b></td>
            <td><?php echo $row['telefono_cliente']; ?></td>
        </tr>
        <tr>
            <td><b>Celular:</b></td>
            <td><?php echo $row['celular_cliente']; ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="formulario">
        <tr>
            <td><a href="?cargar=editarCliente&id=<?php echo $row['id_cliente']; ?>">Actualizar</a></td>
            <td><a href="?cargar=desactivarCliente&id=<?php echo $row['id_cliente']; ?>">Desactivar</a></td>
        </tr>
    </table>
</center>
