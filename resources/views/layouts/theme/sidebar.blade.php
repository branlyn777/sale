<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="index.html" class="b-brand">
        <!-- ========   Change your logo from here   ============ -->
        <img src="template/images/logo-dark.svg" alt="" class="logo logo-lg" />
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>Inicio</label>
          <i class="ti ti-dashboard"></i>
        </li>
        <li class="pc-item">
          <a href="{{ url('inicio') }}" class="pc-link">
            <span class="pc-micon">
              <i class="ti ti-dashboard"></i>
            </span>
            <span class="pc-mtext">Inicio</span></a>
        </li>
        <li class="pc-item pc-caption">
          <label>Inventarios</label>
          <i class="ti ti-news"></i>
        </li>
        <li class="pc-item">
          <a href="#" class="pc-link">
            <span class="pc-micon">
              <i class="ti ti-briefcase"></i>
            </span>
            <span class="pc-mtext">Administración</span>
            <span class="pc-arrow">
              <i class="ti ti-chevron-right"></i>
            </span>
          </a>
          <ul class="pc-submenu">
            <li class="pc-item">
              <a class="pc-link" href="{{ url('usuarios') }}">
                Usuarios
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>