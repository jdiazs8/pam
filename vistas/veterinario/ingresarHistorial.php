<?php
    if(isset($_SESSION['idVeterinario'])){
        $controlador = new ControladorVeterinaria();
        if(isset($_GET['id'])) {
            $resultado = $controlador->misVeterinarias($_SESSION['id']);
        }

        if(isset($_POST['guardar'])) {
            if(empty($_POST['peso']) || empty($_POST['sintomas']) || empty($_POST['diagnostico']) || empty($_POST['observacion'])){
                $mensaje = 'Lo campos marcados con * deben estar diligenciados';
            }else {
                $controlador->ingresarHistorial($_GET['id'], $_POST['peso'], $_POST['sintomas'], $_POST['diagnostico'], $_POST['observacion'], $_POST['idVeterinaria'], $_SESSION['id']);
                $mensaje = 'El historial ha sido ingresado.';
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

    <h2>Ingreso de Historia Clínica</h2>
    <input type="text" name="peso" maxlength="5" placeholder="Peso*" required>
    <br>
    <textarea name="sintomas" maxlength="399" placeholder="Síntomas*" required></textarea>
    <br>
    <textarea name="diagnostico" maxlength="399" placeholder="Diagnóstico*" required></textarea>
    <br>
    <textarea name="observacion" maxlength="399" placeholder="Observaciones*" required></textarea>
    <br>
    <select name="idVeterinaria" required>
        <?php
          while($row = mysqli_fetch_assoc($resultado)) {
        ?>
        <option value="<?php echo $row['id_veterinaria']; ?>"><?php echo $row['nombre_veterinaria']; ?></option>
        <?php
          }
        ?>
    </select>

    <input type="submit" class="boton" name="guardar" value="Ingresar Historial">
</form>
