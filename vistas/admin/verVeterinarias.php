<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorAdmin();
        if(isset($_SESSION['id'])) {
            $resultado = $controlador->verVeterinarias();
        }
    }else {
        header('location: index.php');
    }
?>

<center>
    <div>
        <h2>Veterinarias</h2>
        <br>
        <?php
            while($row = mysqli_fetch_assoc($resultado)){
        ?>
        <div class="redondo">
            <img class="foto-perfil" src="<?php echo $row['path_foto_veterinaria'] ?>" />
        </div>
        <h4><?php echo $row['nombre_veterinaria']; ?></h4>
        <br>
        <table class="formulario">
            <tr>
                <td><a href="?cargar=verVeterinaria&id=<?php echo $row['id_veterinaria']; ?>">Ver Información</a></td>
                <td><a href="?cargar=editarVeterinaria&id=<?php echo $row['id_veterinaria']; ?>">Actualizar</a></td>
                <td><a href="?cargar=desactivarVeterinaria&id=<?php echo $row['id_veterinaria']; ?>">Desactivar</a></td>
            </tr>
        </table>
        <br>
    </div>


        <?php
            }
        ?>
</center>
