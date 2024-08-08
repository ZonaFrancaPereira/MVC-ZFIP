<?php
require_once "configuracion.php";




?>
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a data-toggle="tab" href="#panelsig" class="active nav-link">
        <i class="fas fa-desktop"></i>
        <p>Panel de Control</p>
      </a>
    </li>

    <li class="nav-item">
      <a  href="sadoc" class="nav-link">
      <i class="nav-icon fas fa-qrcode"></i>
        <p>
          SADOC
         
        </p>
      </a>
      </li>
      
        <li class="nav-item">
          <a data-toggle="tab" href="#qr" class="nav-link ">
            <i class="nav-icon fas fa-qrcode"></i>
            <p>
              ACPM
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

          <div id="panelsig" class="active tab-pane">
            <?php require "sig/panel_sig.php"; ?>

          </div>

        
          <!-- /. CIERRA CONSULTAR CODIGOS QR DE MIS ACTIVOS FIJOS -->
          <!-- /. CONSULTAR LOS ACTIVOS FIJOS DEL USUARIO QUE INICIO SESION -->
          <div id="acpm" class="tab-pane">
            <?php require "ct/consultar_activos.php"; ?>

          </div>
          <!-- /. CIERRE DE CONSULTA DE LOS ACTIVOS FIJOS DEL USUARIO QUE INICIO SESION -->

          


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

        </div>
      </div>
    </div>
  </div>
</div>



</body>

</html>