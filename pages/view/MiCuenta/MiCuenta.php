<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../../images/images-interface/logo.png"></link>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="../../../css/bootstrap/bootstrap.min.css">
    <!-- ICON AWESOME -->
    <link rel="stylesheet" href="../../../css/fontawesome/css/all.min.css">
    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../../../css/estilos.css">
    <title>Mi cuenta</title>
</head>

<body>

    <?php
        session_start();

        if(!isset($_SESSION['usuario-cliente'])){
            header("location: http://localhost/elitesac/pages/IniciarSesion.php");
        }
    ?>

    <?php include '../layout/header.php'; ?>


    <div class="container-fluid mt-4">
        <form action="" class="mt-4" id="mc-formulario" name="mc-formulario" enctype="multipart/form-data">
            <div class="mx-auto" style="width:50rem">
                <div class="w-100 border border-2 border-dark p-3" style="background:#ddd">
                    <div class="py-2">
                        <label style="cursor:pointer;" class="fs-4" for="fileMicuenta"><i class="fa-solid fa-camera"></i></label>
                        <input type="file" name="fileMicuenta" id="fileMicuenta">

                    </div>
                    <img width="150" height="150" id="fotoMicuenta" src="../../../images/images-users/<?=$_SESSION['usuario-cliente']['foto']?>" alt="">
                </div>

                <div class="px-5 my-4" style="width:35rem">
                    <h3 class="h3">Mi cuenta</h3>
                    <p>Consulta y edita tu información personal</p>
                    <hr>

                    <h5 class="h5">Cuenta</h5>
                    <p>Actualiza y edita la información que compartes con la comunidad</p>


                    <span class="d-block">Email de inicio de sesión:</span>
                    <span class="d-block"><?=$_SESSION['usuario-cliente']['correo']?></span>

                    <p class="text-secondary mt-2">Tu email de inicio de sesión no se puede cambiar</p>

                
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="">Nombre</label>
                            <input class="form-control shadow-none" type="text" name="mc-nombre" id="mc-nombre" value="<?=$_SESSION['usuario-cliente']['nombre']?>">
                            <span class="text-danger" id="mc-validar-nombre"></span>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Apellido</label>
                            <input class="form-control shadow-none" type="text" name="mc-apellido" id="mc-apellido" value="<?=$_SESSION['usuario-cliente']['apellido']?>">
                            <span class="text-danger" id="mc-validar-apellido"></span>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Usuario</label>
                            <input class="form-control shadow-none" type="text" name="mc-usuario" id="mc-usuario" value="<?=$_SESSION['usuario-cliente']['usuario']?>">
                            <span class="text-danger" id="mc-validar-usuario"></span>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Telefono</label>
                            <input class="form-control shadow-none" type="text" name="mc-telefono" id="mc-telefono" value="<?=$_SESSION['usuario-cliente']['telefono']?>">
                            <span class="text-danger" id="mc-validar-telefono"></span>
                        </div>
                        <div class="col-auto mb-3 ms-auto">
                            <!-- <input class="btn btn-danger" type="reset" value="Cancelar"> -->
                            <button type="submit" class="btn btn-success" type="button">Guardar datos</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php include '../layout/footer.php'; ?>
    <script src="../../../js/Usuario.js"></script>
    <script src="../../../js/sweetalert/sweetalert.js"></script>
</body>
</html>