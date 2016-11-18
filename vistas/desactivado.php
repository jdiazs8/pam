<?php
    unset($_SESSION['idCliente']);
    unset($_SESSION['idVeterinario']);
    unset($_SESSION['idAdmin']);
    session_destroy();
?>
<section>
<div class="mensaje">
    <p>Actualmente tu cuenta se encuentra desactivada, por favor envia una solicitud a través de <a color="#fff" href='?cargar=contacto'>Contacto</a>.</p>
</div>
<center>
  <a href='?cargar=inicio'>Volver</a>
<center>
</section>
