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
    <title>Publicar Producto</title>
</head>

<body>

    <?php
        session_start();
        require '../../../bd/conexion.php';
        require '../../model/Productos/Productos.php';

        $productos = new Productos();
   
        if(!isset($_SESSION['usuario-cliente'])){
            header("location: http://localhost/elitesac/pages/IniciarSesion.php");
        }
    ?>

    <?php include '../layout/header.php'; ?>

    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12 col-sm-10 col-md-8 col-xl-6 mx-auto">
                <h1 class="h1 text-center mb-4">Publicar Producto</h1>
                <form action="" id="form-public-product-usuario" name="form-public-product-usuario" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="public-product-nombre" class="form-label">Nombre Producto</label>
                                <input type="text" class="form-control shadow-none" id="public-product-nombre" name="public-product-nombre" placeholder="Escriba nombre del producto">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="public-product-categoria" class="form-label">Categoría</label>
                                <select name="public-product-categoria" id="public-product-categoria" class="form-select shadow-none">
                                    <option value="" selected disabled>Seleccione una categoría</option>

                                    <?php
                                        $condicion = $productos->listarCategorias();

                                        if($condicion){
                                            foreach ($condicion as $dato) { ?>
                                                <option value="<?=$dato->id?>"><?=$dato->nombre?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="public-product-descripcion" class="form-label">Descripcion</label>
                                <textarea style="resize: none;" class="form-control shadow-none" name="public-product-descripcion" id="public-product-descripcion" cols="10" rows="4" placeholder="Escriba una descripción"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="public-product-estado" class="form-label">Estado</label>
                                <select name="public-product-estado" id="public-product-estado" class="form-select shadow-none">
                                    <option value="" selected disabled>Seleccione el estado del producto</option>
                                    <option value="R">Reparado</option>
                                    <option value="S">Segunda mano</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="public-product-cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control shadow-none" id="public-product-cantidad" name="public-product-cantidad" placeholder="Escriba una cantidad">
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="public-product-precio" class="form-label">Precio</label>
                                <input type="number" class="form-control shadow-none" id="public-product-precio" name="public-product-precio" placeholder="Escriba un precio ">
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="public-product-precioDescuento" class="form-label">Precio Descuento</label>
                                <input type="number" class="form-control shadow-none" id="public-product-precioDescuento" name="public-product-precioDescuento" placeholder="scriba un descuento del precio">
                            </div>
                        </div> 
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="public-product-imagen" class="form-label">Imagen Referencial</label>
                                <input type="file" name="public-product-imagen" id="public-product-imagen" class="form-control shadow-none">
                            </div>
                        </div> 
                        <div class="text-center mx-auto" style="width:50%">
                            <div class="mb-2">
                                <img style="width:100%;object-fit:contain" class="img-fluid" id="prevImg"  alt="">
                            </div>
                        </div>
                    </div>
                    <button tyle="submit" class="btn btn-success" id="btn-public-product">Aceptar</button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../layout/footer.php'; ?>
    <script src="../../../js/publicarProducto.js"></script>
    <script src="../../../js/sweetalert/sweetalert.js"></script>
</body>
</html>