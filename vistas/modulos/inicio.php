 <!-- Sidebar Menu -->
 <nav class="mt-2">
   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     <li class="nav-item En_linea 1" role="presentation" hidden>
       <a data-toggle="tab" href="#acpm" class="nav-link">
         <i class="nav-icon far fa-smile-wink"></i>
         <p>
           Novedades
         </p>
       </a>
     </li>
     <li class="nav-item En_linea 1" role="presentation" hidden>
       <a data-toggle="tab" href="#acpm" class="nav-link">
         <i class="nav-icon far fa-smile-wink"></i>
         <p>
           Enviar Comentario
         </p>
       </a>
     </li>
   </ul>
 </nav>
 <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->
 </aside>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Dashboard</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">Dashboard v1</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
     <!-- Info boxes -->
     <div class="row">
       <div class="col-md-4 col-sm-6 col-12">
         <div class="info-box bg-primary">
           <span class="info-box-icon"><i class="fas fa-tv"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Activos Fijos</span>
             <h3><?= $totalActivos ?></h3>

             <div class="progress">
               <div class="progress-bar" style="width:<?= $totalActivos ?>%"></div>
             </div>
             <span class="progress-description">
               Cantidad de Activos Asignados
             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-4 col-sm-6 col-12">
         <div class="info-box bg-danger">
           <span class="info-box-icon"><i class="fas fa-trash"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Inactivos</span>
             <h3><?= $totalInactivos ?></h3>
             <div class="progress">
               <div class="progress-bar" style="width: <?= $totalInactivos ?>%"></div>
             </div>
             <span class="progress-description">
               Activos dados de baja
             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->

       <!-- fix for small devices only -->
       <div class="clearfix hidden-md-up"></div>

       <div class="col-md-4 col-sm-6 col-12">
         <div class="info-box bg-success">
           <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Ordenes de Compra</span>
             <h3><?= $totalOrden ?></h3>
             <div class="progress">
               <div class="progress-bar" style="width: 2%"></div>
             </div>
             <span class="progress-description">
               Esperando aprobación
             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <?php
        $cargosE = [5, 6, 12, 13, 19];

        if (in_array($_SESSION['id_cargo_fk'], $cargosE)) {
          // aquí va el botón, acción o contenido
        ?>
         <div class="col-md-12 col-sm-12 col-12">

           <?php
            $ordenes = ControladorOrden::ctrBandejaOrdenes();
            $cargo = $_SESSION["id_cargo_fk"];
            ?>

           <div class="card-body p-0">
             <div class="table-responsive">

               <table class="table table-bordered table-striped  nowrap display"
                 id=""
                 style="width:100%">
                 <thead>
                   <tr>
                     <th>#</th>
                     <th>Fecha</th>
                     <th>Usuario</th>
                     <th>Proveedor</th>

                     <th>Total</th>
                     <th>Estado</th>
                     <th>PDF</th>
                     <th>Acción</th>
                   </tr>
                 </thead>
                 <tbody>

                   <?php foreach ($ordenes as $key => $o):
                      $estado = trim($o["estado_orden"]);
                      $badge  = "bg-secondary";

                      switch ($estado) {
                        case "Analisis de Cotizacion":
                          $badge = "bg-warning";
                          break;
                        case "Proceso":
                          $badge = "bg-warning";
                          break;
                        case "Aprobada":
                          $badge = "bg-success";
                          break;
                        case "Denegada":
                          $badge = "bg-danger";
                          break;
                        case "Ejecutada":
                          $badge = "bg-info";
                          break;
                      }
                    ?>
                     <tr>
                       <td><?= $o["id_orden"] ?></td>
                       <td><?= $o["fecha_orden"] ?></td>
                       <td><?= $o["nombre"] ?> <?= $o["apellidos_usuario"] ?></td>
                       <td><?= $o["nit_proveedor"] ?> - <?= $o["nombre_proveedor"] ?></td>
                       <td>$ <?= number_format($o["total_orden"], 0, ",", ".") ?></td>

                       <td class="text-center">
                         <span class="badge <?= $badge ?>">
                           <?= $estado ?>
                         </span>

                       </td>

                       <td>
                         <a href="extensiones/tcpdf/pdf/orden_compra.php?id=<?= $o["id_orden"] ?>"
                           target="_blank"
                           class="btn btn-danger btn-sm">
                           PDF
                         </a>
                       </td>

                       <td>

                         <?php if (in_array($cargo, [5, 6])): ?>
                           <div class="btn-group">

                             <!-- APROBAR / ENVIAR A PROCESO -->
                             <button
                               class="btn btn-success btn-sm btnGH"
                               data-id="<?= $o["id_orden"] ?>"
                               data-estado="Proceso"
                               title="Enviar a Gerencia">
                               <i class="fa fa-thumbs-up"></i>
                             </button>

                             <!-- DENEGAR -->
                             <button
                               class="btn btn-danger btn-sm btnDenegarOrden"
                               data-id="<?= $o["id_orden"] ?>"
                               title="Denegar orden">
                               <i class="fas fa-thumbs-down"></i>
                             </button>

                           </div>
                         <?php endif; ?>


                         <?php if (in_array($cargo, [19])): ?>
                           <div class="btn-group">

                             <!-- APROBAR / ENVIAR A PROCESO -->
                             <button
                               class="btn btn-success btn-sm btnGR"
                               data-id="<?= $o["id_orden"] ?>"
                               data-estado="Aprobada"
                               title="Enviar a Contabilidad">
                               <i class="fa fa-thumbs-up"></i>
                             </button>

                             <!-- DENEGAR -->
                             <button
                               class="btn btn-danger btn-sm btnDenegarOrden"
                               data-id="<?= $o["id_orden"] ?>"
                               title="Denegar orden">

                               <i class="fas fa-thumbs-down"></i>
                             </button>

                           </div>
                         <?php endif; ?>

                         <?php if (in_array($cargo, [12, 13])): ?>
                           <!-- APROBAR / ENVIAR A PROCESO -->
                           <button
                             class="btn btn-success btn-sm btnCT"
                             data-id="<?= $o["id_orden"] ?>"
                             data-estado="Ejecutada"
                             title="Ejecutar Orden">
                             <i class="fas fa-thumbs-up"></i>
                           </button>
                         <?php endif; ?>

                       </td>

                     </tr>
                   <?php endforeach; ?>

                 </tbody>
               </table>
             </div>
           </div>
         </div>
       <?php } ?>

     <?php
