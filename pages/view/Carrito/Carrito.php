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
    <title>Carrito de Compras</title>
</head>

<body>

    <?php
        session_start();
        require '../../../bd/conexion.php';
        require '../../model/Productos/Productos.php';
        $objeto = new Productos();
        
        if(!isset($_SESSION['usuario-cliente'])){
            header("location: http://localhost/elitesac/pages/IniciarSesion.php");
        }

        // unset($_SESSION['usuario-carrito']);
    ?>

    <?php include('../layout/header.php'); ?>

    <div class="container-fluid container_fluid_keyframe830w mt-4">
            
        <div class="mt-5">
            <div class="row px-3">
                <div class="col-7 pe-4 div-container-producto">
                    <?php
                        if(isset($_SESSION['usuario-carrito'])){
                            $arregloCarrito = $_SESSION['usuario-carrito'];
                            
                            foreach ($arregloCarrito as $key => $dato) {
                                if($_SESSION['usuario-cliente']['id'] == $dato['usuarioID']){
                                    
                                    ?>
                                    <div class="ms-auto my-4 border border-0 border-top border-dark div-delete-producto" style="width:490px">
                                    <div class="d-flex align-items-start py-2">
                                        <div class="pe-1">
                                            <img width="100" height="100" style="object-fit:contain" src="../../../images/images-products/<?=$dato['productoFoto']?>" alt="">
                                        </div>
                                        <div class="ps-1">
                                            <span class="d-inline-block text-truncate" style="max-width: 280px;">
                                                <?=$dato['productoDescripcion']?>
                                            </span>
                                            
                                            <div>
                                                <span class="text-danger text-decoration-line-through">S/<span><?=$dato['productoPrecio']?></span></span>
                                                <span class="text-success">S/<span class="prec-descuento-carrito"><?=$dato['productoPrecioDescuento']?></span></span>
                                            </div>

                                            <input type="number" style="width: 58px" class="form-control-sm mt-2 cantidad-producto-carrito" value="<?=$dato['productoCantidad']?>" min="1" max="<?=$dato['productoMaxCantidad']?>">
                                        </div>
                                        <div class="ms-auto py-2">
                                            <span class="text-secondary">S/<span class="subtotal_carrito_producto"><?=($dato['productoCantidad'] * $dato['productoPrecioDescuento'])?></span></span>
                                            <span style="cursor:pointer;" class="text-secondary fs-5 btn-producto-carrito-eliminar" id_producto="<?=$dato['productoID']?>">&times;</span>
                                        </div>
                                    </div>
                                </div>  
                    <?php } } } ?>
                    <?php
                    // echo "<pre>";
                    // print_r($_SESSION['usuario-carrito']);
                        if(empty($_SESSION['usuario-carrito'])){
                            echo "
                                <span class='text-dark fs-5 text-center d-block mt-5' id='span-carrito-vacio'>Carrito de compras vacio <a class='text-dark fs-5' href='http://localhost/elitesac/pages/view/Productos/Productos.php'>comprar productos</a></span>
                            ";
                        }
                    ?>
                </div>

                <div class="col-5 ps-4">
                    <div class="me-auto" style="width:280px;">
                        <p class="fs-5">Resumen del pedido</p>
                        <hr>
                        
                        <?php
                            $subtotal_total = 0;
                            if(isset($_SESSION['usuario-carrito'])){
                                foreach ($arregloCarrito as $key => $dato) {
                                    $subtotal_carrito = $dato['productoPrecioDescuento'] * $dato['productoCantidad'];
                                    $subtotal_total += $subtotal_carrito;
                                }
                                $_SESSION['subtotal_total'] = $subtotal_total;
                            }
                        ?>
                        <div class="d-flex align-items-center justify-content-between">
                            <span>Subtotal</span>
                            <span>S/<span id="subtotal_carrito"><?=$subtotal_total?></span></span>
                        </div>
                        <hr>

                        <div class="d-flex align-items-center justify-content-between">
                            <span>Total</span>
                            <span>S/<span id="total_carrito"><?=$subtotal_total?></span></span>
                        </div>
                    </div>
                    <div class="me-auto mt-4">
                        <button type="button" id="btn-finalizar-compra" class="btn btn-dark">Finalizar compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../layout/footer.php'); ?>
    <script src="../../../js/Carrito.js"></script>
</body>
</html>