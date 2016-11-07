<?php
    if(isset($_SESSION['idVeterinario']) || isset($_SESSION['idCliente'])) {
        if(isset($_SESSION['idVeterinario'])) {
            $mensaje = "Actualmente no tienes mascotas asignadas.";
        }else if(isset($_SESSION['idCliente'])) {
            $mensaje = "Actualmente no tienes mascotas registradas, registra tu primera mascota ahora.";
        }
    }else {
        header('location: index.php');
    }

    if(!empty($mensaje)) {
        echo "<div>";
        echo "<p class=\"mensaje\">". $mensaje ."</p>";
        echo "</div>";

        if(isset($_SESSION['idCliente'])) {
          echo "<center>";
            echo "<table class='formulario'>";
              echo "<tr>";
                echo "<td>";
                  echo "<a href='?cargar=crearMascota'>Registrar mascota</a>";
                echo "</td>";
              echo "</tr>";
            echo "</table>";
          echo "<center>";
        }else if(isset($_SESSION['idVeterinario'])) {
          echo "<center>";
            echo "<table class='formulario'>";
              echo "<tr>";
                echo "<td>";
                  echo "<a href='javascript:history.back(-1);'>Volver</a>";
                echo "</td>";
              echo "</tr>";
            echo "</table>";
          echo "<center>";
        }
    }
?>
