<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 pt-2">
        <div class="callout callout-warning">
          <h5><i class="fas fa-info"></i> Verifica que el proveedor no exista antes de registrar uno nuevo. </h5>
          <center>
            <button class="btn bg-success" data-toggle="modal" data-target="#modalCrearProveedor">
              <i class="fa fa-plus"></i> Agregar proveedor
            </button>
          </center>
        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
       
          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">


              <table class="table table-bordered table-striped  nowrap"
                id="tablaProveedores"
                style="width:100%">
                <thead>
                  <tr>
                    <th>NIT/ CC </th>
                    <th>Proveedor</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $proveedores = ControladorOrden::ctrMostrarProvedor();

                  foreach ($proveedores as $key => $prov) {
                    echo '<tr>
                <td>' . $prov["id_proveedor"] . '</td>
                <td>' . $prov["nombre_proveedor"] . '</td>
                <td>' . $prov["contacto_proveedor"] . '</td>
                <td>' . $prov["telefono_proveedor"] . '</td>
            </tr>';
                  }
                  ?>
                </tbody>
              </table>

            </div>
            <!-- /.col -->
          </div>

        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>



<!--MODAL PARA CREAR PROVEEDOR -->
<div class="modal fade" id="modalCrearProveedor" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form action="" class="formularioProveedor" method="POST">

        <div class="modal-header bg-primary">
          <h5 class="modal-title">Nuevo Proveedor de Compras</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>NIT / CC</label>
            <input type="number" class="form-control" name="id_proveedor" required>
          </div>
          <div class="form-group">
            <label>Nombre del proveedor</label>
            <input type="text" class="form-control" name="nombre_proveedor" required>
          </div>

          <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" class="form-control" name="contacto_proveedor" required>
          </div>

          <div class="form-group">
            <label>Teléfono</label>
            <input type="number" class="form-control" name="telefono_proveedor" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn bg-success">Guardar</button>
          <button type="button" class="btn bg-danger" data-dismiss="modal">Cancelar</button>
        </div>

        <?php
        $crearProveedor = new ControladorOrden();
        $crearProveedor->ctrCrearProveedorCompras();
        ?>

      </form>

    </div>
  </div>
</div>