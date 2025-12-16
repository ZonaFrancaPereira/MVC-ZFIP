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
       <!-- /.col -->
     </div>
   </section>
   <!-- /.content -->
 </div>
 <!-- /.control-sidebar -->
 </div>