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
    <title>Finalizar Compra</title>
</head>

<body>

    <?php 
        session_start();
        require '../../../bd/conexion.php';
        require '../../model/Productos/Productos.php';
        $objeto = new Productos();
        if(!isset($_SESSION['usuario-cliente'])){
            header("location: http://localhost/elitesac/index.php");
        }
    ?>

    <?php include('../layout/header.php'); ?>

    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12 col-sm-10 col-md-8 col-xl-6 mx-auto">
                <h1 class="h1 text-center mb-4">Finalizar Compra</h1>
                <form action="" id="form-finalizar-compra" name="form-finalizar-compra" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="fc-tipo-pago" class="form-label">Tipo de Pago</label>
                                <select class="form-select shadow-none" name="fc-tipo-pago" id="fc-tipo-pago">
                                    <option value="" selected disabled>Seleccione un método de pago</option>
                                    <?php
                                        $metodopago = $objeto->ListarMetodosDePago();
                                        foreach ($metodopago as $dato) { ?>
                                            <option value="<?=$dato->id?>"><?=$dato->nombre?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="fc-codigo-cuenta" class="form-label">Código de Cuenta</label>
                                <input type="text" class="form-control shadow-none" id="fc-codigo-cuenta" name="fc-codigo-cuenta" placeholder="Agregue un código de cuenta">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="fc-codigo-ccv" class="form-label">Código CCV</label>
                                <input type="text" class="form-control shadow-none" id="fc-codigo-ccv" name="fc-codigo-ccv" placeholder="Agregue un código ccv">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="fc-confirmar-codigo-ccv" class="form-label">Confirmar Código CCV</label>
                                <input type="text" class="form-control shadow-none" id="fc-confirmar-codigo-ccv" name="fc-confirmar-codigo-ccv" placeholder="Confirme su código ccv">
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="mb-4">
                                <span>Total:&nbsp;&nbsp;S/<span id="fc-total-carrito"><?=(!empty($_SESSION['subtotal_total']) ? $_SESSION['subtotal_total'] : 0)?></span></span>
                            </div>
                        </div>
                    </div>

                    <button tyle="submit" class="btn btn-success">Finalizar compra</button>
                    <a href="http://localhost/elitesac/pages/view/Carrito/Carrito.php" class="btn btn-primary">Regresar</a>
                </form>
            </div>
        </div>
    </div>

    <?php include('../layout/footer.php'); ?>
    <script src="../../../js/FinalizarCompra.js"></script>
    <script src="../../../js/sweetalert/sweetalert.js"></script>
</body>
</html>