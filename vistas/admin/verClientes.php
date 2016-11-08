<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorAdmin();
        if(isset($_SESSION['id'])) {
            $resultado = $controlador->verClientes();
        }
    }else {
        header('location: index.php');
    }
?>

<center>
    <div>
        <h2>Clientes</h2>
        <br>
        <?php
            while($row = mysqli_fetch_assoc($resultado)){
        ?>
        <div class="redondo">
            <img class="foto-perfil" src="<?php echo $row['path_foto_cliente'] ?>" />
        </div>
        <h4><?php echo $row['nombre_cliente']; ?></h4>
        <br>
        <table class="formulario">
            <tr>
                <td><a href="?cargar=verCliente&id=<?php echo $row['id_cliente']; ?>">Ver Información</a></td>
            </tr>
        </table>
        <br>
    </div>


        <?php
            }
        ?>
</center>
