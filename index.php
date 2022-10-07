<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/images-interface/logo.png"></link>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <!-- ICON AWESOME -->
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="css/estilos.css">
    <!-- FONT STYLE -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');
    </style>
    <title>Inicio de pagina</title>
</head>

<body>
    <?php session_start(); ?>

    <?php
        require 'bd/conexion.php';
        require 'pages/model/Productos/Productos.php';
        $producto = new Productos();
    ?>

    <?php include 'pages/view/layout/header.php'; ?>

    <!-- SLIDER -->
    <div class="container-fluid mt-4 px-4">
        <div id="carouselExampleDark" class="carousel carousel-dark carousel-fade slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <div class="position-absolute mt-5">
                        <div class="bg-danger text-white px-4 py-2 text-center h3 d-inline">Mejores Precios</div>
                        <div class="display-4 d-flex flex-sm-column mt-4">
                            <span><b>Increibles precios</b></span><span><b>en todos tus</b></span><span><b>artículos favoritos</b></span>
                        </div>
                        <div class="mt-4 h5">
                            <span>Consigue más por menos en marcas seleccionada</span>
                        </div>
                        <div class="mt-4">
                            <a href="http://localhost/elitesac/pages/view/Productos/Productos.php" class="btn btn-outline-dark">Comprar ahora</a>
                        </div>
                    </div>
                    <img height="480px" style="width:100%; min-width:300px;object-fit:cover;" src="images/images-interface/QzpceGFtcHBcdG1wXHBocDE5NjAudG1w.png" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <div class="position-absolute mt-5">
                        <div class="bg-danger text-white px-4 py-2 text-center h3 d-inline">Mejores Precios</div>
                        <div class="display-4 d-flex flex-sm-column mt-4">
                            <span><b>Increibles precios</b></span><span><b>en todos tus</b></span><span><b>artículos favoritos</b></span>
                        </div>
                        <div class="mt-4 h5">
                            <span>Consigue más por menos en marcas seleccionada</span>
                        </div>
                        <div class="mt-4">
                            <a href="http://localhost/elitesac/pages/view/Productos/Productos.php" class="btn btn-outline-dark">Comprar ahora</a>
                        </div>
                    </div>
                    <img height="480px" style="width:100%; min-width:300px;object-fit:cover;" src="images/images-interface/QzpceGFtcHBcdG1wXHBocDMxMDEudG1w.png" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <div class="position-absolute mt-5">
                        <div class="bg-danger text-white px-4 py-2 text-center h3 d-inline">Mejores Precios</div>
                        <div class="display-4 d-flex flex-sm-column mt-4">
                            <span><b>Increibles precios</b></span><span><b>en todos tus</b></span><span><b>artículos favoritos</b></span>
                        </div>
                        <div class="mt-4 h5">
                            <span>Consigue más por menos en marcas seleccionada</span>
                        </div>
                        <div class="mt-4">
                            <a href="http://localhost/elitesac/pages/view/Productos/Productos.php" class="btn btn-outline-dark">Comprar ahora</a>
                        </div>
                    </div>
                    <img height="480px" style="width:100%; min-width:300px;object-fit:cover;" src="images/images-interface/QzpceGFtcHBcdG1wXHBocDI1RDQudG1w.png" alt="...">
                </div>
            </div>
        </div>
    </div>

    <!-- BARRA INFORMACION -->
    <div class="container-fluid mt-4 px-4">
        <div class="border border-3 border-dark d-flex align-items-center justify-content-between p-3">
            <div class="d-flex align-items-center">
                <img width="70px" src="images/images-interface/moto.png">
                <p class="d-inline p-1 h5">Recogida en <br>la acera</p>
            </div>
            <div class="d-flex align-items-center">
                <img width="70px" src="images/images-interface/caja.png">
                <p class="d-inline p-1 h5">Envio gratuito a pedidos <br>superiores a 1200 soles</p>
            </div>
            <div class="d-flex align-items-center">
                <img width="70px" src="images/images-interface/porcentaje.png">
                <p class="d-inline p-1 h5">Precios bajos <br>garantizados</p>
            </div>
            <div class="d-flex align-items-center">
                <img width="70px" src="images/images-interface/tiempo.png">
                <p class="d-inline p-1 h5">Disponibilidad 24/7</p>
            </div>
        </div>
    </div>

    <!-- LO MAS VENDIDO-->
    <div class="container-fluid mt-4 px-4">
        <div class="border border-3 border-dark p-3">
            <h2 class="h2 text-center pb-3">Lo más vendido</h2>

            <div class="row">
                
                <?php
                    $condicion = $producto->ListarProductosMasVendidos();

                    if($condicion){ 
                        foreach ($condicion as $dato) { ?>
                            <div class="col-3">
                                <a href="http://localhost/elitesac/pages/view/DetalleProducto/DetalleProducto.php?id_producto=<?=$dato->id?>" class="text-decoration-none text-dark">
                                    <div class="card border-0 p-0">
                                        <img src="images/images-products/<?=$dato->imagen?>" alt="...">

                                        <div class="card-body">
                                            <p class="card-text w-100 overflow-hidden" style="max-height:60px;text-overflow: ellipsis;-webkit-line-clamp: 2;-webkit-box-orient: vertical;display: -webkit-box;">
                                            <?=$dato->descripcion?>
                                                </p>
                                            
                                            <span class="card-text text-primary"><?=($dato->estado == 'S') ? 'Segunda mano' : 'Reparado'?></span>
                                            <div>
                                                <span class="card-text text-decoration-line-through text-danger">S/<?=$dato->precio?></span>
                                                <span class="card-text text-secondary ms-2">S/<?=$dato->precioDescuento?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                <?php } } ?>
                
                <div class="col-12 text-center mt-3">
                    <a href="http://localhost/elitesac/pages/view/Productos/Productos.php" class="btn btn-primary px-3">Ver todo</a>
                </div>
            </div>
        </div>
    </div>

    <!-- CATEGORIAS -->
    <div class="container-fluid mt-4 px-4">
        <div class="border border-3 border-dark px-3">
            <div class="row">
                <h2 class="h2 text-center py-3">Comprar por categoría</h2>
                <div class="col-3 p-3 text-center">
                    <a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Computadoras.php" class="text-decoration-none text-dark">
                        <div class="border border-2 border-dark rounded-circle text-center">
                            <img style="border-radius:50%;overflow:hidden;" class="img-fluid border" src="images/images-products/20210525001959.png" alt="">
                        </div>
                        <h6 class="h6">Computadoras</h6>
                    </a>
                </div>
                <div class="col-3 p-3 text-center">
                    <a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/DronesyCamaras.php" class="text-decoration-none text-dark">
                        <div class="border border-2 border-dark rounded-circle text-center">
                            <img style="border-radius:50%;overflow:hidden;" class="img-fluid border" src="images/images-products/20220525001963.png" alt="">
                        </div>
                        <h6 class="h6">Drones y Cámaras</h6>
                    </a>
                </div>
                <div class="col-3 p-3 text-center">
                    <a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Parlantes.php" class="text-decoration-none text-dark">
                        <div class="border border-2 border-dark rounded-circle text-center">
                            <img style="border-radius:50%;overflow:hidden;" class="img-fluid" src="images/images-products/20220525001958.png" alt="">
                        </div>
                        <h6 class="h6">Parlantes</h6>
                    </a>
                </div>
                <div class="col-3 p-3 text-center">
                    <div class="border border-2 border-dark rounded-circle text-center">
                        <img style="border-radius:50%;overflow:hidden;background:red;" class="img-fluid" src="images/images-interface/porcentaje.png" alt="">
                    </div>
                    <h6 class="h6">Oferta</h6>
                </div>
                <div class="col-3 p-3 text-center">
                    <a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Tabletas.php" class="text-decoration-none text-dark">
                        <div class="border border-2 border-dark rounded-circle text-center">
                            <img style="border-radius:50%;overflow:hidden;" class="img-fluid" src="images/images-products/20220525001951.png" alt="">
                        </div>
                        <h6 class="h6">Tabletas</h6>
                    </a>
                </div>
                <div class="col-3 p-3 text-center">
                    <a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Celulares.php" class="text-decoration-none text-dark">
                        <div class="border border-2 border-dark rounded-circle text-center">
                            <img style="border-radius:50%;overflow:hidden;" class="img-fluid" src="images/images-products/20220525001969.png" alt="">
                        </div>
                        <h6 class="h6">Celulares</h6>
                    </a>
                </div>
                <div class="col-3 p-3 text-center">
                    <a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Televisores.php" class="text-decoration-none text-dark">
                        <div class="border border-2 border-dark rounded-circle text-center">
                            <img style="border-radius:50%;overflow:hidden;" class="img-fluid" src="images/images-products/20220525001972.png" alt="">
                        </div>
                        <h6 class="h6">Televiores</h6>
                    </a>
                </div>
                <div class="col-3 p-3 text-center">
                    <a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Audifonos.php" class="text-decoration-none text-dark">
                        <div class="border border-2 border-dark rounded-circle text-center">
                            <img style="border-radius:50%;overflow:hidden;" class="img-fluid" src="images/images-products/20220525001976.png" alt="">
                        </div>
                        <h6 class="h6">Audifonos</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- OFERTA -->
    <div class="container-fluid mt-4 px-4">
        <div class="border border-3 border-dark p-2">
            <h2 class="h2 text-center pb-3">En Oferta</h2>

            <div class="row">
                <?php
                    $condicion = $producto->ListarProductosEnOferta();

                    if($condicion){
                        foreach ($condicion as $dato) { ?>
                            <div class="col-3">
                                <a href="http://localhost/elitesac/pages/view/DetalleProducto/DetalleProducto.php?id_producto=<?=$dato->id?>" class="text-decoration-none text-dark">
                                    <div class="card border-0 p-0">
                                        <img src="images/images-products/<?=$dato->imagen?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text w-100 overflow-hidden" style="max-height:60px;text-overflow: ellipsis;-webkit-line-clamp: 2;-webkit-box-orient: vertical;display: -webkit-box;">
                                            <?=$dato->descripcion?>
                                                </p>
                                            
                                            <span class="card-text text-primary"><?=($dato->estado == 'S') ? 'Segunda mano' : 'Reparado'?></span>
                                            <div>
                                                <span class="card-text text-decoration-line-through text-danger">S/<?=$dato->precio?></span>
                                                <span class="card-text text-secondary ms-2">S/<?=$dato->precioDescuento?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                <?php } } ?>
               
                <div class="col-12 text-center mt-3">
                    <a href="http://localhost/elitesac/pages/view/Productos/Productos.php" class="btn btn-primary px-3">Ver todo</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'pages/view/layout/footer.php'; ?>
    
</body>
</html>