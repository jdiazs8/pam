<?php
    if(isset($_SESSION['idVeterinario'])) {
        $controlador = new ControladorVeterinario();
        if(isset($_SESSION['id'])) {
            $resultado = $controlador->misVeterinarias($_SESSION['id']);
        }
    }else {
        header('location: index.php');
    }
?>

<section>
<center>
    <div>
        <h2>Mis Veterinarias</h2>
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
                <td><a href="?cargar=verVeterinaria&id=<?php echo $row['id_veterinaria']; ?>">Ver</a></td>
                <td><a href="?cargar=editarVeterinaria&id=<?php echo $row['id_veterinaria']; ?>">Actualizar</a></td>
                <td><a href="?cargar=desactivarVeterinaria&id=<?php echo $row['id_veterinaria']; ?>">Desactivar</td>
            </tr>
        </table>
        <br>
    </div>


        <?php
            }
        ?>
</center>
</section>
