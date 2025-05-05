<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a class="nav-link" href="#acpm">
                <i class="nav-icon fas fa-bolt"></i>
                <p>Novedades</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#acpm">
                <i class="nav-icon fas fa-comment-dots"></i>
                <p>Enviar Comentario</p>
            </a>
        </li>
    </ul>
</nav>
</div>
</aside>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Encabezado -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="m-0 text-primary">Perfil de Usuario</h1>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Perfil</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Contenido principal -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Perfil -->
                <div class="col-lg-4 col-md-5">
                    <div class="card card-primary card-outline">
                        <div class="card-body text-center">
                            <img class="img-fluid rounded-circle mb-3" src="<?php echo $_SESSION['foto']; ?>" alt="Foto Perfil" style="width: 160px; height: 160px; object-fit: cover;">
                            <h4 class="text-uppercase mb-0"><?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellidos_usuario']; ?></h4>
                            <p class="text-muted mb-1"><?php echo $_SESSION['nombre_cargo']; ?></p>
                            <p class="text-muted small"><?php echo $_SESSION['proceso_fk']; ?></p>
                            <button class="btn btn-outline-primary show-password mt-2">
                                <i class="fa fa-eye"></i> Mostrar Contraseña
                            </button>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn bg-teal text-white" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-lock"></i> Aviso de Datos Personales
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Configurar Perfil -->
                <div class="col-lg-8 col-md-7">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0"><strong>Configuración de Perfil</strong></h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" onsubmit="return verificarPasswords()">
                                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                                <input type="hidden" name="nombre" value="<?php echo $_SESSION['nombre']; ?>">

                                <div class="form-group d-none">
                                    <label>Contraseña Actual</label>
                                    <input type="password" value="<?php echo $_SESSION['password']; ?>" class="form-control password3" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nueva Contraseña <small class="text-muted">(opcional)</small></label>
                                    <input type="password" name="password" class="form-control password1" placeholder="Ingrese nueva contraseña">
                                </div>

                                <div class="form-group">
                                    <label>Confirmar Contraseña</label>
                                    <input type="password" name="pass2" class="form-control password2" placeholder="Confirme su nueva contraseña">
                                </div>

                                <div class="form-group">
                                    <label>Actualizar Firma</label>
                                    <input type="file" name="foto" class="form-control-file">
                                </div>

                                <button type="submit" class="btn btn-success btn-block mt-3" name="update">
                                    <i class="fas fa-save"></i> Guardar Cambios
                                </button>

                                <?php
                                $ActualizarPerfil = new ControladorPerfiles();
                                $ActualizarPerfil->ctrActualizarPerfil();
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal: Protección de Datos -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-user-shield"></i> Aviso de Protección de Datos</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p class="text-justify" style="line-height: 1.7;">
                    <strong>AVISO DE REGISTRO ELECTRÓNICO DE DATOS:</strong> Al registrar sus datos personales, usted declara conocer y aceptar nuestra política de tratamiento de datos personales disponible en:
                    <a href="https://www.politicadeprivacidad.co/politica/zfipusuariooperador" target="_blank">www.politicadeprivacidad.co/politica/zfipusuariooperador</a>. También reconoce sus derechos como titular de la información y autoriza a <strong>ZONA FRANCA INTERNACIONAL DE PEREIRA SAS USUARIO OPERADOR DE ZONAS FRANCAS</strong> (NIT 900.311.215-6) a tratar sus datos conforme a dicha política.
                </p>
            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script: Mostrar/Ocultar Contraseña -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.querySelector(".show-password");
        toggleBtn.addEventListener("click", function() {
            const inputs = document.querySelectorAll(".password1, .password2, .password3");
            inputs.forEach(input => {
                input.type = input.type === "password" ? "text" : "password";
            });
            const icon = toggleBtn.querySelector("i");
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        });
    });

    function verificarPasswords() {
        // Obtener valores de las contraseñas
        const password1 = document.querySelector('.password1').value;
        const password2 = document.querySelector('.password2').value;

        // Verificar si son iguales
        if (password1 !== password2) {
            alert('Las contraseñas no coinciden.');
            return false; // Evita el envío del formulario
        }

        return true; // Permite el envío
    }
</script>