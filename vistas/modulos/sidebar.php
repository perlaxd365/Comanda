
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category">Gestion de Clientes</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#elementos_clientes" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">Clientes</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="elementos_clientes">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo SERVERURL;?>cliente/">Registro</a></li>
              </ul>
            </div>
            <div class="collapse" id="elementos_clientes">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo SERVERURL;?>clienteList/">Lista</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Gestion de Cotizacion</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#elementos_cotizacion" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">Cotización</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="elementos_cotizacion">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo SERVERURL;?>registroCotizacion/">Registro</a></li>
              </ul>
            </div>
            <div class="collapse" id="elementos_cotizacion">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo SERVERURL;?>cotizacionList/">Lista</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>