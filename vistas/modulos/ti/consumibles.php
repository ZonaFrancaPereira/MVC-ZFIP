<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-primary font-weight-bold">Formulario de Compra de Consumibles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Consumibles</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Nav Tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
            <i class="fas fa-home"></i> Inicio
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="listar_consumibles-tab" data-toggle="tab" href="#listar_consumibles" role="tab" aria-controls="listar_consumibles" aria-selected="false">
            <i class="fas fa-list"></i> Consumibles
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="registrar_consumibles-tab" data-toggle="tab" href="#registrar_consumibles" role="tab" aria-controls="registrar_consumibles" aria-selected="false">
            <i class="fas fa-plus"></i> Registrar Consumible
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="agregar_factura-tab" data-toggle="tab" href="#agregar_factura" role="tab" aria-controls="agregar_factura" aria-selected="false">
            <i class="fas fa-file-invoice"></i> Ingresar Factura
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="listar_compras_consumibles-tab" data-toggle="tab" href="#listar_compras_consumibles" role="tab" aria-controls="listar_compras_consumibles" aria-selected="false">
            <i class="fas fa-history"></i> Compras de Consumibles
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="ingresar_consumible-tab" data-toggle="tab" href="#ingresar_consumible" role="tab" aria-controls="ingresar_consumible" aria-selected="false">
            <i class="fas fa-cogs"></i> Ingresar Consumible
        </a>
    </li>
</ul>
<!-- Tab Content -->
<div class="tab-content" id="myTabContent">


