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
    <title>Detalle Producto</title>
</head>

<body>

    <?php
        session_start();
        require '../../../bd/conexion.php';
        require '../../model/Productos/Productos.php';
        $objeto = new Productos();
        if(isset($_GET['id_producto'])){
            $producto = $objeto->DetalleProductobyID($_GET['id_producto']);

            if(!$producto){
                header("location: http://localhost/elitesac/index.php");
            }
        }else{
            header("location: http://localhost/elitesac/index.php");
        }
    ?>

    <?php include('../layout/header.php'); ?>

    <div class="container-fluid container_fluid_keyframe830w mt-4">
            
        <h1 class="h1 text-center">Detalle Producto</h1>
            
        <div class="mt-4">
            <div class="d-flex align-items-start">
                <div class="w-50 text-end pe-3">
                    <img style="width:400px;height:400px;object-fit:cover;" class="border border-dark" src="../../../images/images-products/<?=$producto->imagen?>" alt="">
                </div>

                <div class="w-50 px-3">
                    <div style="width:400px;">
                        <p class="fw-bolder fs-5"><?=$producto->descripcion?></p>
                        <p><?=$producto->estatus?></p>

                        <div>
                            <p class="d-inline text-decoration-line-through text-danger fs-5">S/<?=number_format($producto->precio,2)?></p>
                            <p class="d-inline text-success fs-5 ps-2">S/<?=number_format($producto->precioDescuento,2)?></p>
                        </div>

                        <!-- <form action="http://localhost/elitesac/pages/controller/ProductoController.php" method="post"> -->
                            <div class="my-3">
                                <p class="fs-6">Cantidad</p>
                                <input type="hidden" name="txtID-producto" id="txtID-producto" value="<?=$producto->id?>">
                                <input class="form-control-sm" type="number" min="1" max="<?=$producto->cantidad?>" name="txtCant-producto" id="txtCant-producto" value="1">
                            </div>

                        <?php
                            $id_session = (isset($_SESSION["usuario-cliente"]['id'])) ? $_SESSION["usuario-cliente"]['id'] : '';
                        
                            if($id_session){
                                if($id_session == $producto->idUsuario){ ?>
                                    <a href="http://localhost/elitesac/pages/view/MiCuenta/VerPublicaciones.php" class="btn btn-outline-warning">Ver mis publicaciones</a>
                                <?php }else{ ?>
                                    <button type="submit" id="btn-agregar-carrito" class="btn btn-outline-warning">Agregar al carrito</button>
                                <?php }
                            }else{ ?>
                                <button type="submit" id="btn-agregar-carrito" class="btn btn-outline-warning">Agregar al carrito</button>
                            <?php } ?>
                        
                        
                        <a href="http://localhost/elitesac/pages/view/Productos/Productos.php" class="btn btn-outline-danger">Ver mas productos</a>

                        <div class="mt-3 mb-4 pe-3 d-flex align-items-center justify-content-between border border-dark border-0 border-bottom">
                            <span class="fs-5 my-2">Información del Producto</span>
                            <span class="fw-bolder fs-5 my-2">&plus;</span>         
                        </div>
                        

                        <div class="mt-3 mb-4 pe-3 d-flex align-items-center justify-content-between border border-dark border-0 border-bottom">
                            <span class="fs-5 my-2">Política de Devolución y Retorno</span>
                            <span class="fw-bolder fs-5 my-2">&plus;</span>         
                        </div>

                        <div class="mt-3 mb-4 pe-3 d-flex align-items-center justify-content-between border border-dark border-0 border-bottom">
                            <span class="fs-5 my-2">Información del envío</span>
                            <span class="fw-bolder fs-5 my-2">&plus;</span>         
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>


    <?php include('../layout/footer.php'); ?>
    <script src="../../../js/Producto.js"></script>
    <script src="../../../js/sweetalert/sweetalert.js"></script>
</body>
</html>