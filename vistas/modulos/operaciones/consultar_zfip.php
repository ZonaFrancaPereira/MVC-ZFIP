<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Inspecciones Realizadas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Inspecciones</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="tab-content">
                            <!-- /.TAB PARA MOSTRAR LOS PERFILES-->
                            <div class=" active tab-pane" id="">


                                <!-- TABLA PARA MOSTRAR LOS PERFILES CREADOS -->
                                <table class="display table table-bordered table-striped dt-responsive " width="100%">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Area Operación</th>
                                            <th>Tipo</th>
                                            <th># Transito</th>
                                            <th># FMM</th>
                                            <th># ARIN</th>
                                            <th>Cantidad de Bultos</th>
                                            <th>Estado</th>
                
                                            <th>Informe</th>
                                            <th>X</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $item = null;
                                        $valor = null;
                                        $inspeccion_zfip = ControladorInspeccion::ctrMostrarInspeccion($item, $valor);
                                        foreach ($inspeccion_zfip as $key => $value) {
                                            $estado = $value["estado"]; // Asigna el estado a una variable para simplificar
                                            $color = ''; // Variable para el color de fondo del span

                                            // Determinar el color según el estado
                                            if ($estado === 'bueno') {
                                                $color = 'badge badge-success';
                                            } elseif ($estado === 'regular') {
                                                $color = 'badge badge-warning';
                                            } elseif ($estado === 'malo') {
                                                $color = 'badge badge-danger';
                                            }
                                            echo '<tr><td>' . $value["id_inspeccion"] . '</td>';
                                            echo '<td>' . $value["fecha_inspeccion"] . '</td>';
                                            echo '<td>' . $value["id_cliente"] . '-' . $value["nombre_cliente"] . ' </td>';
                                            echo '<td>' . $value["ingreso_salida"] . '</td>';
                                            echo '<td> <p class="text-sm">Tipo
                                            ' . $value["nombre_categoriaop"] . ' </p><hr>
                                             <p class="text-sm">Otro : ' . $value["otro_operacion"] . '</p>
                                            </td>';
                                            echo '<td>' . $value["transito"] . '</td>';
                                            echo '<td>' . $value["fmm"] . '</td>';
                                            echo '<td>' . $value["arin"] . '</td>';
                                            echo '<td><p class="text-sm">Documento :  ' . $value["documento"] . ' </p><hr>
                                            <p class="text-sm">Físico :  ' . $value["fisico"] . '</p>
                                            </td>';
                                            echo '<td><span class="' . $color . ' text-uppercase">' . $estado . '</span></td>';
                                          
                                            echo '<td>
                                            <button class="btn bg-danger btnEliminarInspeccion" idCliente="' . $value[$i]["id_cliente"] . '" ><i class="fas  fa-file-pdf"></i></button></td>';
                                            echo '<td>
                                            <button class="btn btn-danger btnEliminarInspeccion" idCliente="' . $value[$i]["id_cliente"] . '" ><i class="fas fa-trash"></i></button></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                    </tbody>

                                </table>


                            </div>

                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>