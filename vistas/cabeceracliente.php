<header>
  <div class="menu_bar">
    <a href="#" class="bt-menu"><span class="icon-list2"></span>Menú</a>
  </div>

  <nav>
    <ul>
      <li><a href="?cargar=inicio"><span class="icon-house"></span>Inicio</a></li>
      <li><a href="?cargar=fotos"><span class="icon-suitcase"></span>Fotos</a></li>
      <li class="submenu">
        <a href="#"><span class="icon-rocket"></span>Opciones<span class="caret icon-arrow-down6"></span></a>
        <ul class="children">
          <li><a href="?cargar=verCliente&id=<?php echo $_SESSION['id']; ?>">Administrar<span class="icon-dot"></span></a></li>
          <li><a href="?cargar=subirFoto">Subir Fotos<span class="icon-dot"></span></a></li>
          <li><a href="?cargar=misMascotas&id=<?php echo $_SESSION['id']; ?>">Mis Mascotas<span class="icon-dot"></span></a></li>
          <li><a href="?cargar=registrarMascota">Registrar Mascota<span class="icon-dot"></span></a></li>
        </ul>
      </li >
      <li><a href="?cargar=contacto"><span class="icon-mail"></span>Contacto</a></li>
      <li><a href="?cargar=cerrarSesion"><span class="icon-suitcase"></span>Cerrar Sesión</a></li>
    </ul>
  </nav>
</header>
