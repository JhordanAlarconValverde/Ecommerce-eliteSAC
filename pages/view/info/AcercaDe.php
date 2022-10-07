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
    <title>Acerca De</title>
</head>

<body>

    <?php
        session_start();
        include '../layout/header.php'; 
    ?>

    <div class="container-fluid mt-4">
            <h1 class="h1 text-center">Acerca de</h1>

            <div class="d-flex align-items-center justify-content-center mt-4 mx-auto" style="width:50rem">
                <div style="width:350px;min-height:350px;">
                    <img width="100%" height="100%" class="img-thumbnail" src="https://static.wixstatic.com/media/c837a6_57c256d2c7474590a3f295bad576b0a1~mv2.jpg/v1/fill/w_619,h_843,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/c837a6_57c256d2c7474590a3f295bad576b0a1~mv2.jpg" alt="">
                </div>
                <div class="ps-2" style="width:470px;min-height:390px;">
                    <div style="text-align:justify">
                        <span>
                            Elite SAC es una empresa fundada en 1995 por Benito Antonio Martínez Ocasio. 
                            Cuenta con un local principal ubicado en la Av. Tacna 542 - Cercado de Lima.
                            <!-- Además de sucursales en Arequipa, Huancayo, Trujillo y Chiclayo. -->
                            La empresa se dedica a la venta de artículos de segunda mano.
                            Ofrece una amplia selección en Electrodomesticos, moda, muebles para el hogar.
                            Hoy por hoy, ELITE sigue siendo reconocida y admirada por su capacidad de superar los embates del tiempo como ninguna otra compañía.
                        </span>
                    </div>
                    <div style="text-align:justify">
                        <span>
                            La empresa Elite SAC desea incursionar en el mundo de las ventas online.
                            Para ello se planea elaborar una aplicación web que permita a cualquier usuario publicar y comprar artículos, actuando Elite como un intermediario y ganando 
                            una pequeña comisión por cada venta. 
                            El usuario podrá crear una cuenta donde pueda visualizar el historial de pedidos, dirección, etc. 
                            Se podrá realizar búsqueda y filtro de productos de acuerdo a categorías, estado, precios, descuentos, etc.
                        </span>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-start mt-5 mx-auto" style="width:55rem">
                <div class="text-center mx-auto" style="width:24rem;height:28rem;">
                    <h2 class="h2 ">Misión</h2>

                    <p>Nuestra misión es elevar continuamente el nivel de la experiencia del cliente mediante el uso de Internet y la tecnología, para ayudar a los consumidores a encontrar, descubrir, comprar cualquier cosa.
                            Elite tiene un claro enfoque dirigido a los usuarios, a quienes ofrece productos y servicios de una excelente calidad.
                    </p>

                    <img width="300" height="200" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5TyAsQzYtzJxqS9sJP5qw10ixRrS4sYK-mA&usqp=CAU" alt="">
                </div>
                <div class="text-center mx-auto" style="width:24rem;height:28rem;">
                    <h2 class="h2">Visión</h2>

                    <p>Nuestra visión es ser una de las empresas de ventas online más conocidas en el rubro de electrodomésticos, muebles o moda, y hacer que los usuarios tengan más accesibilidad a nuestros productos desde la comodidad de su casa. </p>
                    <br><br>
                    <img width="300" height="200" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMl_fqBB4rXy0puOLYrhTWbHGtuh0zlLuu6w&usqp=CAU" alt="">
                </div>
            </div>
    </div>

   <?php include '../layout/footer.php'; ?>
</body>
</html>