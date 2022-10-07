<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencias</title>
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

        $num_rows = $empleados->listarIncidencias();
        
    ?>
    
    <div class="container-fluid p-0">
        <div class="d-flex">
            <?php include 'navegacion.php'; ?>
            <div class="float-end border border-danger w-100 p-4" style="margin-left:11rem">
                <h3 class="h3 text-center mb-3">Lista de Incidencias</h3>

                

                <div class="float-end mb-4">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle shadow-none btn-lg" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtrar por
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropupCenterBtn">
                            <li><a href="" class="dropdown-item">Atendidos</a></li>
                            <li><a href="" class="dropdown-item">Falta atender</a></li>
                        </ul>
                    </div>
                </div>  

                
        
                <div class="table-table-responsive-md">
                    <table class="table table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>ID Compra</th>
                                <th>Cliente</th>
                                <th>Reclamo</th>
                                <th>F. Reclamo</th>
                                <th>H. Reclamo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-sm align-middle" id="table-body-filtrar">
                            <?php
                                if($num_rows){
                                    foreach ($empleados->listarIncidencias() as $dato) {
                                        echo "
                                        <tr>
                                        <td>
                                            <img style='width:70px;height:70px;object-fit:contain' src='http://localhost/elitesac/images/images-incident/".$dato->imagen."' alt=''>
                                        </td>
                                        <td>".$dato->idCompra."</td>
                                        <td>".$dato->nombreUsuario ." " . $dato->apellidoUsuario."</td>
                                        <td>".$dato->reclamo."</td>
                                        <td>".$dato->fechaReclamo."</td>
                                        <td>".$dato->horaReclamo."</td>
                                        <td>
                                            <div class='btn-group dropstart'>
                                                <button type='button' class='btn btn-secondary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>
                                                    
                                                </button>
                                                <ul class='dropdown-menu mx-auto'>
                                                    <li class='dropdown-item'><a href='' class='btn btn-sm btn-primary w-100 shadow-none'><i class='fa-solid fa-eye'></i>&nbsp;&nbsp;Mostrar</a></li>
                                                    <li class='dropdown-item'><a href='' class='btn btn-sm btn-warning w-100 shadow-none'><i class='fa-solid fa-pen-to-square'></i>&nbsp;&nbsp;Editar</a></li>
                                                    <li class='dropdown-item'><a href='' class='btn btn-sm btn-danger w-100 shadow-none'><i class='fa-solid fa-trash-can'></i>&nbsp;&nbsp;Eliminar</a></li>                                    
                                                </ul>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                            ";
                                    } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>