<div class="bg-dark text-white" style="width:11rem;height:100vh;position:fixed">
    <div>
        <!-- <span class="d-block fs-1 text-center">Elite</span> -->
        <ul class="list-unstyled">

        <?php
            if($_SESSION['empleado']['rol'] == 'Administrador'){ ?>
                <li>
                    <a class="d-block py-3 fs-5 text-white text-decoration-none" href="dashboard.php"><i class="fa-solid fa-gauge text-end" style="width:40px"></i>&nbsp;&nbsp;Dashboard</a>
                </li>
                <li>
                    <div class="btn-group dropend w-100 h-100 py-3">
                        <button type="button" class="dropdown-toggle shadow-none border-0 bg-dark text-white fs-5" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-table-list" style="width:45px"></i>Productos
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item text-decoration-none fs-6" href="productosDisponibles.php">Productos Disponibles</a></li>
                            <li><a class="dropdown-item text-decoration-none fs-6" href="productosStock.php">Productos Sin Stock</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="d-block py-3 fs-5 text-white text-decoration-none" href="usuarios.php"><i class="fa-solid fa-users text-end" style="width:40px"></i>&nbsp;&nbsp;Clientes</a>
                </li>
                <li>
                    <a class="d-block py-3 fs-5 text-white text-decoration-none" href="empleados.php"><i class="fa-solid fa-users-gear text-end" style="width:40px"></i>&nbsp;&nbsp;Empleados</a>
                </li>
                <li>
                    <a class="d-block py-3 fs-5 text-white text-decoration-none" href="ventas.php"><i class="fa-solid fa-cash-register text-end" style="width:38px"></i>&nbsp;&nbsp;Ventas</a>
                </li>
                <li>
                    <a class="d-block py-3 fs-5 text-white text-decoration-none" href=""><i class="fa-solid fa-scale-balanced text-end" style="width:40px"></i>&nbsp;&nbsp;Estadisticas</a>
                </li>
                <li>
                    <div class="btn-group dropend w-100 h-100 py-3">
                        <button type="button" class="dropdown-toggle shadow-none border-0 bg-dark text-white fs-5 " data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user" style="width:40px"></i>Mi Perfil
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item text-decoration-none fs-6" href="perfil.php">Ver Perfil</a></li>
                            <li><a class="dropdown-item text-decoration-none fs-6" id="btn-cerrar-sesion">Cerrar Sesion</a></li>
                        </ul>
                    </div>
                </li>
        <?php }

            if($_SESSION['empleado']['rol'] == 'Vendedor'){ ?>
                <li>
                    <div class="btn-group dropend w-100 h-100 py-3">
                        <button type="button" class="dropdown-toggle shadow-none border-0 bg-dark text-white fs-5" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-table-list" style="width:45px"></i>Productos
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item text-decoration-none fs-6" href="prodRevision.php">Productos por publicar</a></li>
                            <li><a class="dropdown-item text-decoration-none fs-6" href="prodPublicados.php">Productos publicados</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="d-block py-3 fs-5 text-white text-decoration-none" href="incidencias.php"><i class="fa-solid fa-person-circle-exclamation text-end" style="width:40px"></i>&nbsp;&nbsp;Incidencias</a>
                </li>
                <li>
                    <a class="d-block py-3 fs-5 text-white text-decoration-none" href="ventas.php"><i class="fa-solid fa-cash-register text-end" style="width:38px"></i>&nbsp;&nbsp;Ventas</a>
                </li>
                <li>
                    <a class="d-block py-3 fs-5 text-white text-decoration-none" href=""><i class="fa-solid fa-scale-balanced text-end" style="width:40px"></i>&nbsp;&nbsp;Estadisticas</a>
                </li>
                <li>
                    <div class="btn-group dropend w-100 h-100 py-3">
                        <button type="button" class="dropdown-toggle shadow-none border-0 bg-dark text-white fs-5 " data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user" style="width:40px"></i>Mi Perfil
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item text-decoration-none fs-6" href="perfil.php">Ver Perfil</a></li>
                            <li><a class="dropdown-item text-decoration-none fs-6" id="btn-cerrar-sesion">Cerrar Sesion</a></li>
                        </ul>
                    </div>
                </li>
        <?php }
            
        
        
        
        
        
        
        ?>
            
        </ul>
    </div>
</div>

<script>
    var btnCerrarSesion = document.querySelector("#btn-cerrar-sesion");
    btnCerrarSesion.onclick = ()=>{
        const data = new URLSearchParams("cerrarSesion=" + "cerrarSesion");
        fetch("../controller/adminController.php",{
            method: "POST",
            body: data
        }).then(function(response) {
            if(response.ok){ return response.text();}
            else{ return "Error en la llamada Ajax";}
        }).then(function(texto) {
            if(texto == "success"){
                location.href = "http://localhost/elitesac/admin/";
            }
        }).catch(function(err) {
            console.log(err);
        })
    }
    
</script>