<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Consumibles Utilizados</h3>
                            </div>
                            <div class="card-body">
                                <table id="tabla-consumibles-utilizados" class="table table-bordered table-striped dt-responsive" width="100%">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Impresora</th>
                                            <th>consumible</th>
                                            <th>Fecha Instalacion</th>
                                            <th>Cantidad Utilizada</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
   
    <div class="tab-pane fade" id="listar_consumibles" role="tabpanel" aria-labelledby="listar_consumibles-tab">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Consumibles</h3>
                            </div>
                            <div class="card-body">
                                <table id="tabla-nombre-consumible" class="table table-bordered table-striped dt-responsive" width="100%">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Entradas</th>
                                            <th>Salidas</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="tab-pane fade" id="registrar_consumibles" role="tabpanel" aria-labelledby="registrar_consumibles-tab">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Ingresar Nombre Consumible</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre_consumible">Nombre del Consumible</label>
                                                <input type="text" class="form-control" id="nombre_consumible" name="nombre_consumible" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="guardar_consumible">Guardar Consumible</button>
                                    </div>
                                    <?php
                                    $CrearConsumible = new ControladorConsumibles();
                                    $CrearConsumible->ctrCrearConsumible();
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="tab-pane fade" id="agregar_factura" role="tabpanel" aria-labelledby="agregar_factura-tab">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ingreso de Datos de Compra</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_compra">Fecha de Compra</label>
                                    <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tipo de Consumible:</label>
                                <input list="tipo_consumibles" id="tipo_consumible" name="tipo_consumible" class="form-control" placeholder="Tipo de consumible" required>
                                <datalist id="tipo_consumibles">
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $consumibles = ControladorConsumibles::ctrMostrarTipoConsumible($item, $valor);

                                    foreach ($consumibles as $key => $value) {
                                        echo '<option value="' . $value["id_tipo_consumible"] . '"> ' . $value["nombre_consumible"] . ' </option>';
                                    }
                                    ?>
                                </datalist>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cantidad_adquirida">Cantidad Adquirida</label>
                                    <input type="number" class="form-control" id="cantidad_adquirida" name="cantidad_adquirida" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="precio_unitario">Precio Unitario</label>
                                    <input type="number" step="0.01" class="form-control" id="precio_unitario" name="precio_unitario" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_compra">Total Compra</label>
                                    <input type="number" step="0.01" class="form-control" id="total_compra" name="total_compra" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="proveedor_consumible">Proveedor</label>
                                    <input type="text" class="form-control" id="proveedor_consumible" name="proveedor_consumible" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="numero_factura">Número de Factura</label>
                                    <input type="text" class="form-control" id="numero_factura" name="numero_factura" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar Compra</button>
                        </div>
                        <?php
                       
                        $crearCompra = new ControladorConsumibles();
                        $crearCompra->ctrCrearFactura();
                        ?>

                    </form>
                </div>
            </div>
        </div>
    </div>

   
    <div class="tab-pane fade" id="listar_compras_consumibles" role="tabpanel" aria-labelledby="listar_compras_consumibles-tab">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Consumibles</h3>
                            </div>
                            <div class="card-body">
                                <table id="tabla-compras-consumible" class="table table-bordered table-striped dt-responsive" width="100%">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Tipo Consumible</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Total Compra</th>
                                            <th>Proveedor</th>
                                            <th>Numero Factura</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

   
    <div class="tab-pane fade" id="ingresar_consumible" role="tabpanel" aria-labelledby="ingresar_consumible-tab">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-lg">
                            <div class="card-header bg-info text-white">
                                <h3 class="card-title"><i class="fas fa-cogs"></i> Ingresar Consumible</h3>
                            </div>
                            <div class="card-body">
                                <div class="container mt-4">
                                    <h4 class="text-center mb-4">Formulario de Ingreso de Consumible</h4>
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="id_impresora_fk" class="form-label">Nombre Impresora</label>
                                                <input list="nombre_impre" id="id_impresora_fk" name="id_impresora_fk" class="form-control" placeholder="Seleccionar Impresora" required>
                                                <datalist id="nombre_impre">
                                                    <?php
                                                    $item = null;
                                                    $valor = null;
                                                    $consumibles = ControladorConsumibles::ctrMostrarImpresora($item, $valor);
                                                    foreach ($consumibles as $key => $value) {
                                                        echo '<option value="' . $value["id_impresora"] . '"> ' . $value["nombre_impresora"] . ' </option>';
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="fecha_instalacion" class="form-label">Fecha de Instalación</label>
                                                <input type="date" class="form-control" id="fecha_instalacion" name="fecha_instalacion" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="id_tipo_consumible_fk" class="form-label">Tipo de Consumible</label>
                                                <input list="tipo_consumibles" id="id_tipo_consumible_fk" name="id_tipo_consumible_fk" class="form-control" placeholder="Seleccionar Tipo" required>
                                                <datalist id="tipo_consumibles">
                                                    <?php
                                                    $item = null;
                                                    $valor = null;
                                                    $consumibles = ControladorConsumibles::ctrMostrarTipoConsumible($item, $valor);
                                                    foreach ($consumibles as $key => $value) {
                                                        echo '<option value="' . $value["id_tipo_consumible"] . '"> ' . $value["nombre_consumible"] . ' </option>';
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="cantidad_utilizada" class="form-label">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad_utilizada" name="cantidad_utilizada" min="1" required>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success w-100 mt-3">
                                                <i class="fas fa-save"></i> Guardar Consumible
                                            </button>
                                        </div>
                                        <?php
                                        $IngresarConsumible = new ControladorConsumibles();
                                        $IngresarConsumible->ctrIngresarConsumible();
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


</div>
<script>
    document.getElementById('cantidad_adquirida').addEventListener('input', calcularTotal);
    document.getElementById('precio_unitario').addEventListener('input', calcularTotal);

    function calcularTotal() {
        const cantidad = parseFloat(document.getElementById('cantidad_adquirida').value) || 0;
        const precio = parseFloat(document.getElementById('precio_unitario').value) || 0;
        const total = cantidad * precio;
        document.getElementById('total_compra').value = total.toFixed(2);
    }

    // Asegúrate de que el total sea calculado antes de enviar el formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        if (document.getElementById('total_compra').value === "") {
            calcularTotal(); // Si el total no ha sido calculado, lo calculamos antes de enviar
        }
    });
</script>