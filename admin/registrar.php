<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/images-interface/logo.png"></link>
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/fontawesome/fontawesome.min.css"> -->
    <title>Registrar</title>
</head>
<body style="background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);">
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-7 mx-auto">
                <form action="" method="post" id="admin-form" rol="0">
                    <h1 class="h1 text-center text-light my-4">Crear cuenta</h1>
                    <div class="row text-white">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="reg-admin-nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control shadow-none" id="reg-admin-nombre" name="reg-admin-nombre" placeholder="Ingrese nombre">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="reg-admin-apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control shadow-none" id="reg-admin-apellido" name="reg-admin-apellido" placeholder="Ingrese apellido">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="reg-admin-telefono" class="form-label">Telefono</label>
                                <input type="text" class="form-control shadow-none" id="reg-admin-telefono" name="reg-admin-telefono" placeholder="Ingrese telefono">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="reg-admin-correo" class="form-label">Correo</label>
                                <input type="text" class="form-control shadow-none" id="reg-admin-correo" name="reg-admin-correo" placeholder="Ingrese correo">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="reg-admin-usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control shadow-none" id="reg-admin-usuario" name="reg-admin-usuario" placeholder="Ingrese usuario">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="reg-admin-clave" class="form-label">Clave</label>
                                <input type="text" class="form-control shadow-none" id="reg-admin-clave" name="reg-admin-clave" placeholder="Ingrese clave">
                            </div>
                        </div>
                    </div>
                    <a href="index.php" class="text-white float-end">Loguear cuenta</a>
                    <input type="submit" class="btn btn-success" value="Registrar">
                </form>
            </div>
        </div>
    </div>
    <script src="js/logueo.js"></script>
</body>
</html>