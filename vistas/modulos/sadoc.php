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

            <?php generarModalConFormulario("modal-SIG", "Archivos Sistema Integrado de Gestión", "Código ej: SIG-", 1, "SIG"); ?>

          </div>

          <div id="menu2" class="tab-pane fade <?php echo ($activeTab === 'menu2') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-TI", "Archivos Tecnología e Informática", "Código ej: TI-", 2, "TI"); ?>

          </div>

          <div id="menu3" class="tab-pane fade <?php echo ($activeTab === 'menu3') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-CT", "Archivos Contabilidad", "Código ej: CT-", 3, "CT"); ?>

          </div>

          <div id="menu4" class="tab-pane fade <?php echo ($activeTab === 'menu4') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-TEC", "Archivos Técnico", "Código ej: TEC-", 4, "TEC"); ?>

          </div>

          <div id="menu5" class="tab-pane fade <?php echo ($activeTab === 'menu5') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-GH", "Archivos Gestión Humana", "Código ej: GH-", 5, "GH"); ?>

          </div>

          <div id="menu6" class="tab-pane fade <?php echo ($activeTab === 'menu6') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-GD", "Archivos Gestión Documental", "Código ej: GD-", 6, "GD"); ?>

          </div>

          <div id="menu7" class="tab-pane fade <?php echo ($activeTab === 'menu7') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-OP", "Archivos Operaciones", "Código ej: OP-", 7, "OP"); ?>

          </div>

          <div id="menu9" class="tab-pane fade <?php echo ($activeTab === 'menu9') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-SST", "Archivos Seguridad Salud en el Trabajo", "Código ej: SST-", 9, "SST"); ?>

          </div>

          <div id="menu10" class="tab-pane fade <?php echo ($activeTab === 'menu10') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-GR", "Archivos Gerencia", "Código ej: GR-", 10, "GR"); ?>

          </div>

          <div id="menu11" class="tab-pane fade <?php echo ($activeTab === 'menu11') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-JR", "Archivos Gestión Jurídica", "Código ej: JR-", 11, "JR"); ?>

          </div>

          <div id="menu12" class="tab-pane fade <?php echo ($activeTab === 'menu12') ? 'show active' : ''; ?>">

            <?php generarModalConFormulario("modal-PLE", "Archivos Planeación Estratégica", "Código ej: PLE-", 12, "PLE"); ?>

          </div>

          <div id="menu13" class="tab-pane fade <?php echo ($activeTab === 'menu13') ? 'show active' : ''; ?>">
            

            <?php generarModalConFormulario("modal-SG", "Archivos Seguridad", "Código ej: SG-", 13, "SG"); ?>

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


function generarModalConFormulario($modalId, $tituloModal, $codigo, $id_proceso_fk, $proceso)
{



  echo '<!-- Modal -->';
  echo '<div class="modal fade" id="' . $modalId . '">';
  echo '    <div class="modal-dialog modal-lg">';
  echo '        <div class="modal-content">';
  echo '            <div class="modal-header">';
  echo '                <h4 class="modal-title">' . $tituloModal . '</h4>';
  echo '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
  echo '                    <span aria-hidden="true">&times;</span>';
  echo '                </button>';
  echo '            </div>';
  echo '            <div class="modal-body">';

  echo '            </div>';

  echo '        </div>';
  echo '        <!-- /.modal-content -->';
  echo '    </div>';
  echo '    <!-- /.modal-dialog -->';
  echo '</div>';
  echo '<!-- /.modal -->';

  echo '
  <!-- Main content -->
  <section class="content">
  
      <!-- Default box -->
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">Gestión de Archivos  :' . $proceso . ' :</h3> <br>
  
              <div class="row panel panel-default">
                  <div class="col-md-4 col-lg-4 text-center">
                      <button class="btn btn-primary">Crear Carpeta</button>
                  </div>
                  <div class="col-md-8 col-lg-8">';
  generarFormulario($codigo, $id_proceso_fk, $proceso);
  echo '
                  </div>
              </div>
          </div>
  
          <div class="card-body">
              <div class="row">
                  <div class="col-12 col-md-5 col-lg-5">
                      <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                          <thead class="thead-light">
                              <tr>
                                  <th class="text-center">#</th>
                                  <th><b>Carpetas</b></th>
                                  <th class="text-center">
                                      <div id="panel_' . $proceso . '">
                                          <center>
                                              <a id="volver_' . $proceso . '">
                                                  <button class="volver_' . $proceso . ' btn btn-info">
                                                      <i class="fa fa-chevron-left"></i>
                                                      Volver
                                                  </button>
                                              </a>
                                              <a id="recargar_' . $proceso . '">
                                                  <button class="btn btn-success">
                                                      <i class="fa fa-home"></i>
                                                      Panel Principal
                                                  </button>
                                              </a>
                                          </center>
                                      </div>
                                  </th>
                              </tr>
                          </thead>
                          <tbody id="folder_' . $proceso . '">
                          </tbody>
                      </table>
                  </div>
                  <div class="col-6 col-md-7 col-lg-7">
                      <div class="row">
                          <div class="col-12">
                              <table class="informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                                  <thead class="thead-light">
                                      <tr>
                                          <th>#</th>
                                          <th>Nombre del Archivo</th>
                                          <th>Fecha de Actualización</th>
                                          <th>Vista Previa</th>
                                          <th>X</th>
                                      </tr>
                                  </thead>
                                  <tbody id="descargas_' . $proceso . '">
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /.card-body -->
      </div>
      <!-- /.card -->

  </section>
  <!-- /.content -->
  ';
}

?>



</body>

</html>