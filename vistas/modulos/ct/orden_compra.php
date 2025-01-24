
          <!-- DIV DONDE SE MOSTRARA EL FORMULARIO PARA UNA NUEVA ORDEN DE COMPRA-->
          <div class="tab-pane " id="orden">
            <form action="" class="formularioCompra" method="POST">
              <div class="card card-navy">
                <div class="card-header">
                  <center>
                    <h4>Nueva Orden de Compra</h4>
                  </center>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 col-xs-6 col-sm-6">
                      <label>Id Usuario</label>
                      <input type="text" name="id_cotizante" id="id_cotizante" value="<?php echo $_SESSION['id'] ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-6 col-xs-6 col-sm-6">
                      <label>Cotizado Por :</label>
                      <input type="text" name="" value="<?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellidos_usuario'] ?>" class="form-control" readonly>
                    </div>
                    <?php
                    $id_cargo_fk = $_SESSION["id_cargo_fk"];
                    $nombre_cargo = ControladorOrden::ctrObtenerNombreCargo($id_cargo_fk);
                    ?>
                    <div class="col-md-6 col-xs-6 col-sm-6">
                      <label>Cargo</label>
                      <input type="text" name="" value="<?php echo htmlspecialchars($nombre_cargo, ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label>Fecha</label>
                      <input type="date" name="fecha_orden" class="form-control" id="fecha_orden" required>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label for="id_proveedor_fk" class="form-label">Proveedor</label>
                      <input class="form-control" list="datalistprovedor" id="id_proveedor_fk" placeholder="Identificación de Proveedor" name="id_proveedor_fk" required>
                      <datalist id="datalistprovedor">
                        <?php
                        $item = null;
                        $valor = null;
                        $proveedor = ControladorOrden::ctrMostrarProvedor($item, $valor);
                        foreach ($proveedor as $key => $value) {
                          echo '<option value="' . $value["id_proveedor"] . '"> ' . $value["nombre_proveedor"] . ' </option>';
                        }
                        ?>
                  
                      </datalist>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label>¿Es un Proveedor recurrente?</label>
                      <select name="proveedor_recurrente" id="proveedor_recurrente" class="form-control">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                   
                    <div class="col-12 bg-navy pt-2 mt-3 col-xs-12 col-sm-12">
                      <center>
                        <h5>Forma de Pago</h5>
                      </center>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Selecciona una Forma de Pago, dependiendo la seleccion deberas llenar lo restante</label>
                      <select class="form-control" id="forma_pago" name="forma_pago" required>
                        <option>Selecciona una Opcion</option>
                        <option value="Contado">Contado</option>
                        <option value="Credito">Credito</option>
                        <option value="Anticipo">Anticipo</option>
                        <option value="Otros">Otros</option>
                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="tiempo">
                      <label>Tiempo de pago en dias</label>
                      <input type="number" class="form-control input-lg" id="tiempo_pago" name="tiempo_pago">
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="porcentaje">
                      <label>Porcentaje del Anticipo</label>
                      <input type="number" class="form-control input-lg" id="porcentaje_anticipo" name="porcentaje_anticipo">
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="otros">
                      <label>Otras condiciones de la negociación</label>
                      <textarea class="form-control" id="condiciones_negociacion" name="condiciones_negociacion" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Comentarios</label>
                      <textarea class="form-control " id="comentario_orden" name="comentario_orden" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="tiempo">
                      <label>Tiempo de entrega en dias</label>
                      <input type="number" class="form-control input-lg" id="tiempo_entrega" name="tiempo_entrega">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <button type="submit" class="btn btn-success btn-block " id="enviar_orden" name="enviar_orden">Enviar Orden</button>
                </div>
              </div>
              <?php
              $crearOrden = new ControladorOrden();
              $crearOrden->ctrCrearOrden();
              ?>

            </form>
            <!-- /.card -->
          </div>
          <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script>
    $(document).ready(function() {
      $("#tiempo").hide();
      $("#porcentaje").hide();
      $("#otros").hide()
      $("#forma_pago").change(function() {
        var seleccion = $(this).val();
        switch (seleccion) {
          case "Credito":
            $("#tiempo").show();
            $("#porcentaje").hide();
            $("#otros").hide();
            break;
          case "Anticipo":
            $("#porcentaje").show();
            $("#tiempo").hide();
            $("#otros").hide();
            break;
          case "Otros":
            $("#otros").show();
            $("#tiempo").hide();
            $("#porcentaje").hide();
            break;
          default:
            $("#tiempo").hide();
            $("#porcentaje").hide();
            $("#otros").hide();
        }

      });
    })
    $('#editProveedorModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id_proveedor = button.data('id_proveedor'); // Extract info from data-* attributes
      var nombre_proveedor = button.data('nombre_proveedor');
      var correo_proveedor = button.data('correo_proveedor');
      var telefono_proveedor = button.data('telefono_proveedor');
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this);
      modal.find('.modal-body #id_proveedor').val(id_proveedor);
      modal.find('.modal-body #nombre_proveedor').val(nombre_proveedor);
      modal.find('.modal-body #correo_proveedor').val(correo_proveedor);
      modal.find('.modal-body #telefono_proveedor').val(telefono_proveedor);

    });

    $('#modal-rechazo').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id_orden = button.data('id_orden'); // Extract info from data-* attributes
      var nombre_usuario = button.data('nombre_usuario');
      var apellidos_usuario = button.data('apellidos_usuario');
      var fecha_orden = button.data('fecha_orden');
      var total_orden = button.data('total_orden');
      var correo_usuario = button.data('correo_usuario');
      var modal = $(this);
      modal.find('.modal-body #id_orden').val(id_orden);
      modal.find('.modal-body #nombre_usuario').val(nombre_usuario);
      modal.find('.modal-body #apellidos_usuario').val(apellidos_usuario);
      modal.find('.modal-body #fecha_orden').val(fecha_orden);
      modal.find('.modal-body #total_orden').val(total_orden);
      modal.find('.modal-body #correo_usuario').val(correo_usuario);

    });
  </script>