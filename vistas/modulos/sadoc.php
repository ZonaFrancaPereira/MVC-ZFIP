<?php
require_once "configuracion.php";




?>
<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item En_linea 1" role="presentation">
      <a href="#accesoRapido" class="nav-link " data-toggle="tab">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Acceso Rapido

        </p>
      </a>
    </li>
    <li class="nav-item En_linea 1" role="presentation">
      <a data-toggle="tab" href="#menu10" class="nav-link">
        <i class="nav-icon fas fa-user-tie"></i>
        <p>
          Gerencia
        </p>
      </a>
    </li>
    <li class="nav-item En_linea 12" role="presentation">
      <a data-toggle="tab" href="#menu12" class="nav-link">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>
          Planeacion Estrategica
        </p>
      </a>
    </li>
    <!-- SIG LISTA LA INTERFAZ -->
    <li class="nav-item En_linea 1" role="presentation">
      <a data-toggle="tab" href="#menu1" class="nav-link">
        <i class="nav-icon fas fa-poll"></i>
        <p>
          SIG
        </p>
      </a>
    </li>
    <li class="nav-item En_linea 9" role="presentation">
      <a data-toggle="tab" href="#menu9" class="nav-link">
        <i class="nav-icon fas fa-user-shield"></i>
        <p>SST</p>
      </a>
    </li>
    <li class="nav-item En_linea 2" role="presentation">
      <a data-toggle="tab" href="#menu2" class="nav-link">
        <i class="nav-icon fas fa-laptop-code"></i>
        <p>
          Gestion T.I
        </p>
      </a>
    </li>
    <li class="nav-item En_linea 3" role="presentation">
      <a data-toggle="tab" href="#menu3" class="nav-link">
        <i class="nav-icon fas fa-hand-holding-usd"></i>
        <p>Gestión Contable y Financiera</p>
      </a>
    </li>

    <li class="nav-item En_linea 4" role="presentation">
      <a data-toggle="tab" href="#menu4" class="nav-link">
        <i class="nav-icon fas fa-wrench"></i>
        <p>Gestión Técnica</p>
      </a>
    </li>

    <li class="nav-item En_linea 5" role="presentation">
      <a data-toggle="tab" href="#menu5" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Gestión Administrativa</p>
      </a>
    </li>
    <li class="nav-item En_linea 6" role="presentation">
      <a data-toggle="tab" href="#menu6" class="nav-link">
        <i class="nav-icon fas fa-folder-open"></i>
        <p>Gestión Documental</p>
      </a>
    </li>
    <li class="nav-item En_linea 7" role="presentation">
      <a data-toggle="tab" href="#menu7" class="nav-link">
        <i class="nav-icon fas fa-people-carry"></i>
        <p>Gestión Operaciones</p>
      </a>
    </li>
    <li class="nav-item En_linea 8" role="presentation">
      <a data-toggle="tab" href="#menuJR" class="nav-link">
        <i class="nav-icon fas fa-gavel"></i>
        <p>Gestión Jurídica </p>
      </a>
    </li>
    <li class="nav-item En_linea 8" role="presentation">
      <a data-toggle="tab" href="#menu8" class="nav-link">
        <i class="nav-icon fas fa-shield-alt"></i>
        <p>Seguridad </p>
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
          <!-- Despliegue de información...#menu1 SIG TERMINADO -->
          <div id="menu1" class="tab-pane fade">
            <div class="callout callout-success text-center">
              <?php generarModalConFormulario("modal-SIG", " Archivos Sistema Integrado de Gestión", "Código ej: FO-", 1, "SIG"); ?>
            </div>
            
          </div>
          <!-- Despliegue de información...#menu1 SIG TERMINADO -->
          <div id="menu2" class="tab-pane fade">
          <div class="callout callout-success text-center">
            <?php generarModalConFormulario("modal-TI", "Archivos Gestión TI", "Código ej: FO-", 2, "TI"); ?>

            </div>
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
  echo '<!-- Botón para activar el modal -->';
  echo '<button type="button" class="btn bg-success" data-toggle="modal" data-target="#' . $modalId . '">';
  echo '  ' . $tituloModal;
  echo '</button>
  <div class="row">
              <div class="col-md-6 pt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita nam sunt quaerat eveniet voluptatum delectus totam ullam quisquam, accusamus, eligendi nulla maiores magnam cum dicta dolorum voluptates fuga architecto. Ullam!</div>
              <div class="col-md-6 pt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta rerum, modi suscipit assumenda qui aliquam, fuga deserunt id quidem quas alias ipsa saepe. Ullam in tempore neque, veritatis excepturi tenetur?</div>
            </div>';

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
  generarFormulario($codigo, $id_proceso_fk, $proceso);
  echo '            </div>';

  echo '        </div>';
  echo '        <!-- /.modal-content -->';
  echo '    </div>';
  echo '    <!-- /.modal-dialog -->';
  echo '</div>';
  echo '<!-- /.modal -->';
}
?>

