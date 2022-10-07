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
    <title>Centro de Ayuda</title>
</head>

<body>

<?php
    session_start();
    include '../layout/header.php'; 
?>

  <div class="container-fluid mt-4">
    <h1 class="h1 text-center">Centro de ayuda</h1>

    <div class="row">
      <div class="col-12 px-5">
        <h4 class="h4">Pregunta más frecuentes</h4>
      </div>

      <div class="accordion mt-3" id="accordionPanelsStayOpenExample">
        <div class="col-12 px-3">
          <div class="accordion-item border border-0">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
              <button class="accordion-button shadow-none bg-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                ¿Protección del pago?
              </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
              <div class="accordion-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 px-3">
          <div class="accordion-item border border-0">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
              <button class="accordion-button collapsed shadow-none bg-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                ¿Devoluciones?
              </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
              <div class="accordion-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 px-3">
          <div class="accordion-item border border-0">
            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
              <button class="accordion-button collapsed shadow-none bg-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                ¿Cómo publicar un producto?
              </button>
            </h2>
            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
              <div class="accordion-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 px-3">
          <div class="accordion-item border border-0">
            <h2 class="accordion-header" id="panelsStayOpen-headingFour">
              <button class="accordion-button collapsed shadow-none bg-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                ¿Dónde puedo ver los productos que he comprado?
              </button>
            </h2>
            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
              <div class="accordion-body">
                <p>Para ver todos los productos que has comprado dirigete a la parte superior a la derecha de la pantalla > click en el menu desplegable > Ver Historial</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include '../layout/footer.php'; ?>
</body>
</html>