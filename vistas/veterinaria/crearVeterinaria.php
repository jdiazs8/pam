<?php
    if(isset($_SESSION['idVeterinario'])) {
        $controlador = new ControladorVeterinaria();

        if(isset($_POST['guardar'])) {
            if(empty($_POST['nombre']) || empty($_POST['nit']) || empty($_POST['direccion']) || empty($_POST['celular'])){
                $mensaje = 'Lo campos marcados con * deben estar diligenciados';
            }else {
                $resultado = $controlador->crear($_POST['nombre'], $_POST['nit'], $_SESSION['id'], $_POST['direccion'], $_POST['celular']);

                if($resultado) {
                    header('location: index.php?cargar=misVeterinarias&id='.$_SESSION['id']);
                }else {
                    $mensaje = 'Ocurrió un error al momento de registrar tu mascota, por favor intenta de nuevo.';
                }
            }
        }
    }else {
        header('location: index.php');
    }

?>


<form action="" method="post">
    <?php
        if(!empty($mensaje)) {
            echo "<p class='mensaje'>". $mensaje ."</p>";

        }

    ?>
    <h2>Registro de clínica veterinaria</h2>
    <input type="text" name="nombre" maxlength="50" placeholder="Nombre*" required>
    <br>
    <input type="text" name="nit" maxlength="14" placeholder="NIT*" required>
    <br>
    <input type="text" name="direccion" maxlength="99" placeholder="Dirección*" required>
    <br>
    <input type="number" name="celular" maxlength="10" placeholder="No. Celular*" required>
    <br>
    <input type="submit" class="boton" name="guardar" value="Registrar veterinaria">
</form>
