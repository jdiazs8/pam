<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorAdmin();
        if(isset($_SESSION['id'])) {
            $resultado = $controlador->index();
        }
    }else {
        header('location: index.php');
    }
?>

<center>
    <div>
        <h2>Administradores</h2>
        <br>
        <table class="formulario">
            <tr>
              <td><a href="?cargar=crearAdmin">Crear Nuevo Administrador</a></td>
            </tr>
        </table>
        <br>
        <?php
            while($row = mysqli_fetch_assoc($resultado)){
        ?>
        <br>
        <table class="formulario">
            <tr>
                <td colspan="1"><b>id: <?php echo $row['id_admin']; ?></b></td>
                <td colspan="2"><b>Nombre: <?php echo $row['nombre_admin']; ?></b></td>
            </tr>
            <tr>
                <td><a href="?cargar=verAdmin&id=<?php echo $row['id_admin']; ?>">Ver</a></td>
                <td><a href="?cargar=editarAdmin&id=<?php echo $row['id_admin']; ?>">Actualizar</a></td>
                <td><a href="?cargar=desactivarAdmin&id=<?php echo $row['id_admin']; ?>">Desactivar</td>
            </tr>
        </table>
        <br>
    </div>
        <?php
            }
        ?>
</center>
