<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{ url('/')}}/vistas/img/icono.jpg" alt="Juanito Travel" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Juanito Travel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 211px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/')}}/vistas/img/default.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrador</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
          {{-- *** Boton de blog *** --}}
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Blog</p>
            </a>
          </li>

          {{-- *** Boton de administradores *** --}}
          <li class="nav-item">
            <a href="{{ url('/administradores') }}" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Administradores</p>
            </a>
          </li>

          {{-- *** Boton de categorias *** --}}
          <li class="nav-item">
            <a href="{{ url('/categorias') }}" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>Categorías</p>
            </a>
          </li>

          {{-- *** Boton de articulos *** --}}
          <li class="nav-item">
            <a href="{{ url('/articulos') }}" class="nav-link">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>Artículos</p>
            </a>
          </li>

          {{-- *** Boton de opiniones *** --}}
          <li class="nav-item">
            <a href="{{ url('/opiniones') }}" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Opiniones</p>
            </a>
          </li>

          {{-- *** Boton de banner *** --}}
          <li class="nav-item">
            <a href="{{ url('/banner') }}" class="nav-link">
              <i class="nav-icon far fa-images"></i>
              <p>Banner</p>
            </a>
          </li>

          {{-- *** Boton de anuncios *** --}}
          <li class="nav-item">
            <a href="{{ url('/anuncios') }}" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>Anuncios</p>
            </a>
          </li>

          {{-- *** Ver sitio web *** --}}
          <li class="nav-item">
            <a href="{{ substr(url('/'), 0, -14) }}" class="nav-link" target="_blank">
              <i class="nav-icon fas fa-globe"></i>
              <p>Ver sitio web</p>
            </a>
          </li>

        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 16.8121%; transform: translate(0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>