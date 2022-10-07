<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../../../images/images-interface/logo.png"></link>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="../../../../css/bootstrap/bootstrap.min.css">
    <!-- ICON AWESOME -->
    <link rel="stylesheet" href="../../../../css/fontawesome/css/all.min.css">
    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../../../../css/estilos.css">
    <title>Tecnología Portátil</title>
</head>

<body>

    <?php
        session_start();
        require '../../../../bd/conexion.php';
        require '../../../../pages/model/TecnologiaPortatil/TecnologiaPortatil.php';
        $objeto = new TecnologiaPortatil();
        $tecnologiaPortatil = $objeto->ListarTecnologiaPortatil();
        $precio_mas_bajo = $objeto->ListarPrecioMasbajo();
    $precio_mas_alto = $objeto->ListarPrecioMasAlto();
    ?>

    <?php include '../../../../pages/view/layout/header.php'; ?>

    <div class="container-fluid container_fluid_keyframe830w mt-4">

        <h1 class="h1 text-center">Tecnología Portátil</h1>
            
        <div class="mt-4">
            <div class="d-flex">
                <div style="width:13rem;" class="filtradoby_keyframe830w2">
                    <h4 class="h3">Filtrado por</h4>
                    <hr>

                    <div>
                        <div class="d-flex justify-content-between align-items-center py-2 drop_categoria" style="cursor: pointer" >
                            <div class="fs-6 fw-bolder">Tecnología Portátil</div>
                                    
                            <div>
                                <div style="width:10px;height:4px;background: #222;border-radius:10px;cursor:pointer"></div>
                            </div>
                        </div>
                        <div class="ml-2 drop_categoria_down">
                            <span class="d-block"><a href="#" class="text-decoration-none text-dark">Todo</a></span>
                            <span class="d-block"><a href="#" class="text-decoration-none text-dark">Oferta</a></span>
                            <span class="d-block"><a href="#" class="text-decoration-none text-dark">Mas vendidos</a></span>
                        </div>
                    </div>

                    <hr>

                    <div>
                        <div class="d-flex justify-content-between align-items-center py-2 drop_categoria"  style="cursor: pointer">
                            <div class="fs-6">Precio</div>
                            <div>
                                <div style="width:10px;height:4px;background: #222;border-radius:10px;cursor:pointer"></div>
                            </div>
                        </div>
                        <div class="ml-2 drop_categoria_down">
                            <input type="range" min="<?=$precio_mas_bajo->precioDescuento?>" max="<?=$precio_mas_alto->precioDescuento?>" value="<?=$precio_mas_bajo->precioDescuento?>" class="w-100 col-8 mx-auto d-block" id="range-precio-producto" idCategoria="<?=$precio_mas_bajo->idCategoria?>">

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
                    <div style="display: grid;grid-template-columns: repeat(auto-fill,minmax(280px, 1fr));grid-gap: 2.1rem 1.8rem;" id="container-show-producto" idCategoria="<?=$precio_mas_bajo->idCategoria?>">
                        <?php
                            foreach ($tecnologiaPortatil as $datos) { ?>
                                <a href="http://localhost/elitesac/pages/view/DetalleProducto/DetalleProducto.php?id_producto=<?=$datos->id?>" class="text-decoration-none text-dark">
                                    <div class="card border border-0" style="cursor:pointer;">
                                        <div class="card_img_scale text-center">
                                            <img  src="http://localhost/elitesac/images/images-products/<?=$datos->imagen?>" class="img-fluid img_scale" alt="...">
                                        
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
                                            <span class="card-text d-inline text-danger text-decoration-line-through fs-6">S/<?=$datos->precio?></span>
                                            <span class="card-text d-inline text-success ps-2 fs-6">S/<?=$datos->precioDescuento?></span> 
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
                        <button type="submit" class="btn btn-primary" id="comprar_mas_productos">Comprar mas</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../../../pages/view/layout/footer.php'; ?>
    <script src="../../../../js/Range.js"></script>
</body>
</html>