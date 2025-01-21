<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="vistas/img/plantilla/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="sig" class="nav-link">SIG</a>
      </li>
      <li class="nav-item dropdown">
        <a href="contabilidad" class="nav-link">Contabilidad</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="ti" class="nav-link">G-TI</a>
      </li>
      <li class="nav-item dropdown">
        <a href="juridico" class="nav-link">JU</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block " hidden>
        <a href="operaciones" class="nav-link">G-OP</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block " hidden>
        <a href="tecnica" class="nav-link">G-Tecnica</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- MENU PARA DISPOSITIVOS MOVILES -->
      <li class="nav-item dropdown d-block d-sm-block d-md-none">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-list-ul"></i>
          <span class="badge badge-warning navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Otros Aplicativos</span>
          <div class="dropdown-divider"></div>
          <a href="sadoc.php" class="dropdown-item">
            <i class="fas fa-folder-open"></i> SADOC
            <span class="float-right text-muted text-sm">Ir</span>
          </a>

          <div class="dropdown-divider"></div>
          <a href="ordenes.php" class="dropdown-item">
            <i class="fas fa-money-check-alt"></i> Ordenes de Compra
            <span class="float-right text-muted text-sm">Ir</span>
          </a>

          <div class="dropdown-divider"></div>
          <a href="acpm.php" class="dropdown-item">
            <i class="fas fa-tasks"></i> ACPM
            <span class="float-right text-muted text-sm">Ir</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="index.php" class="dropdown-item dropdown-footer">Plataforma ZFIP</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge"><?= $notificaciones = ($total_acpm + $cantidad_orden + $total_actividades_vencidas); ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><B><?= $notificaciones; ?> Pendientes</B></span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="far fa-times-circle mr-2"></i> <?= $total_acpm; ?> | ACPM Pendientes
            <span class="float-right badge badge-info">Pendientes</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="far fa-thumbs-down mr-2"></i> <?= $total_actividades_vencidas; ?> | Actividades Vencidas
            <span class="float-right badge badge-danger">Urgente</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-cart-plus mr-2"></i> <?= $cantidad_orden; ?> | Ordenes en Proceso
            <span class="float-right badge badge-success">Proceso</span>
          </a>

        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="salir">
          <i class="fas fa-sign-in-alt mr-2"></i> Cerrar Sesion
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="vistas/img/plantilla/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PLATAFORMA ZFIP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
          <a href="#" class="brand-text font-weight-light d-block"><?php echo $_SESSION['nombre'] ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Buscar">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>