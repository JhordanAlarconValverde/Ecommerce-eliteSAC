<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
    <link rel="icon" type="image/png" href="../../images/images-interface/logo.png"></link>
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/fontawesome/css/all.min.css">
</head>
<body>
    <?php
        session_start();

        if(!isset($_SESSION['empleado'])){
            header("location: http://localhost/elitesac/admin/");
        }

        require '../../bd/conexion.php';
        require '../model/empleados/empleados.php';
        $empleados = new empleados();
    ?>
    
    <div class="container-fluid p-0">
        <div class="d-flex">
            <?php include 'navegacion.php'; ?>

            <div class="float-end w-100 p-4" style="margin-left:11rem">
                <h3 class="h3 text-start mb-3">Mi Cuenta</h3>

                <div class="w-75 text-center mx-auto">
                    <img style="width:65&;height:300px;object-fit:contain" src="../../images/images-employees/<?=$_SESSION['empleado']['foto']?>" alt="">
                </div>
                
                <div class="w-75 mx-auto mt-4">
                    <form action="" method="post">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="admin-nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control shadow-none" id="admin-nombre" name="admin-nombre" value="<?=$_SESSION['empleado']['nombre']?>">
                            </div> 
                            <div class="mb-3 col-6">
                                <label for="admin-apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control shadow-none" id="admin-apellido" name="admin-apellido" value="<?=$_SESSION['empleado']['apellido']?>">
                            </div> 
                            <div class="mb-3 col-6">
                                <label for="admin-telefono" class="form-label">Telefono</label>
                                <input type="text" class="form-control shadow-none" id="admin-telefono" name="admin-telefono" value="<?=$_SESSION['empleado']['telefono']?>">
                            </div> 
                            <div class="mb-3 col-6">
                                <label for="admin-correo" class="form-label">Correo</label>
                                <input type="text" class="form-control shadow-none" id="admin-correo" name="admin-correo" value="<?=$_SESSION['empleado']['correo']?>" readonly>
                            </div> 
                            <div class="mb-3 col-6">
                                <label for="admin-usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control shadow-none" id="admin-nombre" name="admin-usuario" value="<?=$_SESSION['empleado']['usuario']?>">
                            </div> 
                            <div class="mb-3 col-6">
                                <label for="admin-clave" class="form-label">Clave</label>
                                <input type="password" class="form-control shadow-none" id="admin-clave" name="admin-clave" value="<?=$_SESSION['empleado']['clave']?>">
                            </div> 
                            <div class="mb-3 col-6">
                                <label for="admin-rol" class="form-label">Rol</label>
                                <input type="text" class="form-control shadow-none" id="admin-rol" name="admin-rol" value="<?=$_SESSION['empleado']['rol']?>" readonly>
                            </div> 
                            <div class="mb-3 col-6">
                                <label for="admin-turno" class="form-label">Turno</label>
                                <select name="admin-turno" id="admin-turno" class="form-select shadow-none">
                                    <option value="1" <?=$_SESSION['empleado']['idTurno'] == 1 ? 'selected' : ''?>>Mañana</option>
                                    <option value="2" <?=$_SESSION['empleado']['idTurno'] == 2 ? 'selected' : ''?>>Tarde</option>
                                    <option value="3" <?=$_SESSION['empleado']['idTurno'] == 3 ? 'selected' : ''?>>Noche</option>
                                    <option value="4" <?=$_SESSION['empleado']['idTurno'] == 4 ? 'selected' : ''?>>Diario</option>
                                </select>
                            </div> 
                            <div class="mb-3 text-end">
                                <input type="submit" class="btn btn-success shadow-none" value="Actualizar">
                            </div>
                        <div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>