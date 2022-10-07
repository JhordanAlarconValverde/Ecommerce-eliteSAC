<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Disponibles</title>
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
        require '../model/productos/productos.php';
        $productos = new productos();

        $num_rows = count($productos->listarProductos());
        $num_register = 9;
        $num_pages = ceil($num_rows/$num_register);

        if(!$_GET['page']){
            header('location: http://localhost/elitesac/admin/view/productosDisponibles.php?page=1');
        }

        if($_GET['page'] < 1 || $_GET['page'] > $num_pages){
            header('location: http://localhost/elitesac/admin/view/productosDisponibles.php?page=1');
        }
    ?>
    
    <div class="container-fluid p-0">
        <div class="d-flex">
            <?php include 'navegacion.php'; ?>
            <div class="float-end w-100 p-4" style="margin-left:11rem">
                <h3 class="h3 text-center mb-3">Productos Disponibles</h3>

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
                                <th>Imagen</th>
                                <th>Prod.</th>
                                <th>Cant.</th>
                                <th>Prec.</th>
                                <th>Desc.</th>
                                <th>Estado</th>
                                <th>Categoría</th>
                                <th>Usuario</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-sm align-middle">
                            <?php
                                $iniciar = ($_GET['page']-1) * $num_register;
                                foreach ($productos->listarProductosLimit($iniciar, $num_register) as $dato) {
                                    echo "
                                    <tr>
                                    <td>
                                        <img style='width:70px;height:70px;object-fit:contain' src='../../images/images-products/".$dato->imagen."' alt=''>
                                    </td>
                                    <td>".$dato->producto."</td>
                                    <td>".$dato->cantidad."u.</td>
                                    <td>S/".$dato->precio."</td>
                                    <td>S/".$dato->precioDescuento."</td>
                                    <td>
                                        ".$dato->estado."
                                    </td>
                                    <td>".$dato->categoria."</td>
                                    <td>".$dato->usuario."</td>
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

                
                    <ul class="pagination mx-auto">
                        <li class="page-item <?=($_GET['page']<=1) ? 'disabled' : ''?>">
                            <a class="page-link shadow-none" href="http://localhost/elitesac/admin/view/productosDisponibles.php?page=<?=$_GET['page']-1?>">Anterior</a>
                        </li>
                        
                        <?php for ($i=1; $i <= $num_pages ; $i++) { ?>
                            <li class="page-item <?=($_GET['page'] == $i) ? 'active':''?>"><a class="page-link shadow-none" href="http://localhost/elitesac/admin/view/productosDisponibles.php?page=<?=$i?>"><?=$i?></a></li>
                        <?php } ?>

                        <li class="page-item <?=($_GET['page']>=$num_pages) ? 'disabled' : ''?>">
                            <a class="page-link shadow-none" href="http://localhost/elitesac/admin/view/productosDisponibles.php?page=<?=$_GET['page']+1?>">Siguiente</a>
                        </li>
                    </ul>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>