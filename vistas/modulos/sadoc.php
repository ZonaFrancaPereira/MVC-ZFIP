<!-- Sidebar Menu -->
<?php
// Asegúrate de iniciar la sesión al principio del script
session_start();

// Obtener las siglas del proceso de la variable de sesión
$procesoActivo = isset($_SESSION['siglas_proceso']) ? $_SESSION['siglas_proceso'] : '';
//echo $procesoActivo;

// Determina cuál es la pestaña activa
$activeTab = "";
switch ($procesoActivo) {
  case 'SIG':
    $activeTab = 'menu1';
    break;
  case 'TI':
    $activeTab = 'menu2';
    break;
  case 'AC':
    $activeTab = 'accesoRapido';
    break;
  case 'CT':
    $activeTab = 'menu3';
    break;
  case 'TEC':
    $activeTab = 'menu4';
    break;
  case 'GH':
    $activeTab = 'menu5';
    break;
  case 'GD':
    $activeTab = 'menu6';
    break;
  case 'OP':
    $activeTab = 'menu7';
    break;
  case 'SST':
    $activeTab = 'menu9';
    break;
  case 'GR':
    $activeTab = 'menu10';
    break;
  case 'JR':
    $activeTab = 'menu11';
    break;
  case 'PLE':
    $activeTab = 'menu12';
    break;
  case 'SG':
    $activeTab = 'menu13';
    break;
}
?>

<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cogs"></i>
        <p>
          Administrar Sadoc
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#categorias-container" class="nav-link" data-toggle="tab">
            <i class="far fa-circle nav-icon"></i>
            <p>Administrar Categorías</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#gestionarArchivos" class="nav-link" data-toggle="tab">
            <i class="far fa-circle nav-icon"></i>
            <p>Gestionar Archivos</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'AC') ? 'active' : ''; ?>" role="presentation">
      <a href="#accesoRapido" class="nav-link" data-toggle="tab">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Acceso Rápido</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'GR') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu10" class="nav-link">
        <i class="nav-icon fas fa-user-tie"></i>
        <p>Gerencia</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'PLE') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu12" class="nav-link">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>Planeación Estratégica</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'SIG') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu1" class="nav-link">
        <i class="nav-icon fas fa-poll"></i>
        <p>SIG</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'SST') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu9" class="nav-link">
        <i class="nav-icon fas fa-user-shield"></i>
        <p>SST</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'TI') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu2" class="nav-link">
        <i class="nav-icon fas fa-laptop-code"></i>
        <p>Gestión T.I</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'CT') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu3" class="nav-link">
        <i class="nav-icon fas fa-hand-holding-usd"></i>
        <p>Gestión Contable y Financiera</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'TEC') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu4" class="nav-link">
        <i class="nav-icon fas fa-wrench"></i>
        <p>Gestión Técnica</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'GH') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu5" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Gestión Administrativa</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'GD') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu6" class="nav-link">
        <i class="nav-icon fas fa-folder-open"></i>
        <p>Gestión Documental</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'OP') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu7" class="nav-link">
        <i class="nav-icon fas fa-people-carry"></i>
        <p>Gestión Operaciones</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'JR') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu11" class="nav-link">
        <i class="nav-icon fas fa-gavel"></i>
        <p>Gestión Jurídica</p>
      </a>
    </li>
    <li class="nav-item <?php echo ($procesoActivo === 'SG') ? 'active' : ''; ?>" role="presentation">
      <a data-toggle="tab" href="#menu13" class="nav-link">
        <i class="nav-icon fas fa-shield-alt"></i>
        <p>Seguridad</p>
      </a>
    </li>
  </ul>
</nav>
</div>
<!-- /.sidebar -->
</aside>


