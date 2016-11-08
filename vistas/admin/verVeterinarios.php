<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorAdmin();
        if(isset($_SESSION['id'])) {
            $resultado = $controlador->verVeterinarios();
        }
    }else {
        header('location: index.php');
    }
?>

<center>
    <div>
        <h2>veterinarios</h2>
        <br>
        <?php
            while($row = mysqli_fetch_assoc($resultado)){
        ?>
        <div class="redondo">
            <img class="foto-perfil" src="<?php echo $row['path_foto_veterinario'] ?>" />
        </div>
        <h4><?php echo $row['nombre_veterinario'].' '.$row['apellido_veterinario']; ?></h4>
        <br>
        <table class="formulario">
            <tr>
                <td><a href="?cargar=verVeterinario&id=<?php echo $row['id_veterinario']; ?>">Ver Información</a></td>
            </tr>
        </table>
        <br>
    </div>


        <?php
            }
        ?>
</center>
