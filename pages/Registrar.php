<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/images-interface/logo.png"></link>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <!-- ICON AWESOME -->
    <link rel="stylesheet" href="../css/fontawesome/css/all.min.css">
    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Registrar</title>
</head>

<body>

    <?php
        session_start();
        include '../bd/conexion.php';
        include 'model/Usuario/Usuario.php';
        $usuario = new Usuario();
        
        if(isset($_SESSION['usuario-cliente'])){
            header("location: http://localhost/elitesac/index.php");
        }

        $idDepartamento = isset($_SESSION['form-validation']['idDepartamento-valid']) ? $_SESSION['form-validation']['idDepartamento-valid'] : '';
        $idProvincia = isset($_SESSION['form-validation']['idProvincia-valid']) ? $_SESSION['form-validation']['idProvincia-valid'] : '';
        $idDistrito = isset($_SESSION['form-validation']['idDistrito-valid']) ? $_SESSION['form-validation']['idDistrito-valid'] : '';
    ?>

    <?php include '../pages/view/layout/header.php'; ?>

    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12 col-sm-10 col-md-8 col-xl-6 mx-auto">
                <h1 class="h1 text-center mb-4">Registrar</h1>
                <form action="http://localhost/elitesac/pages/controller/UsuarioController.php" id="form-reg-usuario" name="form-reg-usuario" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control shadow-none <?=isset($_SESSION['form-validation']['nombre-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['nombre-valid']) ? 'is-valid' : ''?>" id="reg-nombre" name="reg-nombre" placeholder="Agregue un nombre" value="<?=isset($_SESSION['form-validation']['nombre-valid']) ? $_SESSION['form-validation']['nombre-valid'] : ''?>">
                                <?php
                                    if(isset($_SESSION['form-validation']['nombre-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['nombre-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['nombre-invalid']);unset($_SESSION['form-validation']['nombre-valid']);
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control shadow-none <?=isset($_SESSION['form-validation']['apellido-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['apellido-valid']) ? 'is-valid' : '' ?>" id="reg-apellido" name="reg-apellido" placeholder="Agregue un apellido" value="<?=isset($_SESSION['form-validation']['apellido-valid']) ? $_SESSION['form-validation']['apellido-valid'] : ''?>">
                                <?php
                                    if(isset($_SESSION['form-validation']['apellido-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['apellido-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['apellido-invalid']);unset($_SESSION['form-validation']['apellido-valid']);
                                    
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-telefono" class="form-label">Telefono</label>
                                <input type="text" class="form-control shadow-none <?=isset($_SESSION['form-validation']['telefono-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['telefono-valid']) ? 'is-valid' : '' ?>" id="reg-telefono" name="reg-telefono" placeholder="Agregue un telefono" value="<?=isset($_SESSION['form-validation']['telefono-valid']) ? $_SESSION['form-validation']['telefono-valid'] : ''?>">
                                <?php
                                    if(isset($_SESSION['form-validation']['telefono-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['telefono-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['telefono-invalid']);unset($_SESSION['form-validation']['telefono-valid']);
                                    
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-departamento" class="form-label">Departamento</label>
                                <select name="reg-departamento" id="reg-departamento" class="form-select shadow-none <?=isset($_SESSION['form-validation']['idDepartamento-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['idDepartamento-valid']) ? 'is-valid' : '' ?>">
                                    <option value="" selected disabled>Selecciona un departamento</option>

                                    <?php
                                        $departamentos = $usuario->ListarDepartamentos();

                                        foreach ($departamentos as $datos_departamento){
                                            if($idDepartamento != ''){ ?>
                                                <option value="<?=$datos_departamento->id?>" <?=($datos_departamento->id == $idDepartamento) ? 'selected' : ''?>><?=$datos_departamento->nombre?></option>
                                            <?php }else{ ?>
                                                <option value="<?=$datos_departamento->id?>"><?=$datos_departamento->nombre?></option>
                                            <?php } ?>
                                    <?php } ?>
                                </select>
                                <?php
                                    if(isset($_SESSION['form-validation']['idDepartamento-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['idDepartamento-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['idDepartamento-invalid']);unset($_SESSION['form-validation']['idDepartamento-valid']);
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-provincia" class="form-label">Provincia</label>
                                <select name="reg-provincia" id="reg-provincia" class="form-select shadow-none <?=isset($_SESSION['form-validation']['idProvincia-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['idProvincia-valid']) ? 'is-valid' : '' ?>">
                                    <option value="" selected disabled>Selecciona una provincia</option>

                                    <?php
                                        if($idDepartamento != ''){
                                            $provincias = $usuario->ListarProvinciaByDepartamento($idDepartamento);

                                            foreach ($provincias as $datos_provincia) { ?>
                                                <option value="<?=$datos_provincia->id?>" <?=($datos_provincia->id == $idProvincia) ? 'selected' : ''?>><?=$datos_provincia->nombre?></option>
                                            <?php } } ?>                                
                                </select>
                                <?php
                                    if(isset($_SESSION['form-validation']['idProvincia-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['idProvincia-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['idProvincia-invalid']);unset($_SESSION['form-validation']['idProvincia-valid']); ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-distrito" class="form-label">Distrito</label>
                                <select name="reg-distrito" id="reg-distrito" class="form-select shadow-none <?=isset($_SESSION['form-validation']['idDistrito-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['idDistrito-valid']) ? 'is-valid' : '' ?>">
                                    <option value="" selected disabled>Selecciona un distrito</option>
                                    <?php
                                        if($idProvincia != ''){
                                            $distritos = $usuario->ListarDistritoByProvincia($idProvincia);
                                            
                                            foreach ($distritos as $datos_distrito) { ?>
                                                <option value="<?=$datos_distrito->id?>" <?=($datos_distrito->id == $idDistrito) ? 'selected' : ''?>><?=$datos_distrito->nombre?></option>
                                    <?php } } ?>
                                </select>
                                <?php
                                    if(isset($_SESSION['form-validation']['idDistrito-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['idDistrito-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['idDistrito-invalid']);unset($_SESSION['form-validation']['idDistrito-valid']);
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control shadow-none <?=isset($_SESSION['form-validation']['direccion-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['direccion-valid']) ? 'is-valid' : '' ?>" id="reg-direccion" name="reg-direccion" placeholder="Agregue una dirección" value="<?=isset($_SESSION['form-validation']['direccion-valid']) ? $_SESSION['form-validation']['direccion-valid'] : '' ?>">
                                <?php
                                    if(isset($_SESSION['form-validation']['direccion-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['direccion-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['direccion-invalid']);unset($_SESSION['form-validation']['direccion-valid']);
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-referencia" class="form-label">Referencia</label>
                                <input type="text" class="form-control shadow-none <?=isset($_SESSION['form-validation']['referencia-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['referencia-valid']) ? 'is-valid' : '' ?>" id="reg-referencia" name="reg-referencia" placeholder="Agregue una referencia" value="<?=isset($_SESSION['form-validation']['referencia-valid']) ? $_SESSION['form-validation']['referencia-valid'] : '' ?>">
                                <?php
                                    if(isset($_SESSION['form-validation']['referencia-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['referencia-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['referencia-invalid']);unset($_SESSION['form-validation']['referencia-valid']);
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-correo" class="form-label">Correo</label>
                                <input type="text" class="form-control shadow-none <?=isset($_SESSION['form-validation']['correo-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['correo-valid']) ? 'is-valid' : '' ?>" id="reg-correo" name="reg-correo" placeholder="Agregue un correo" value="<?=isset($_SESSION['form-validation']['correo-valid']) ? $_SESSION['form-validation']['correo-valid'] : '' ?>">
                                <?php
                                    if(isset($_SESSION['form-validation']['correo-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['correo-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['correo-invalid']);unset($_SESSION['form-validation']['correo-valid']);
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control shadow-none <?=isset($_SESSION['form-validation']['usuario-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['usuario-valid']) ? 'is-valid' : '' ?>" id="reg-usuario" name="reg-usuario" placeholder="Agregue un usuario" value="<?=isset($_SESSION['form-validation']['usuario-valid']) ? $_SESSION['form-validation']['usuario-valid'] : '' ?>">
                                <?php
                                    if(isset($_SESSION['form-validation']['usuario-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['usuario-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['usuario-invalid']);unset($_SESSION['form-validation']['usuario-valid']);
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-clave" class="form-label">Clave</label>
                                <input type="password" class="form-control shadow-none <?=isset($_SESSION['form-validation']['clave-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['clave-valid']) ? 'is-valid' : '' ?>" id="reg-clave" name="reg-clave" placeholder="Agregue una clave" value="<?=isset($_SESSION['form-validation']['clave-valid']) ? $_SESSION['form-validation']['clave-valid'] : '' ?>">
                                <?php
                                    if(isset($_SESSION['form-validation']['clave-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['clave-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['clave-invalid']);unset($_SESSION['form-validation']['clave-valid']);
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="reg-confirmar-cave" class="form-label">Confirmar clave</label>
                                <input type="password" class="form-control shadow-none <?=isset($_SESSION['form-validation']['confirmar-invalid']) ? 'is-invalid' : '' ?><?=isset($_SESSION['form-validation']['confirmar-valid']) ? 'is-valid' : '' ?>" id="reg-confirmar-cave" name="reg-confirmar-cave" placeholder="Confirme su clave" value="<?=isset($_SESSION['form-validation']['confirmar-valid']) ? $_SESSION['form-validation']['confirmar-valid'] : '' ?>">
                                <?php
                                    if(isset($_SESSION['form-validation']['confirmar-invalid'])){
                                        echo "<div class='invalid-feedback'>*".$_SESSION['form-validation']['confirmar-invalid']."</div>";
                                    }unset($_SESSION['form-validation']['confirmar-invalid']);unset($_SESSION['form-validation']['confirmar-valid']); 
                                ?>
                            </div>
                        </div>
                    </div>
                
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkShowPasswordUsuario">
                            <label class="form-check-label" for="checkShowPasswordUsuario">
                                Ver contraseñas
                            </label>
                        </div>

                        <span>
                            ¿Ya tienes una cuenta? <a href="http://localhost/elitesac/pages/IniciarSesion.php" class="text-dark text-decoration-none"><b>Iniciar sesión</b></a> 
                        </span>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Aceptar términos y condiciones
                        </label>
                    </div>

                    <button tyle="submit" class="btn btn-success" name="btn-reg-usuario">Registrar</button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../pages/view/layout/footer.php'; ?>
    <script src="../js/Registrar.js"></script>
</body>
</html>