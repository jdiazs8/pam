<?php
    unset($_SESSION['idCliente']);
    unset($_SESSION['idVeterinario']);
    unset($_SESSION['idAdmin']);
    session_destroy();
    header('location: index.php');
?>
