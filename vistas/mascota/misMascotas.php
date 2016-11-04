<?php
    if(isset($_SESSION['idCliente'])) {
        $controlador = new ControladorCliente();
        if(isset($_SESSION['id'])) {
            $resultado = $controlador->listarMascotas($_SESSION['id']);
        }
    }else {
        header('location: index.php');
    }
?>

<center>
    <div>
        <h2>Mis Mascotas</h2>
        <?php
            while($row = mysqli_fetch_assoc($resultado)){
        ?>
        <div class="redondo">
            <img class="foto-perfil" src="<?php echo $row['path_foto_mascota'] ?>" />
        </div>
        <h4><?php echo $row['nombre_mascota']; ?></h4>
        <br>
        <table class="formulario">
            <tr>
                <td><a href="?cargar=verMascota&id=<?php echo $row['id_mascota']; ?>">Ver</a></td>
                <td><a href="?cargar=editarMascota&id=<?php echo $row['id_mascota']; ?>">Actualizar</a></td>
                <td><a href="?cargar=desactivarMascota&id=<?php echo $row['id_mascota']; ?>">Desactivar</td>
            </tr>
        </table>
        <br>
    </div>


        <?php
            }
        ?>
</center>
