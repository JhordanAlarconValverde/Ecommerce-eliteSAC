<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
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
        require '../model/usuarios/usuarios.php';
        $usuarios = new usuarios();

    ?>
    
    <div class="container-fluid p-0">
        <div class="d-flex">
            <?php include 'navegacion.php'; ?>
            <div class="float-end border border-danger w-100 p-4" style="margin-left:11rem">
                <h3 class="h3 text-center mb-3">Lista de Ventas</h3>

                <div class="mb-3">
                    <div class="w-50">
                        <form action="" method="post">
                            <div class="d-flex">
                                <input type="text" class="form-control shadow-none" placeholder="Filtrar por...">
                                <button type="submit" class="btn btn-primary shadow-none mx-2">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>
        
                <div class="table-table-responsive-md">
                    <table class="table table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Cliente</th>
                                <th>Fecha Pago</th>
                                <th>Fecha Entrega</th>
                                <th>Total</th>
                                <th>Metodo de Pago</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-sm align-middle">
                            <?php
                            // $date=date_create("2013-03-15");
                            // echo date_format($date,"Y/m/d H:i:s");
                                foreach ($usuarios->listarVentas() as $dato) {
                                    echo "
                                    <tr>
                                    <td>".$dato->usuario."</td>
                                    <td>".$dato->fechaDePago."</td>
                                    <td>".$dato->fechaDeEntrega."</td>
                                    <td>S/".$dato->total."</td>
                                    <td>".$dato->metodoPago."</td>
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
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>