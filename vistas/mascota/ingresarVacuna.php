<?php
    if(isset($_SESSION['idVeterinario']) || isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorVeterinario();
        $controlador2 = new ControladorExtra();

        $vacunas = $controlador2->vacunasEspecie($_GET['especie']);


        if(isset($_POST['guardar'])) {
            if(empty($_POST['laboratorio']) || empty($_POST['cepa']) || empty($_POST['lote']) || empty($_POST['exp']) || empty($_POST['dosis']) || empty($_POST['idVacuna'])){
                $mensaje = 'Lo campos marcados con * deben estar diligenciados';
            }else {
                $resultado = $controlador->ingresarVacuna($_POST['laboratorio'], $_POST['cepa'], $_POST['lote'], $_POST['exp'], $_POST['dosis'], $_POST['idVacuna'], $_GET['id']);

                if($resultado) {
                    echo "<script>";
                    echo "window.close();";
                    echo "</script>";
                }else {
                    $mensaje = 'Ocurrió un error al momento de registrar la vacuna.';
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
    <h2>Registro de vacuna</h2>
    <input type="text" name="laboratorio" maxlength="50" placeholder="Laboratorio*" required>
    <br>
    <input type="text" name="cepa" maxlength="50" placeholder="Cepa*" required>
    <br>
    <input type="text" name="lote" maxlength="10" placeholder="Lote*" required>
    <br>
    <label>Fecha de experación*</label>
    <br>
    <input type="date" name="exp" required>
    <br>
    <input type="text" name="dosis" maxlength="1" placeholder="No. de dosis*" required>
    <br>
    <select name="idVacuna" required>
        <option value="0">Seleccionar vacuna...*</option>
        <?php
          while($row = mysqli_fetch_assoc($vacunas)) {
            ?>
            <option value="<?php echo $row['id_vacuna'] ?>"><?php echo $row['nombre_vacuna'] ?></option>
            <?php
          }
        ?>
    </select>
    <br>
    <input type="submit" class="boton" name="guardar" value="Registrar vacuna">
</form>