$rows = ControladorOrden::ctrOrdenesPresupuestadoPorUsuario();

$usuarios = array_column($rows, 'usuario');
$si = array_map(fn($r) => (int)$r['presupuestadas'], $rows);
$no = array_map(fn($r) => (int)$r['no_presupuestadas'], $rows);
?>

<div class="col-md-12 col-sm-12 col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Órdenes por Usuario (Presupuestado)</h3>
    </div>
    <div class="card-body">
     <div style="overflow-x: auto;">
  <div style="min-width: 1600px;">
    <canvas id="chartOrdenesPorUsuario" height="50"></canvas>
  </div>
</div>

    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const ctx = document.getElementById('chartOrdenesPorUsuario').getContext('2d');

  const usuarios = <?= json_encode($usuarios, JSON_UNESCAPED_UNICODE) ?>;
  const presupuestadas = <?= json_encode($si) ?>;
  const noPresupuestadas = <?= json_encode($no) ?>;

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: usuarios,
      datasets: [
        { label: 'Si', data: presupuestadas, backgroundColor: '#28a745' },
        { label: 'No', data: noPresupuestadas, backgroundColor: '#dc3545' }
      ]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
  });
});
</script>


       <!-- /.col -->
     </div>
   </section>
   <!-- /.content -->
 </div>
 <!-- /.control-sidebar -->
 </div>