<?php
    if(isset($_SESSION['idAdmin'])) {
        $controlador = new ControladorExtra();
        if(isset($_POST['cargar'])){
            header('location: index.php?cargar=verExtra&extra='.$_POST['extra']);
        }

    }else {
        header('location; index.php');
    }
?>

<form action="" method="post">
    <center><h2>Seleccione</h2></center>
    <select name="extra">
        <option value="0">Opción</option>
        <option value="1">Tipos de Usuario</option>
        <option value="2">Vacunas</option>
        <option value="3">Especies</option>
        <option value="4">Razas</option>
    </select>
    <input type="submit" class="boton" name="cargar" value="Cargar">
</form>
