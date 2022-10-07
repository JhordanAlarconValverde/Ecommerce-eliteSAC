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
    <title>Ver Compras</title>
</head>

<body>

    <?php 
        session_start();
        require '../../../bd/conexion.php';
        require '../../model/Productos/DetalleCompra.php';

        $detalleCompra = new DetalleCompra();
        
        // $objeto = new Productos();
        if(!isset($_SESSION['usuario-cliente'])){
            header("location: http://localhost/elitesac/pages/IniciarSesion.php");
        }
    ?>

    <?php include '../layout/header.php'; ?>

    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12 col-sm-10  mx-auto">
                <h1 class="h1 text-center mb-4">Historial de Compras</h1>

                <div class="float-end mb-4">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle shadow-none btn-lg" data-bs-toggle="dropdown" aria-expanded="false">
                            Ordenar por
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropupCenterBtn">
                            <li><a href="" class="dropdown-item">Precio</a></li>
                            <li><a href="" class="dropdown-item">Precio Descuento</a></li>
                            <li><a href="" class="dropdown-item">Cantidad</a></li>
                            <li><a href="" class="dropdown-item">Fecha de Pago</a></li>
                            <li><a href="" class="dropdown-item">Fecha de Entrega</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4 table-responsive-sm">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Prec. D</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>F. De Pago</th>
                                <th>F. De Entrega</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle table-sm">
                            <?php
                                $condicion = $detalleCompra->listarDetalleCompra($_SESSION['usuario-cliente']['id']);
                                $totalCompra = 0;
                                if($condicion){
                                    foreach ($condicion as $dato) { 
                                        $totalCompra += ($dato->cantidad * $dato->descuento)?>
                                        <tr>
                                            <td><?=$dato->idProducto?></td>
                                            <td>
                                                <img style="width:60px;height:60px;object-fit:contain" src="../../../images/images-products/<?=$dato->imagen?>" alt="<?=$dato->producto?>">
                                            </td>
                                            <td><?=$dato->producto?></td>
                                            <td>S/<?=$dato->precioProducto?></td>
                                            <td>S/<?=$dato->descuento?></td>
                                            <td><?=$dato->cantidad?>u.</td>
                                            <td>S/<?=$dato->subtotal?></td>
                                            <td><?=$dato->fechaDePago?></td>
                                            <td><?=$dato->fechaDeEntrega?></td>
                                        </tr>
                                <?php } ?>
                                        <tr>
                                            <td colspan="9" class="fs-5"><b>Total Compra S/<?=$totalCompra?></b></td>
                                        </tr>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="9">Usted todavia no a realizado ninguna compra</td>
                                    </tr>
                                <?php }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include '../layout/footer.php'; ?>
</body>
</html>
