<?php
    if(isset($_SESSION['idVeterinario'])) {
        $controlador = new ControladorVeterinario();
        if(isset($_SESSION['id'])) {
            $resultado = $controlador->miConsultorio($_SESSION['id']);
        }
    }else {
        header('location: index.php');
    }
?>

<center>
    <div>
        <h2>Mis Mascotas</h2>
        <?php
            $num = mysqli_num_rows($resultado);
            if($num == 0) {
              header('location: index.php?cargar=sinMascotas');
            }
            while($row = mysqli_fetch_assoc($resultado)){
        ?>
        <div class="redondo">
            <img class="foto-perfil" src="<?php echo $row['path_foto_mascota'] ?>" />
        </div>
        <h4><?php echo $row['nombre_mascota']; ?></h4>
        <br>
        <table class="formulario">
            <tr>
                <td><a href="?cargar=verMascota&id=<?php echo $row['id_mascota']; ?>">Ver Historial</a></td>
                <td><a href="?cargar=ingresarHistorial&id=<?php echo $row['id_mascota']; ?>">Ingresar Historial</a></td>
            </tr>
        </table>
        <br>
    </div>


        <?php
            }
        ?>
</center>
