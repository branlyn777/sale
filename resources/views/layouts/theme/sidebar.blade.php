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
                        <li class="pc-item">
                          <a class="pc-link" href="">
                            Asignar Permisos
                          </a>
                        </li>
                        <li class="pc-item">
                          <a class="pc-link" href="">
                            Empresa
                          </a>
                        </li>
                        <li class="pc-item">
                          <a class="pc-link" href="">
                            Sucursales
                          </a>
                        </li>
                        <li class="pc-item">
                          <a class="pc-link" href="">
                            Carteras
                          </a>
                        </li>
                        <li class="pc-item">
                          <a class="pc-link" href="">
                            Clientes
                          </a>
                        </li>
                        <li class="pc-item">
                          <a class="pc-link" href="{{ url('proveedores') }}">
                            Proveedores
                          </a>
                        </li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                      <span class="pc-micon">
                        <i class="ti ti-archive"></i>
                      </span>
                        <span class="pc-mtext">Inventarios</span>
                        <span class="pc-arrow"><i class="ti ti-chevron-right"></i>
                        </span>
                      </a>
                    <ul class="pc-submenu">
                      <li class="pc-item">
                          <a class="pc-link" href="{{ url('productos') }}">
                          Productos
                        </a>
                      </li>
                      <li class="pc-item">
                        <a class="pc-link" href="{{ url('categorias') }}">
                          Categorias
                        </a>
                      </li>
                      <li class="pc-item">
                        <a class="pc-link" href="{{ url('comprar') }}">
                          Comprar
                        </a>
                      </li>
                      <li class="pc-item">
                        <a class="pc-link" href="">
                          Depósitos
                        </a>
                      </li>
                    </ul>
                </li>
                <li class="pc-item pc-caption">
                    <label>Ventas</label>
                    <i class="ti ti-apps"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ url('vender') }}" class="pc-link">
                      <span class="pc-micon">
                        <i class="ti ti-shopping-cart"></i>
                      </span>
                      <span class="pc-mtext">
                        Vender
                      </span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="../elements/bc_color.html" class="pc-link">
                      <span class="pc-micon">
                        <i class="ti ti-list"></i>
                      </span>
                      <span class="pc-mtext">
                          Lista de Ventas 1
                      </span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="https://tablericons.com" class="pc-link">
                      <span class="pc-micon">
                        <i class="ti ti-list"></i>
                      </span>
                      <span class="pc-mtext">
                        Lista de Ventas 2
                      </span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Reportes</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item">
                  <a href="../other/sample-page.html" class="pc-link">
                    <span class="pc-micon">
                      <i class="ti ti-brand-chrome"></i>
                    </span>
                    <span class="pc-mtext">Movimientos</span>
                  </a>
                </li>
                <li class="pc-item">
                  <a href="https://codedthemes.gitbook.io/berry-bootstrap/" class="pc-link">
                    <span class="pc-micon">
                      <i class="ti ti-vocabulary"></i>
                    </span>
                    <span class="pc-mtext">Estadísticas</span>
                  </a>
                </li>
            </ul>
            {{-- <div class="pc-navbar-card bg-primary rounded">
                <h4 class="text-white">Accesos</h4>
                <p class="text-white opacity-75">a</p>
                <a href="https://codedthemes.com/item/berry-bootstrap-5-admin-template/" target="_blank"
                    class="btn btn-light text-primary">Pro</a>
            </div> --}}
        </div>
    </div>
</nav>
