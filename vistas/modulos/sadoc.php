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
                                <div id="sesion_SIG" class="bg-info">
                                  <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                                    <div id="subida_archivo" class=" pt-3 pb-2">
                                      <center>
                                        <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data" >
                                         <h3>Adjuntar Archivos : </h3>
                                         <div class="form-group mx-sm-3 mb-2">

                                          <input type="file" name="archivo"  class="form-control" required >
                                          <input type="hidden" name="id_proceso_fk" value="1" id="archivo_sig" class="form-control" required >
                                          <input type="hidden" name="proceso" value="SIG" id="proceso_sig" class="form-control" required >

                                        </div>
                                        <button type="submit" class="btn btn-success mb-2" name="subir">
                                          <span class=' fa fa-upload' aria-hidden='true'></span>
                                          Subir Archivo
                                        </button>
                                      </form>
                                    </center>
                                    <?php 
                                    include_once("php/upload_sadoc.php");
                                    ?>
                                  </div>  

                                </div>
                                <div id="archivos_SIG" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div id="include_SIG">
                                    <?php 
                                    include_once("php/upload_sadoc_folder.php");
                                    ?>
                                  </div>
                                </div>
                                <hr>
                                <legend></legend>
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
  echo "<thead>
            <tr>
              <th>#</th>
              <th>Nombre del Archivo</th>
              <th>Fecha de Actualización</th>
              <th>Ruta</th>
              <th>Opciones</th>
            </tr>
          </thead>";
  echo "<tbody>";

  $registros = 1;
  if (count($archivos) > 0) {
    foreach ($archivos as $row) {
      $nombre = basename($row["ruta"]);
      $previo = $row["ruta"];
      $id = $row["id"];

      echo "<tr class='sobras'>";
      echo "<td>" . $registros . "</td>";
      echo "<td>" . $nombre . "</td>";
      echo "<td>" . $row["Fecha_Subida"] . "</td>";
      echo "<td>" . $row["ruta"] . "</td>";
      echo "<td>";
      echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank"><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
      echo "</td>";
      echo "</tr>";
      $registros++;
    }
  }

  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}
?>
<?php

if ($_SESSION['id_proceso_fk'] == "JR") {
?>
  <script language='javascript'>
    activar_menus("JR");
  </script>
  <?php

} else {


  if ($_SESSION['id_proceso_fk'] == "TI") {
  ?>
    <script language='javascript'>
      activar_menus("TI");
    </script>
    <?php

  } else {

    if ($_SESSION['id_proceso_fk'] == "CT") {
    ?>
      <script language='javascript'>
        activar_menus("CT");
      </script>
      <?php

    } else {

      if ($_SESSION['id_proceso_fk'] == "TEC") {
      ?>
        <script language='javascript'>
          activar_menus("TEC");
        </script>
        <?php

      } else {

        if ($_SESSION['id_proceso_fk'] == "GH") {
        ?>
          <script language='javascript'>
            activar_menus("GH");
          </script>
          <?php

        } else {

          if ($_SESSION['id_proceso_fk'] == "GD") {
          ?>
            <script language='javascript'>
              activar_menus("GD");
            </script>
            <?php

          } else {

            if ($_SESSION['id_proceso_fk'] == "OP") {
            ?>
              <script language='javascript'>
                activar_menus("OP");
              </script>
              <?php

            } else {

              if ($_SESSION['id_proceso_fk'] == "PH") {
              ?>
                <script language='javascript'>
                  activar_menus("PH");
                </script>
                <?php

              } else {

                if ($_SESSION['id_proceso_fk'] == "GR") {
                ?>
                  <script language='javascript'>
                    activar_menus("GR");
                  </script>
                  <?php

                } else {

                  if ($_SESSION['id_proceso_fk'] == "SST") {
                  ?>
                    <script language='javascript'>
                      activar_menus("SST");
                    </script>
                    <?php

                  } else {

                    if ($_SESSION['id_proceso_fk'] == "SIG") {
                    ?>
                      <script language='javascript'>
                        activar_menus("SIG");
                      </script>
                      <?php

                    } else {

                      if ($_SESSION['id_proceso_fk'] != "SIG" && $_SESSION['id_proceso_fk'] != "SST" && $_SESSION['id_proceso_fk'] != "GR" && $_SESSION['id_proceso_fk'] != "PH" && $_SESSION['id_proceso_fk'] != "OP" && $_SESSION['id_proceso_fk'] != "GD" && $_SESSION['id_proceso_fk'] != "GH" && $_SESSION['id_proceso_fk'] != "TEC" && $_SESSION['id_proceso_fk'] != "CT" && $_SESSION['id_proceso_fk'] != "TI" && $_SESSION['id_proceso_fk'] != "JR") {
                      ?>
                        <script language='javascript'>
                          Desactivar_listado("<?php echo $_SESSION['id_proceso_fk']; ?>");
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