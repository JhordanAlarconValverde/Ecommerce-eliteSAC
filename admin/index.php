<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/images-interface/logo.png"></link>
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/fontawesome/fontawesome.css"> -->
    <title>Iniciar Sesión</title>
</head>
<body style="background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 mx-auto">
                <form action="" method="post" id="admin-form" rol="1">
                    <h1 class="h1 text-center text-light my-4 ">Iniciar Sesión</h1>
                    <div class="form-floating mb-3 text-light border border-2 border-0 border-bottom" style="background: none">
                        <input style="background: none;" type="text" class="form-control shadow-none text-light border-0" id="floatingInput" placeholder="name@example.com" name="reg-admin-correo">
                        <label for="floatingInput">Correo Electronico</label>
                    </div>
                    <div class="form-floating mb-3 text-light border border-2 border-0 border-bottom" style="background: none"">
                        <input style="background: none;" type="password" class="form-control shadow-none text-light border-0" id="floatingPassword" placeholder="Password" name="reg-admin-clave">
                        <label for="floatingPassword">Contraseña</label>
                    </div>
                    <a href="registrar.php" class="text-white float-end">Crear cuenta</a>
                    <input type="submit" class="btn btn-success" value="Aceptar">
                </form>
            </div>
        </div>
    </div>
    <script src="js/logueo.js"></script>
</body>
</html>