<div class="content-wrapper">
  <div id="wrapper" class="toggled">

    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="tab-content card">

          <div id="categorias-container" class="tab-pane fade">
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <br>
                    <div class="card">
                      <div class="card-header bg-primary">
                        <h3 class="card-title">Administrar Categorías</h3>
                      </div>
                      <div class="card-body">
                        <div class="card card-primary card-outline">
                          <div class="card-header p-0">
                            <!-- Pestañas -->
                            <ul class="nav nav-tabs" id="categoriasTab" role="tablist">
                              <li class="nav-item bg-success">
                                <a class="nav-link" data-toggle="modal" data-target="#modal-categoria">
                                  Nueva Categoría
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link active" id="categorias-tab" data-toggle="tab" href="#tab-categorias" role="tab" aria-controls="tab-categorias" aria-selected="true">
                                  Categorías
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="asignar-categorias-tab" data-toggle="tab" href="#tab-asignar-categorias" role="tab" aria-controls="tab-asignar-categorias" aria-selected="false">
                                  Asignar Categorías
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div class="card-body">
                            <!-- Contenido de las pestañas -->
                            <div class="tab-content" id="categoriasTabContent">
                              <!-- Pestaña Categorías -->
                              <div class="tab-pane fade show active" id="tab-categorias" role="tabpanel" aria-labelledby="categorias-tab">
                                <div class="card card-primary card-outline">
                                  <div class="card-header">
                                    <h3 class="card-title">Listado de Categorías</h3>
                                  </div>
                                  <br>
                                  <div class="card-body">
                                    <?php
                                    $categoria = ControladorSadoc::mostrarCategorias($id_id_proceso_fk);
                                    ?>
                                    <table class="display table table-striped table-bordered table-hover w-100">
                                      <thead class="text-center">
                                        <tr>
                                          <th>#</th>
                                          <th>Nombre</th>
                                          <th>Descripción</th>
                                          <th>Estado</th>
                                          <th>Acciones</th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                        <?php
                                        foreach ($categoria as $rowc) {
                                          $id_categoria = $rowc["id_categoria"];
                                          $nombre_categoria = $rowc["nombre_categoria"];
                                          $descripcion_categoria = $rowc["descripcion_categoria"];
                                          $estado_categoria = $rowc["estado_categoria"];
                                          echo "<tr>";
                                          echo "<td class='text-center'>" . $id_categoria . "</td>";
                                          echo "<td>" . $nombre_categoria . "</td>";
                                          echo "<td>" . $descripcion_categoria . "</td>";
                                          echo "<td>" . $estado_categoria . "</td>";
                                          echo "<td class='text-center'>";
                                          echo "<button class='btn bg-warning btn-sm'><i class='fas fa-edit'></i> Editar</button>";
                                          echo "<button class='btn bg-danger btn-sm'><i class='fas fa-trash-alt'></i> Eliminar</button>";
                                          echo "</td>";
                                          echo "</tr>";
                                        }
                                        ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <!-- Pestaña Asignar Categorías -->
                              <div class="tab-pane fade" id="tab-asignar-categorias" role="tabpanel" aria-labelledby="asignar-categorias-tab">
                                <p>Contenido de la pestaña <strong>Asignar Categorías</strong>.</p>
                              </div>
                              <?php require "sadoc/categoria_sadoc.php"; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>


          <div id="gestionarArchivos" class="tab-pane fade">
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <br>
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Gestionar Archivos</h3>
                      </div>
                      <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in venenatis enim. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
          <!-- DESPLIEGUE DE INFORMACIÓN ACCESO RAPIDO ARCHIVOS Y RUTAS -->
          <div id="accesoRapido" class="tab-pane fade">
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <br>
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Búsqueda General de Archivos</h3>

                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="card">
                          <div class="card-header p-2">
                            <!-- Navegación por pestañas -->
                            <ul class="nav nav-pills">
                              <li class="nav-item"><a class="nav-link active" href="#gerencia" data-toggle="tab">Gerencia</a></li>
                              <li class="nav-item"><a class="nav-link" href="#planeacion" data-toggle="tab">Plantación Estratégica</a></li>
                              <li class="nav-item"><a class="nav-link" href="#sig" data-toggle="tab">SIG</a></li>
                              <li class="nav-item"><a class="nav-link" href="#ti" data-toggle="tab">Gestión T.I</a></li>
                              <li class="nav-item"><a class="nav-link" href="#contabilidad" data-toggle="tab">Gestión Contable y Financiera</a></li>
                              <li class="nav-item"><a class="nav-link" href="#tecnica" data-toggle="tab">Gestión Técnica</a></li>
                              <li class="nav-item"><a class="nav-link" href="#gh" data-toggle="tab">Gestión Administrativa</a></li>
                              <li class="nav-item"><a class="nav-link" href="#documental" data-toggle="tab">Gestión Documental</a></li>
                              <li class="nav-item"><a class="nav-link" href="#op" data-toggle="tab">Gestión de Operaciones</a></li>
                              <li class="nav-item"><a class="nav-link" href="#seguridad" data-toggle="tab">Seguridad</a></li>
                              <li class="nav-item"><a class="nav-link" href="#sst" data-toggle="tab">SST</a></li>
                            </ul>
                          </div><!-- /.card-header -->

                          <div class="card-body">
                            <div class="tab-content">
                              <div class="active tab-pane" id="gerencia">
                                <?php generarTabla(10); ?>
                              </div>
                              <div class=" tab-pane" id="planeacion">
                                <?php generarTabla(21); ?>
                              </div>
                              <div class=" tab-pane" id="sig">
                                <?php generarTabla(1); ?>
                              </div>
                              <div class=" tab-pane" id="ti">
                                <?php generarTabla(2); ?>
                              </div>
                              <div class=" tab-pane" id="contabilidad">
                                <?php generarTabla(3); ?>
                              </div>
                              <div class=" tab-pane" id="tecnica">
                                <?php generarTabla(4); ?>
                              </div>
                              <div class=" tab-pane" id="gh">
                                <?php generarTabla(5); ?>
                              </div>
                              <div class=" tab-pane" id="documental">
                                <?php generarTabla(6); ?>
                              </div>
                              <div class=" tab-pane" id="op">
                                <?php generarTabla(7); ?>
                              </div>
                              <div class=" tab-pane" id="seguridad">
                                <?php generarTabla(13); ?>
                              </div>
                              <div class=" tab-pane" id="sst">

                                <?php generarTabla(9); ?>
                              </div>
                            </div>
                          </div><!-- /.card-body -->
                        </div><!-- /.card -->
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->
                  </div><!-- /.col-12 -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->

            </section><!-- /.content -->
          </div><!-- /.tab-pane -->

          <div id="menu1" class="tab-pane fade <?php echo ($activeTab === 'menu1') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-SIG", "Archivos Sistema Integrado de Gestión", "Código ej: SIG-", 1, "SIG"); ?>
          </div>

          <div id="menu2" class="tab-pane fade <?php echo ($activeTab === 'menu2') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-TI", "Archivos Tecnología e Informática", "Código ej: TI-", 2, "TI"); ?>
          </div>

          <div id="menu3" class="tab-pane fade <?php echo ($activeTab === 'menu3') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-CT", "Archivos Contabilidad", "Código ej: CT-", 3, "CT"); ?>
          </div>

          <div id="menu4" class="tab-pane fade <?php echo ($activeTab === 'menu4') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-TEC", "Archivos Técnico", "Código ej: TEC-", 4, "TEC"); ?>
          </div>

          <div id="menu5" class="tab-pane fade <?php echo ($activeTab === 'menu5') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-GH", "Archivos Gestión Humana", "Código ej: GH-", 5, "GH"); ?>
          </div>

          <div id="menu6" class="tab-pane fade <?php echo ($activeTab === 'menu6') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-GD", "Archivos Gestión Documental", "Código ej: GD-", 6, "GD"); ?>
          </div>

          <div id="menu7" class="tab-pane fade <?php echo ($activeTab === 'menu7') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-OP", "Archivos Operaciones", "Código ej: OP-", 7, "OP"); ?>
          </div>

          <div id="menu9" class="tab-pane fade <?php echo ($activeTab === 'menu9') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-SST", "Archivos Seguridad Salud en el Trabajo", "Código ej: SST-", 9, "SST"); ?>
          </div>

          <div id="menu10" class="tab-pane fade <?php echo ($activeTab === 'menu10') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-GR", "Archivos Gerencia", "Código ej: GR-", 10, "GR"); ?>
          </div>

          <div id="menu11" class="tab-pane fade <?php echo ($activeTab === 'menu11') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-JR", "Archivos Gestión Jurídica", "Código ej: JR-", 11, "JR"); ?>
          </div>

          <div id="menu12" class="tab-pane fade <?php echo ($activeTab === 'menu12') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-PLE", "Archivos Planeación Estratégica", "Código ej: PLE-", 12, "PLE"); ?>
          </div>

          <div id="menu13" class="tab-pane fade <?php echo ($activeTab === 'menu13') ? 'show active' : ''; ?>">
            <?php generarPanelProceso("modal-SG", "Archivos Seguridad", "Código ej: SG-", 13, "SG"); ?>
          </div>
        </div><!-- /.tab-content card -->
      </div><!-- /.container-fluid -->
    </div><!-- /#page-content-wrapper -->
  </div><!-- /#wrapper -->
