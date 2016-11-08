<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorAdmin();
        if(isset($_GET['id'])) {
            $row = $controlador->ver($_GET['id']);
        }
    }else {
        header('location: index.php');

    }
?>

<center>
    <br>
    <table>
        <tr>
            <td><b>ID:</b></td>
            <td><?php echo $row['id_admin']; ?></td>
        </tr>
        <tr>
            <td><b>Nombre:</b></td>
            <td><?php echo $row['nombre_admin']; ?></td>
        </tr>
        <tr>
            <td><b>Correo:</b></td>
            <td><?php echo $row['correo_admin']; ?></td>
        </tr>
        <tr>
            <td><b>Activado:</b></td>
            <td><?php echo $row['activado_admin']; ?></td>
        </tr>
        <tr>
            <td><b>Fecha de registro:</b></td>
            <td><?php echo $row['fecha_registro_admin']; ?></td>
        </tr>
        <tr>
            <td><b>Fecha del ultimo cambio:</b></td>
            <td><?php echo $row['fecha_ultm_admin']; ?></td>
        </tr>
        <tr>
            <td><b>ID Usuario:</b></td>
            <td><?php echo $row['id_usuario']; ?></td>
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
