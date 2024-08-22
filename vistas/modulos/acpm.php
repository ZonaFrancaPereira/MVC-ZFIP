<?php
// Obtener el ID de ACPM desde la URL
$id_acpm = $_GET['id'];

?>


    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item En_linea 1" role="presentation">
          <a data-toggle="tab" href="#acpm" class="nav-link">
            <i class="nav-icon far fa-smile-wink"></i>
            <p>
              Novedades
            </p>
          </a>
        </li>
        <li class="nav-item En_linea 1" role="presentation">
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
<h1 class="text-center">ID ACPM <?php
echo $id_acpm;
?></h1>


</section>
    <!-- /.content -->
  </div>



  <!-- /.control-sidebar -->
</div>
