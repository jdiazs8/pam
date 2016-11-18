<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorAdmin();
        if(isset($_SESSION['id'])) {
            $resultado = $controlador->verMascotas();
        }
    }else {
        header('location: index.php');
    }
?>

<section>
<center>
    <div>
        <h2>mascotas</h2>
        <br>
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
                <td><a href="?cargar=verMascota&id=<?php echo $row['id_mascota']; ?>">Ver Información</a></td>
                <td><a href="?cargar=editarMascota&id=<?php echo $row['id_mascota']; ?>">Actualizar</a></td>
                <td><a href="?cargar=desactivarMascota&id=<?php echo $row['id_mascota']; ?>">Desactivar</a></td>
            </tr>
        </table>
        <br>
    </div>


        <?php
            }
        ?>
</center>
</section>
