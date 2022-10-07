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
    <title>Productos</title>
</head>

<body>

    <?php
        session_start();
        require '../../../bd/conexion.php';
        require '../../model/Productos/Productos.php';
        $objeto = new Productos();
        $productos = $objeto->Listar8Productos();
        $precio_mas_bajo = $objeto->ListarPrecioMasbajo();
        $precio_mas_alto = $objeto->ListarPrecioMasAlto();
    ?>

    <?php include('../layout/header.php'); ?>

    <div class="container-fluid container_fluid_keyframe830w mt-4"> 
        <h1 class="h1 text-center">Productos</h1>
            
        <div class="mt-4">
            <div class="d-flex d_flex_filtradoby_keyframe830w1 d_flex_filtradoby_keyframe830w2">
                <div style="width:13rem;" class="filtradoby_keyframe830w1 filtradoby_keyframe830w2">
                    <h4 class="h4 h4_keyframe830w2">Filtrado por</h4>
                    <hr>

                    <div>
                        <div class="d-flex justify-content-between align-items-center py-2 drop_categoria"  style="cursor: pointer">
                            <div class="fs-6 fw-bolder">Electrodomésticos</div>
                                    
                            <div>
                                <div style="width:10px;height:4px;background: #222;border-radius:10px;cursor:pointer"></div>
                            </div>
                        </div>

                        <div class="ml-2 drop_categoria_down">
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Computadoras.php" class="text-decoration-none text-dark">Computadoras</a></span>
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Tabletas.php" class="text-decoration-none text-dark">Tabletas</a></span>
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/DronesyCamaras.php" class="text-decoration-none text-dark">Drones y Cámaras</a></span>
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Audifonos.php" class="text-decoration-none text-dark">Audífonos</a></span>
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Parlantes.php" class="text-decoration-none text-dark">Parlantes</a></span>
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Celulares.php" class="text-decoration-none text-dark">Celulares</a></span>
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Televisores.php" class="text-decoration-none text-dark">Televisores</a></span>
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/TecnologiaPortatil.php" class="text-decoration-none text-dark">Tecnología Portátil</a></span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center py-2 drop_categoria"  style="cursor: pointer">
                            <div class="fs-6 fw-bolder">Muebles</div>
                            <div>
                                <div style="width:10px;height:4px;background: #222;border-radius:10px;cursor:pointer"></div>
                            </div>
                        </div>

                        <div class="ml-2 drop_categoria_down">
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Muebles/Roperos.php" class="text-decoration-none text-dark">Roperos</a></span>
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Muebles/Mesas.php" class="text-decoration-none text-dark">Mesas</a></span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center py-2 drop_categoria"  style="cursor: pointer">
                            <div class="fs-6 fw-bolder">Moda</div>

                            <div>
                                <div style="width:10px;height:4px;background: #222;border-radius:10px;cursor:pointer"></div>
                            </div>
                        </div>

                        <div class="ml-2 drop_categoria_down">
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Moda/Calzados.php" class="text-decoration-none text-dark">Calzados</a></span>
                            <span class="d-block"><a href="http://localhost/elitesac/pages/view/Productos/Moda/Jeans.php" class="text-decoration-none text-dark">Jeans</a></span>
                        </div>
                    </div>

                    <hr>

                    <div>
                        <div class="d-flex justify-content-between align-items-center py-2 drop_categoria"  style="cursor: pointer">
                            <div class="fs-6 fw-bolder">Precio</div>
                            <div>
                                <div style="width:10px;height:4px;background: #222;border-radius:10px;cursor:pointer"></div>
                            </div>
                        </div>

                        <div class="ml-2 drop_categoria_down">
                            <input type="range" min="<?=$precio_mas_bajo->precioDescuento?>" max="<?=$precio_mas_alto->precioDescuento?>" value="<?=$precio_mas_bajo->precioDescuento?>" class="w-100 col-8 mx-auto d-block" id="range-precio-producto" idCategoria="100">
                            <div class="d-flex justify-content-between mx-2 mt-1">
                                <span>
                                    <small>S/</small>
                                    <small class="precio-minimo-producto"><?=$precio_mas_bajo->precioDescuento?></small>
                                </span>
                                <span>
                                    <small>S/</small>
                                    <small class="precio-maximo-producto"><?=$precio_mas_alto->precioDescuento?></small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr>
                </div>
        
                <div class="w-100 ps-4">
                    <div style="display: grid;grid-template-columns: repeat(auto-fill,minmax(280px, 1fr));grid-gap: 2.1rem 1.8rem;" id="container-show-producto" idCategoria="100">
                        <?php
                            foreach ($productos as $datos) { ?>
                            <a href="http://localhost/elitesac/pages/view/DetalleProducto/DetalleProducto.php?id_producto=<?=$datos->id?>" class="text-decoration-none text-dark">
                                <div class="card border border-0" style="cursor:pointer;">
                                    <div class="card_img_scale text-center" style="height:300px;min-height:100px;object-fit:cover;">
                                        <img src="../../../images/images-products/<?=$datos->imagen?>" class="w-100 img-fluid img_scale" alt="...">
                                    
                                        <?php
                                            $id_session = (isset($_SESSION["usuario-cliente"]['id'])) ? $_SESSION["usuario-cliente"]['id'] : '';
                                            if($id_session){
                                                if($id_session == $datos->idUsuario){ ?>
                                                    <div class="position-absolute top-0 text-white p-2 <?=($datos->estatus == 'publicado') ? 'bg-success' : 'bg-danger'?>">
                                                        <?=($datos->estatus == 'publicado') ? 'Mi Publicacion' : 'En Revision'?>
                                                    </div>
                                                <?php } } ?>
                                    </div>
                                    <div class="card-body">
                                        <span class="d-inline-block text-truncate w-100 fs-5"><?=$datos->descripcion?></span>
                                        <span class="card-text text-primary fs-5"><?=($datos->estado == "R") ? 'Reparado' : 'Segunda mano'?></span>

                                        <div>
                                        <span class="card-text d-inline text-danger text-decoration-line-through f-6">S/<?=$datos->precio?></span>
                                        <span class="card-text d-inline text-success ps-2 f-6">S/<?=$datos->precioDescuento?></span> 
                                        </div>

                                        <div class="my-3 d-lg-none d-sm-block">
                                            <button type="button" class="w-100 btn btn-danger d-block">Ver Producto</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php } ?> 
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary" id="comprar_mas_productos" idCategoria="100">Comprar mas</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../layout/footer.php'); ?>
    <script src="../../../js/Range.js"></script>
</body>
</html>