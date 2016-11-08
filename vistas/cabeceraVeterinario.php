<header>
  <div class="menu_bar">
    <a href="#" class="bt-menu"><span class="icon-menu"></span>PAM</a>
  </div>

  <nav>
    <ul>
      <li><a href="?cargar=inicio"><span class="icon-house"></span>Inicio</a></li>
      <!--<li><a href="?cargar=fotos"><span class="icon-suitcase"></span>Fotos</a></li>-->
      <li class="submenu">
        <a href="#"><span class="icon-rocket"></span>Opciones<span class="caret icon-arrow-down6"></span></a>
        <ul class="children">
          <li><a href="?cargar=verVeterinario&id=<?php echo $_SESSION['id']; ?>">Administrar<span class="icon-dot"></span></a></li>
          <!--<li><a href="?cargar=subirFoto">Subir Fotos<span class="icon-dot"></span></a></li>-->
          <li><a href="?cargar=misVeterinarias&id=<?php echo $_SESSION['id']; ?>">Mis Veterinarias<span class="icon-dot"></span></a></li>
          <li><a href="?cargar=crearVeterinaria&id=<?php echo $_SESSION['id']; ?>">Registrar veterinaria<span class="icon-dot"></span></a></li>
          <li><a href="?cargar=miConsultorio">Mi Consultorio<span class="icon-dot"></span></a></li>
        </ul>
      </li >
      <li><a href="?cargar=contacto"><span class="icon-mail"></span>Contacto</a></li>
      <li><a href="?cargar=cerrarSesion"><span class="icon-suitcase"></span>Cerrar Sesión</a></li>
    </ul>
  </nav>
</header>