</div><!-- /.content-wrapper -->
<?php
function generarTabla($id_id_proceso_fk)
{
  $archivos = ControladorSadoc::mostrarArchivosPorProceso($id_id_proceso_fk);
  echo "<div class='table-responsive'>";
  echo "<table class='display table table-striped table-bordered w-100'>";
  echo "<thead class='text-center'>
              <tr>
                <th>Código</th>
                <th>Nombre del Archivo</th>
                <th>Fecha de Actualización</th>
                <th>Opciones</th>
              </tr>
          </thead>";
  echo "<tbody>";

  if (count($archivos) > 0) {
    foreach ($archivos as $row) {
      $nombre = basename($row["ruta"]);
      $previo = $row["ruta"];
      $codigo = $row["codigo"];
      $id = $row["id"];

      // Obtener la extensión del archivo
      $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

      // Determinar el ícono según la extensión
      $icon = "";
      switch ($ext) {
        case 'pdf':
          $icon = '<button class="btn bg-danger"><i class="fas fa-file-pdf" aria-hidden="true"></i></button>';
          break;
        case 'xls':
        case 'xlsx':
          $icon = '<button class="btn bg-success"><i class="fas fa-file-excel" aria-hidden="true"></i></button>';
          break;
        case 'doc':
        case 'docx':
          $icon = '<button class="btn bg-primary"><i class="fas fa-file-word" aria-hidden="true"></i></button>';
          break;
        case 'ppt':
        case 'pptx':
          $icon = '<button class="btn bg-warning"><i class="fas fa-file-powerpoint" aria-hidden="true"></i></button>';
          break;
        default:
          $icon = '<button class="btn bg-secondary"><i class="fas fa-file" aria-hidden="true"></i></button>';
          break;
      }

      echo "<tr class='sobras'>";
      echo "<td class='text-center'>" . $codigo . "</td>";
      echo "<td>" . $nombre . "</td>";
      echo "<td class='text-center'>" . $row["fecha_subida"] . "</td>";
      echo "<td class='text-center'>";
      echo '<a href="vistas/modulos/sig/descarga_archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank"> ' . $icon . '</a>';
      echo "</td>";
      echo "</tr>";
    }
  }

  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}


