<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Formulario de Compra de Consumibles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">CONSUMIBLES</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Formulario para ingresar los datos de compra de consumibles -->
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ingreso de Datos de Compra</h3>
        </div>
        <div class="card-body">
            <form action="procesar_compra.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_compra">Fecha de Compra</label>
                            <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_consumible">Tipo de Consumible</label>
                            <input type="text" class="form-control" id="tipo_consumible" name="tipo_consumible" required>
                        </div>
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
            </form>
        </div>
    </div>
</div>

<!-- Script para calcular el total de la compra automáticamente -->
<script>
    document.getElementById('cantidad_adquirida').addEventListener('input', calcularTotal);
    document.getElementById('precio_unitario').addEventListener('input', calcularTotal);

    function calcularTotal() {
        const cantidad = parseFloat(document.getElementById('cantidad_adquirida').value) || 0;
        const precio = parseFloat(document.getElementById('precio_unitario').value) || 0;
        const total = cantidad * precio;
        document.getElementById('total_compra').value = total.toFixed(2);
    }
</script>