?>

<?php

if ($_SESSION['siglas_proceso'] == "JR") {
?>
  <script language='javascript'>
    activar_menus("JR");
  </script>
  <?php

} else {


  if ($_SESSION['siglas_proceso'] == "TI") {
  ?>
    <script language='javascript'>
      activar_menus("TI");
    </script>
    <?php

  } else {

    if ($_SESSION['siglas_proceso'] == "CT") {
    ?>
      <script language='javascript'>
        activar_menus("CT");
      </script>
      <?php

    } else {

      if ($_SESSION['siglas_proceso'] == "TEC") {
      ?>
        <script language='javascript'>
          activar_menus("TEC");
        </script>
        <?php

      } else {

        if ($_SESSION['siglas_proceso'] == "GH") {
        ?>
          <script language='javascript'>
            activar_menus("GH");
          </script>
          <?php

        } else {

          if ($_SESSION['siglas_proceso'] == "GD") {
          ?>
            <script language='javascript'>
              activar_menus("GD");
            </script>
            <?php

          } else {

            if ($_SESSION['siglas_proceso'] == "OP") {
            ?>
              <script language='javascript'>
                activar_menus("OP");
              </script>
              <?php

            } else {

              if ($_SESSION['siglas_proceso'] == "PH") {
              ?>
                <script language='javascript'>
                  activar_menus("PH");
                </script>
                <?php

              } else {

                if ($_SESSION['siglas_proceso'] == "GR") {
                ?>
                  <script language='javascript'>
                    activar_menus("GR");
                  </script>
                  <?php

                } else {

                  if ($_SESSION['siglas_proceso'] == "SST") {
                  ?>
                    <script language='javascript'>
                      activar_menus("SST");
                    </script>
                    <?php

                  } else {

                    if ($_SESSION['siglas_proceso'] == "SIG") {
                    ?>
                      <script language='javascript'>
                        activar_menus("SIG");
                      </script>
                      <?php

                    } else {

                      if ($_SESSION['siglas_proceso'] != "SIG" && $_SESSION['siglas_proceso'] != "SST" && $_SESSION['siglas_proceso'] != "GR" && $_SESSION['siglas_proceso'] != "PH" && $_SESSION['siglas_proceso'] != "OP" && $_SESSION['siglas_proceso'] != "GD" && $_SESSION['siglas_proceso'] != "GH" && $_SESSION['siglas_proceso'] != "TEC" && $_SESSION['siglas_proceso'] != "CT" && $_SESSION['siglas_proceso'] != "TI" && $_SESSION['siglas_proceso'] != "JR") {
                      ?>
                        <script language='javascript'>
                          Desactivar_listado("<?php echo $_SESSION['siglas_proceso']; ?>");
                        </script>
<?php

                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}
?>
</body>

</html>