function generarFormulario($codigo, $id_proceso_fk, $proceso)
{
  echo '<form class="FormArchivos" action="" method="POST" enctype="multipart/form-data">';

  echo '  <div class="row">';
  echo '  <div class="col-md-6"><input type="text" class="form-control" name="codigo" id="codigo" placeholder="' . $codigo . '" required></div>';
  echo '      <div class="col-md-6"> <input type="file"  class="form-control" name="archivo" required></div>';
  echo '      <div class="col-md-6"> <input type="hidden" name="id_proceso_fk" value="' . $id_proceso_fk . '" class="form-control" required></div>';
  echo '      <div class="col-md-6"> <input type="hidden" name="carpeta" value="' . $proceso . '" class="form-control" required></div>';
  echo ' </div><br>';


  echo '  <button type="submit" class="btn bg-success btn-block" name="subir">';
  echo '      <span class="fa fa-upload" aria-hidden="true"></span> Subir Archivo';
  echo '  </button>
  
  ';
  if (isset($_POST['subir'])) {
    $crearSadoc = new ControladorSadoc();
    $crearSadoc->ctrCrearArchivo();
  }
  echo '</form>
  ';
}

function generarPanelProceso($modalId, $tituloModal, $codigo, $id_proceso_fk, $proceso)
{
  echo $modalId;
  echo $tituloModal;
  echo $codigo;
  echo $id_proceso_fk;
  echo $proceso;
}

?>

<!-- MODAL PARA CREAR NUEVA CATEGORIA -->




</body>

</html>