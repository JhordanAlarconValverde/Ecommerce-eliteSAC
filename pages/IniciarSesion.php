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
    <title>Iniciar Sesion</title>
</head>

<body>

    <?php 
        session_start();
        
        if(isset($_SESSION['usuario-cliente'])){
            header("location: http://localhost/elitesac/index.php");
        }
    ?>

    <?php include '../pages/view/layout/header.php'; ?>

    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-10 col-md-6 col-lg-4 mx-auto">
                <h1 class="h1 text-center mb-4">Iniciar Sesión</h1>

                <form action="" id="form-login-usuario" name="form-login-usuario" method="post">
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" style="height:38px"><i class="fa-solid fa-user text-muted"></i></span>
                            </div>
                            <input type="text" name="txt-login-user-Usuario" id="txt-login-user-Usuario" class="form-control shadow-none" placeholder="Ingrese su usuario">                   
                        </div>
                        <div id="form-validate-login"></div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" style="height:38px"><i class="fa-solid fa-unlock text-muted"></i></span>
                            </div>
                            <input type="password" name="txt-login-password-Usuario" id="txt-login-password-Usuario" class="form-control shadow-none position-relative pe-5" placeholder="Ingrese su clave">
                            <span style="top:6px;right:10px;z-index:50;cursor:pointer" class="position-absolute" id="btn-show-password-Usuario"><i class="fa-solid fa-eye-slash text-muted"></i></span>
                        </div>
                        <span id="form-validate-clave"></span>
                    </div>

                    <p class="text-right mb-4">
                        ¿Todavía no tiene una cuenta? <a href="http://localhost/elitesac/pages/Registrar.php" class="text-dark text-decoration-none"><b>Registrar</b></a> 
                    </p>

                    <div class="d-flex justify-content-between align-items-center">
                        <button tyle="submit" name="btn-login-IniciarSesion" id="btn-login-IniciarSesion" class="btn btn-primary">Iniciar sesión</button>
                        <a href="#" class="text-dark">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../pages/view/layout/footer.php'; ?>
    <script src="../js/IniciarSesion.js"></script> 
</body>
</html>