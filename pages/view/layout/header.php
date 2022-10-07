<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
        <div class="navbar-brand"><i class="fa-solid fa-cube"></i> Envío gratis para pedidos superiores a S/1200</div>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="http://localhost/elitesac/pages/view/info/AcercaDe.php" class="nav-link">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/elitesac/pages/view/info/Contacto.php" class="nav-link">Contacto</a>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/elitesac/pages/view/info/Ayuda.php" class="nav-link">Centro de ayuda</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link disabled">Llámenos 123-456-7890</a>
                </li>
            </ul>
        <div>
    </div>
</nav>

<div class="container-fluid py-3">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center justify-content-between py-2" style="width:600px">
            <div>
                <a href="http://localhost/elitesac/index.php" class="text-decoration-none text-dark d-flex align-items-center">
                    <img src="http://localhost/elitesac/images/images-interface/logo-bg.png" alt="Logo Elite" style="width: 100px;">
                    <span style="font-family: arial;font-size:3.2rem;">ELITE</span>
                </a>
            </div>
            <div>
                <div class="input-group" style="width:300px;">
                    <input type="text" class="form-control shadow-none" id="txtBuscarProductoIndex" placeholder="Buscar producto...">
                    <div class="input-group-append">
                        <button class="btn btn-primary shadow-none" type="button" style="border-radius: 0 32px 32px 0;height:38px;" id="btnBuscarProductoIndex">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
                <div class="position-absolute mt-1" style="width:300px;z-index:200">
                    <ul class="list-group" id="listaKeyupProductos">
                        <!-- <a href="" class="text-dark text-decoration-none"><li class="list-group-item">Tablet xd</li></a> -->
                        <!-- <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end" style="width:210px;min-width:210px;">
        
            <?php
                if(isset($_SESSION['usuario-cliente'])){ ?>
                    <div class="dropdown position-relative" style="width:66px">
                        <button class="btn btn-light shadow-none dropdown-toggle fs-5" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle" width="100%" src="http://localhost/elitesac/images/images-users/<?=$_SESSION['usuario-cliente']['foto']?>" alt="">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/MiCuenta/MiCuenta.php">Mi Cuenta</a></li>
                            <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/MiCuenta/PublicarProducto.php">Publicar Producto</a></li>
                            <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/MiCuenta/VerCompras.php">Ver Compras</a></li>
                            <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/MiCuenta/VerPublicaciones.php">Mis Publicaciones</a></li>
                            <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/MiCuenta/VerProductosEnRevision.php">Productos en Revision</a></li>
                            <li>
                                <form action="http://localhost/elitesac/pages/controller/UsuarioController.php" method="post">
                                    <input class="form-control bg-none dropdown-item shadow-none" type="submit" name="btn-cerrar-session" value="Salir">
                                </form>
                                <!-- <a class="dropdown-item" href="#">Salir</a> -->
                            </li>
                        </ul>
                    </div>
                    <a href="http://localhost/elitesac/pages/view/Carrito/Carrito.php" class="text-secondary text-decoration-none mx-sm-4 mx-lg-5 fs-5">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <!-- <span class="fs-5" id="txtCantidadCarrito">0</span> -->
                    </a>
            <?php } ?>

            <?php
                if(!isset($_SESSION['usuario-cliente'])){ ?>
                    <a href="http://localhost/elitesac/pages/IniciarSesion.php" class="text-secondary text-decoration-none px-2">
                        <i class="fa-solid fa-user text-secondary"></i>
                        Iniciar Sesion
                    </a>
                    <a href="http://localhost/elitesac/pages/Registrar.php" class="text-secondary text-decoration-none">
                        Registrar
                    </a>
            <?php } ?>
        </div>
    </div>
</div>

<div class="container-fluid w-100 p-0 ps-2">
    <div class="d-flex justify-content-start align-items-centerborder-top border-bottom">
        <a href="http://localhost/elitesac/pages/view/Productos/Productos.php" class="btn btn-light px-2">Productos</a>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle shadow-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Electrodomesticos
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Computadoras.php">Computadoras</a></li>
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/DronesyCamaras.php">Drones y Cámaras</a></li>
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Tabletas.php">Tabletas</a></li>
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Audifonos.php">Audífonos</a></li>
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Parlantes.php">Parlantes</a></li>
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Celulares.php">Celulares</a></li>
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/Televisores.php">Televisores</a></li>
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Electrodomesticos/TecnologiaPortatil.php">Tecnología Portátil</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle shadow-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Muebles
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Muebles/Roperos.php">Roperos</a></li>
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Muebles/Mesas.php">Mesas</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle shadow-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Moda
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Moda/Calzados.php">Calzados</a></li>
                <li><a class="dropdown-item" href="http://localhost/elitesac/pages/view/Productos/Moda/Jeans.php">Jeans</a></li>
            </ul>
        </div>
    </div>
</div>