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
    <title>Mis Publicaciones</title>
</head>

<body>

    <?php 
        session_start();
        require '../../../bd/conexion.php';
        require '../../model/Usuario/Usuario.php';

        $publicaciones = new Usuario();
     
        if(!isset($_SESSION['usuario-cliente'])){
            header("location: http://localhost/elitesac/pages/IniciarSesion.php");
        }
    ?>

    <?php include('../layout/header.php'); ?>

    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12 col-sm-10  mx-auto">
                <h1 class="h1 text-center mb-4">Mis Publicaciones</h1>

                <div class="float-end mb-4">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle shadow-none btn-lg" data-bs-toggle="dropdown" aria-expanded="false">
                            Ordenar por
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropupCenterBtn">
                            <li><a href="" class="dropdown-item">Precio</a></li>
                            <li><a href="" class="dropdown-item">Precio Descuento</a></li>
                            <li><a href="" class="dropdown-item">Cantidad</a></li>
                            <li><a href="" class="dropdown-item">Código</a></li>
                            <li><a href="" class="dropdown-item">Categoría</a></li>
                            <li><a href="" class="dropdown-item">Publicados</a></li>
                            <li><a href="" class="dropdown-item">En Revision</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4 table-responsive-sm">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                                <th>Precio</th>
                                <th>Descuento</th>
                                <th>Categoría</th>
                                <th>Estatus</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="align-middle table-sm">
                            <?php
                                $condicion = $publicaciones->ListarPublicacionPorIDUsuario($_SESSION['usuario-cliente']['id']);
                                // $totalCompra = 0;
                                if($condicion){
                                    foreach ($condicion as $dato) { ?>
                                        <tr>
                                            <td><?=$dato->id?></td>
                                            <td>
                                                <img style="width:60px;height:60px;object-fit:contain" src="../../../images/images-products/<?=$dato->imagen?>" alt="<?=$dato->producto?>">
                                            </td>
                                            <td>
                                            <div class="row">
                                                    <div class="col-10 text-truncate mx-auto">
                                                        <?=$dato->nombre?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="d-inline-block text-truncate" style="max-width: 160px;">
                                                    <?=$dato->descripcion?>
                                                </span>
                                            </td>
                                            <td><?=$dato->cantidad?>u.</td>
                                            <td><?=$dato->estado?></td>
                                            <td>S/<?=$dato->precio?></td>
                                            <td>S/<?=$dato->precioDescuento?></td>
                                            <td><?=$dato->categoria?></td>
                                            <td><?=$dato->estatus?></td>
                                            <td>
                                                <div class="btn-group dropstart" role="group" aria-label="Button group with nested dropdown">
                                                    <!-- <div class="btn-group dropstart" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle shadow-none btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                        ver
                                                        </button>
                                                        <ul class="dropdown-menu border-0" aria-labelledby="dropupCenterBtn" style="width:25rem">
                                                            <li>
                                                                <div class="card">
                                                                    <img style="width:100%;height:10rem;object-fit:contain" src="https://bit.ly/3sqDLI0" class="card-img-top" alt="...">
                                                                    <div class="card-body">
                                                                        <p class="card-text">
                                                                            <p><b>Código de Producto: </b><span class="fs-6">2</span></p>
                                                                            <p><b>Nombre: </b><span class="fs-6">Tablet Táctil</span></p>
                                                                            <p><b>Descripción: </b><span class="fs-6">Lorem ipssumeneriam accusamus labore totam nihil corporis eligendi distinctio illum sapiente. Vero sapiente neque impedit hic odit quaerat eum eaque fugit nihil.</span></p>
                                                                            <p><b>Cantidad: </b><span class="fs-6">30u. mano</span></p>
                                                                            <p><b>Estado: </b><span class="fs-6">Segunda mano</span></p>
                                                                            <p><b>Precio: </b><span class="fs-6">S/300</span></p>
                                                                            <p><b>Descuento: </b><span class="fs-6">S/299</span></p>
                                                                            <p><b>Categoría: </b><span class="fs-6">Computadoras</span></p>
                                                                        </p>
                                                                    </div>
                                                                </div> 
                                                            </li>
                                                        </ul>
                                                    </div> -->
                                                    <button type="button" class="btn btn-success shadow-none btn-sm" idProducto="<?=$dato->id?>" id="vp-btnEditarProducto"><i class="fa-solid fa-pen"></i></button>
                                                    <button type="button" class="btn btn-danger shadow-none btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                <?php } ?>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="9">Usted todavia no a realizado ninguna publicacion</td>
                                    </tr>
                                <?php } ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include('../layout/footer.php'); ?>
</body>
</html>
