<?php
require_once "configuracion.php";


if ($_SESSION["ConsultarBascula"] == "NULL") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a data-toggle="tab" href="#panelcontabilidad" class=" nav-link">
        <i class="nav-icon fas fa-chart-line"></i>
        <p>Panel de Control</p>
      </a>
    </li>

    <li class="nav-item">
      <a data-toggle="tab" href="" class="nav-link">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
          Activos Fijos
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a data-toggle="tab" href="#qr" class="nav-link ">
            <i class="nav-icon fas fa-qrcode"></i>
            <p>
              QR
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="tab" href="#consultar_activos" class="nav-link ">
            <i class="nav-icon fas fa-tablet"></i>
            <p>
              Mis Activos
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="tab" href="#nuevo_activo" class="nav-link ">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>
              Nuevo Activo
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="tab" href="#inventario_activos" class="nav-link ">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Nuevo Inventario
              <span class="right badge badge-success">Crear</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="tab" href="#trasladar_activos" class="nav-link ">
            <i class="nav-icon fas fa-file-export"></i>
            <p>
              Trasladar Activos
              <span class="right badge badge-warning">Cambiar</span>
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a data-toggle="tab" href="#acta_movimiento" class="nav-link ">
            <i class="nav-icon  fas fa-file-signature"></i>
            <p>
              Actas de Movimiento

            </p>
          </a>
        </li>

        <li class="nav-item">
          <a data-toggle="tab" href="#manual_activos" class="nav-link ">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Manual
            </p>
          </a>

        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a data-toggle="tab" href="" class="nav-link">
        <i class="nav-icon fas fa-file-invoice-dollar"></i>
        <p>
          Ordenes de Compra
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a data-toggle="tab" href="#nueva_orden" class="nav-link ">
            <i class="nav-icon fas fa-qrcode"></i>
            <p>
              Nueva Orden de Compra
            </p>
          </a>
        </li>
        <?php
        $cargosLideres = [1, 4, 6, 7, 12, 14, 15];

        if (in_array($_SESSION['id_cargo_fk'], $cargosLideres)) {
          // aquí va el botón, acción o contenido

        ?>
          <li class="nav-item">
            <a data-toggle="tab" href="#OrdenesLideres" class=" nav-link ">
              <i class=" nav-icon fas fa-search"></i>
              <p>
                Consultar Ordenes
              </p>
            </a>
          </li>
        <?php } ?>
        <?php
        $cargosGH = [5,6];

        if (in_array($_SESSION['id_cargo_fk'], $cargosGH)) {
          // aquí va el botón, acción o contenido

        ?>
          <li class="nav-item">
            <a data-toggle="tab" href="#Ordenes_GH" class=" nav-link ">
              <i class=" nav-icon fas fa-search"></i>
              <p>
                Análisis de Cotización
              </p>
            </a>
          </li>
        <?php } ?>
         <?php
        $cargosGR = [19,1];

        if (in_array($_SESSION['id_cargo_fk'], $cargosGR)) {
          // aquí va el botón, acción o contenido

        ?>
       <li class="nav-item">
            <a data-toggle="tab" href="#OrdenGerencia" class=" nav-link ">
              <i class=" nav-icon fas fa-search"></i>
              <p>
                Análisis de Cotización
              </p>
            </a>
          </li>
        <?php } ?>
        
        <?php
        $cargosCT = [12,13,1];

        if (in_array($_SESSION['id_cargo_fk'], $cargosCT)) {
          // aquí va el botón, acción o contenido
        ?>
        <li class="nav-item">
            <a data-toggle="tab" href="#Ordenes_CT" class=" nav-link ">
              <i class=" nav-icon fas fa-search"></i>
              <p>
                Ordenes Aprobadas
              </p>
            </a>
          </li>
        <?php } ?>
                <?php
        $cargosE = [12,13,5,6,1];

        if (in_array($_SESSION['id_cargo_fk'], $cargosE)) {
          // aquí va el botón, acción o contenido
        ?>
        <li class="nav-item">
            <a data-toggle="tab" href="#Ordenes_Ejecutadas" class=" nav-link ">
              <i class=" nav-icon fas fa-search"></i>
              <p>
                Ordenes Ejecutadas
              </p>
            </a>
          </li>
        <?php } ?>

        <li class="nav-item">
          <a data-toggle="tab" href="#manual_ordenes" class="nav-link ">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Manual
            </p>
          </a>

        </li>
      </ul>
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
          <!-- /.PANEL PRINCIPAL PARA MOSTRAR INFORMACIÓN RELACIONADA CON EL AREA CONTABLE-->
          <div id="panelcontabilidad" class="active tab-pane">
            <?php require "ct/panel_contabilidad.php"; ?>
          </div>
          <!-- /. CONSULTAR CODIGOS QR DE MIS ACTIVOS FIJOS -->
          <div id="qr" class="tab-pane">
            <?php require "ct/qr.php"; ?>
          </div>
          <!-- /. CIERRA CONSULTAR CODIGOS QR DE MIS ACTIVOS FIJOS -->
          <!-- /. CONSULTAR LOS ACTIVOS FIJOS DEL USUARIO QUE INICIO SESION -->
          <div id="consultar_activos" class="tab-pane">
            <?php require "ct/consultar_activos.php"; ?>

          </div>
          <!-- /. CIERRE DE CONSULTA DE LOS ACTIVOS FIJOS DEL USUARIO QUE INICIO SESION -->
          <!-- /. FORMULARIO PARA INGRESAR NUEVO ACTIVO FIJO -->
          <div id="nuevo_activo" class="tab-pane">
            <?php require "ct/form_activo.php"; ?>
          </div>
          <!-- /. INVENTARIO ACTIVOS FIJOS -->
          <div id="inventario_activos" class="tab-pane">
            <?php require "ct/inventario.php"; ?>
          </div>
          <!-- /. CIERRE INVENTARIO ACTIVOS FIJOS -->
          <!-- /. FORMULARIO PARA TRASLADAR LOS ACTIVOS -->
          <div id="trasladar_activos" class="tab-pane">
            <?php require "ct/transferir_activo.php"; ?>
          </div>
          <!-- /. CIERRE FORMULARIO PARA TRASLADAR LOS ACTIVOS -->
          <!-- /. ACTAS DE MOVIMIENTO ACTIVOS FIJOS -->
          <div id="acta_movimiento" class="tab-pane">
            <?php require "ct/acta_movimiento.php"; ?>
          </div>
          <!-- /. CIERRE ACTAS DE MOVIMIENTO ACTIVOS FIJOS -->

          <!-- /. MANUAL DE USO ACTIVOS FIJOS -->
          <div id="manual_activos" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <!-- Button trigger modal -->
                <div class="card">
                  <!-- /.card-header -->
                  <div style="position: relative; width: 100%; height: 0; padding-top: 56.2225%;
                    padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
                    border-radius: 8px; will-change: transform;">
                    <iframe loading="lazy" style="position: absolute; width: 100%; height: 80%; top: 0; left: 0; border: none; padding: 0;margin: 0;" src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAF2tA6dWWs&#x2F;view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
                    </iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- CIERRE DE MANUAL DE USO ACTIVOS FIJOS -->
          <!-- /. INVENTARIO ACTIVOS FIJOS -->
          <div id="nueva_orden" class="tab-pane">
            <?php require "ct/orden_compra.php"; ?>
          </div>

          <div id="OrdenesLideres" class="tab-pane">
            lideres
            <?php require "ct/consultar_orden.php"; ?>
          </div>

           <div id="Ordenes_GH" class="tab-pane">
            gh
            <?php require "ct/consultar_GH.php"; ?>
          </div>

           <div id="OrdenGerencia" class="tab-pane">
            gerencia
      
          </div>

           <div id="Ordenes_CT" class="tab-pane">
            contabilidad
            <?php require "ct/consultar_CT.php"; ?>
          </div>

           <div id="Ordenes_Ejecutadas" class="tab-pane">
            ejecutadas
            <?php require "ct/consultar_Ejecutadas.php"; ?>
          </div>

          <div id="manual_ordenes" class="tab-pane">
            Poner manual ordenes de compra
          </div>

        </div>
      </div>
    </div>
  </div>
</div>



</body>

</html>