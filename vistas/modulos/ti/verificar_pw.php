<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Verificar y Consultar Contraseñas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Contraseñas</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="active nav-link" href="#VerificarrPw" data-toggle="tab">Verificar Contraseñas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#ConsultarPwGeneral" data-toggle="tab">Consultar Actualizaciones</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- TAB PARA ACTUALIZAR LAS CONTRASEÑAS -->
                            <div class="active tab-pane" id="VerificarrPw">
                               
                                   <table class="display table table-striped table-bordered w-100 ">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Fecha Actualización</th>
                                            <th>Estado</th>
                                            <th>Informe</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $item = "estado_pw";
                                        $valor = "Proceso";

                                        $MostrarPw = ControladorPw::ctrMostrarPwIndividual($item, $valor);

                                        foreach ($MostrarPw as $key => $value) {
                                            $estado=$value["estado_pw"];
                                            $informe="<a href='extensiones/tcpdf/pdf/formato_pw.php?codigo={$value["id_detalle_pw"]}' target='_blank' class='btn bg-danger' title='Ver Informe'>
                                          <i class='fas fa-file-pdf'></i>
                                            </a>";
                                            switch ($estado) {
                                                case 'Proceso':
                                                    $estado_pw = "<span class='badge badge-info'>Proceso</span>";
                                                    
                                                    $boton="<button type='button' class='btn bg-warning' data-toggle='modal' data-target='#modalCerrarInventario' data-id_detalle_fk='{$value["id_detalle_fk"]}' title='Cerrar Inventario'>
                                                            <i class='far fa-edit'></i>
                                                          </button>";
                                                    break;
                                                case 'Verificado':
                                                    $estado_pw = "<span class='badge badge-success'>Verificado</span>";
                                                    $
                                                  $boton="<button type='button' class='btn bg-success'>
                                                    <i class='far fa-calendar-check'></i>
                                                  </button>";
                                                    break;
                                              
                                                default:
                                                    $estado_pw = "<span class='badge badge-secondary'>Desconocido</span>";
                                                    break;
                                            }

                                            echo ' <tr>
                                            <td>' . ($key + 1) . '</td>
                                            <td>' . $value["fecha_pw"] . '</td>
                                            <td>' . $estado_pw . '</td>
                                             <td>'.$informe.'</td>
                                             <td>'.$boton.'</td>
                                             ';

                                        }


                                        ?>

                                    </tbody>
                                </table>
                                
                            </div>
                            <!-- /.tab-pane -->

                            <!-- TAB PARA CONSULTAR LAS CONTRASEÑAS -->
                            <div class="tab-pane" id="ConsultarPwGeneral">
                                <table class="display table table-striped table-bordered w-100 ">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Fecha Actualización</th>
                                            <th>Estado</th>
                                            <th>Informe</th>
                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                      $item = "estado_pw";
                                        $valor = "Verificado";
                                        $MostrarPw = ControladorPw::ctrMostrarPwIndividual($item, $valor);

                                        foreach ($MostrarPw as $key => $value) {
                                            $estado=$value["estado_pw"];
                                            $informe="<a href='extensiones/tcpdf/pdf/formato_pw.php?codigo={$value["id_detalle_pw"]}' target='_blank' class='btn bg-danger' title='Ver Informe'>
                                          <i class='fas fa-file-pdf'></i>
                                            </a>";
                                            switch ($estado) {
                                                case 'Proceso':
                                                    $estado_pw = "<span class='badge badge-info'>Proceso</span>";
                                                   
                                                    break;
                                                case 'Verificado':
                                                    $estado_pw = "<span class='badge badge-success'>Verificado</span>";
                                                    
                                                
                                                    break;
                                              
                                                default:
                                                    $estado_pw = "<span class='badge badge-secondary'>Desconocido</span>";
                                                    break;
                                            }

                                            echo ' <tr>
                                            <td>' . ($key + 1) . '</td>
                                            <td>' . $value["fecha_pw"] . '</td>
                                            <td>' . $estado_pw . '</td>
                                             <td>'.$informe.'</td>
                                    
                                             ';

                                        }


                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>




