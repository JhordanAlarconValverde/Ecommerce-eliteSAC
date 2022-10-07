<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="icon" type="image/png" href="../../images/images-interface/logo.png"></link>
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/fontawesome/css/all.min.css">
</head>
<body>
    <?php
        session_start();

        if(!isset($_SESSION['empleado'])){
            header("location: http://localhost/elitesac/admin/");
        }

        require '../../bd/conexion.php';
        require '../model/empleados/empleados.php';
        $empleados = new empleados();

        $num_rows = count($empleados->listarEmpleados());
        $num_register = 9;
        $num_pages = ceil($num_rows/$num_register);

        if(!$_GET['page']){
            header('location: http://localhost/elitesac/admin/view/empleados.php?page=1');
        }

        if($_GET['page'] < 1 || $_GET['page'] > $num_pages){
            header('location: http://localhost/elitesac/admin/view/empleados.php?page=1');
        }
    ?>
    
    <div class="container-fluid p-0">
        <div class="d-flex">
            <?php include 'navegacion.php'; ?>
            <div class="float-end border border-danger w-100 p-4" style="margin-left:11rem">
                <h3 class="h3 text-center mb-3">Lista de Empleados</h3>

                <div class="mb-3 d-flex justify-content-between">

                    <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Agregar Empleado</button>

                    <div class="w-50">
                        <!-- <form action="" method="post"> -->
                            <div class="d-flex">
                                <input type="text" class="form-control shadow-none" placeholder="Filtrar por..." name="search-value" id="search-value">
                                <select class="form-form-select-sm bg-primary text-white shadow-none" name="search-select" id="search-select">
                                    <option class="bg-white text-dark" value="" selected disabled>Seleccione filtro</option>
                                    <option class="bg-white text-dark" value="nombre">Nombre</option>
                                    <option class="bg-white text-dark" value="correo">Correo</option>
                                    <option class="bg-white text-dark" value="usuario">Usuario</option>
                                    <option class="bg-white text-dark" value="rol">Rol</option>
                                    <option class="bg-white text-dark" value="turno">Turno</option>
                                </select>
                                <!-- <button type="submit" class="btn btn-primary shadow-none mx-2">Filtrar</button> -->
                            </div>
                        <!-- </form> -->
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header border-0 border border-bottom border-secondary">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo empleado</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formulario" name="formulario">
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="reg-nombre" class="col-form-label">Nombre</label>
                                            <input type="text" class="form-control shadow-none" id="reg-nombre" name="reg-nombre">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="reg-apellido" class="col-form-label">Apellido</label>
                                            <input type="text" class="form-control shadow-none" id="reg-apellido" name="reg-apellido">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="reg-telefono" class="col-form-label">Telefono</label>
                                            <input type="text" class="form-control shadow-none" id="reg-telefono" name="reg-telefono">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="reg-correo" class="col-form-label">Correo</label>
                                            <input type="text" class="form-control shadow-none" id="reg-correo" name="reg-correo">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="reg-usuario" class="col-form-label">Usuario</label>
                                            <input type="text" class="form-control shadow-none" id="reg-usuario" name="reg-usuario">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="reg-clave" class="col-form-label">Clave</label>
                                            <input type="text" class="form-control shadow-none" id="reg-clave" name="reg-clave">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="reg-turno" class="col-form-label">Turno</label>
                                            <select class="form-select shadow-none" id="reg-turno" name="reg-turno">
                                                <option value="" selected disabled>Seleccione turno</option>
                                                <?php
                                                    $condicion = $empleados->listarTurnos();
                                                
                                                    if($condicion){
                                                        foreach ($condicion as $dato) { ?>
                                                            <option value="<?=$dato->id?>"><?=$dato->turno?></option>
                                                <?php } } ?>

                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="reg-role" class="col-form-label">Rol</label>
                                            <select class="form-select shadow-none" id="reg-role" name="reg-role">
                                                <option value="" selected disabled>Seleccione rol</option>
                                                <option value="Administrador">Administrador</option>
                                                <option value="Vendedor">Vendedor</option>
                                                <option value="Repartidor">Repartidor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger shadow-none" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary shadow-none">Agregar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                
                

                <!-- ELIMINAR EMPLEADO -->
                <div class="modal fade" id="eliminarEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar empleado</h5>
                                <button type="button" class="btn-close shadow-none bg-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="md-eliminarEmpleado">
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="modalbtn-eliminarEmpleado">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>

        
                <div class="table-table-responsive-md">
                    <table class="table table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre y Apellidos</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Turno</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-sm align-middle" id="table-body-filtrar">
                            <?php
                                if($num_rows < 9){
                                    foreach ($empleados->listarEmpleados() as $dato) {
                                        echo "
                                            <tr>
                                                <td>
                                                    <img style='width:70px;height:70px;object-fit:contain' src='../../images/images-employees/".$dato->foto."' alt=''>
                                                </td>
                                                <td class='nombreEmpleado'>".$dato->nombre ." " . $dato->apellido."</td>
                                                <td>".$dato->telefono."</td>
                                                <td>".$dato->correo."</td>
                                                <td>".$dato->usuario."</td>
                                                <td>".$dato->rol."</td>
                                                <td>".$dato->turno."</td>
                                                <td>
                                                    <div class='btn-group dropstart'>
                                                        <button type='button' class='btn btn-secondary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>
                                                            
                                                        </button>
                                                        <ul class='dropdown-menu mx-auto'>
                                                            <li class='dropdown-item'><a href='' class='btn btn-sm btn-primary w-100 shadow-none'><i class='fa-solid fa-eye'></i>&nbsp;&nbsp;Mostrar</a></li>
                                                            <li class='dropdown-item'><a href='' class='btn btn-sm btn-warning w-100 shadow-none'><i class='fa-solid fa-pen-to-square'></i>&nbsp;&nbsp;Editar</a></li>
                                                            <li class='dropdown-item'><button type='button' class='btn btn-sm btn-danger w-100 shadow-none' id='btn-Eliminarempleado' idRegistro='".$dato->id."' data-bs-toggle='modal' data-bs-target='#eliminarEmpleado'><i class='fa-solid fa-trash-can'></i>&nbsp;&nbsp;Eliminar</button></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            ";
                                    }
                                }else{
                                    $iniciar = ($_GET['page']-1) * $num_register;
                                    foreach ($empleados->listarEmpleadosLimit($iniciar, $num_register) as $dato) {
                                        echo "
                                        <tr>
                                        <td>
                                            <img style='width:70px;height:70px;object-fit:contain' src='../../images/images-users/".$dato->foto."' alt=''>
                                        </td>
                                        <td class='nombreEmpleado'>".$dato->nombre ." " . $dato->apellido."</td>
                                        <td>".$dato->telefono."</td>
                                        <td>".$dato->correo."</td>
                                        <td>".$dato->usuario."</td>
                                        <td>".$dato->rol."</td>
                                        <td>".$dato->turno."</td>
                                        <td>
                                            <div class='btn-group dropstart'>
                                                <button type='button' class='btn btn-secondary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>
                                                    
                                                </button>
                                                <ul class='dropdown-menu mx-auto'>
                                                    <li class='dropdown-item'><a href='' class='btn btn-sm btn-primary w-100 shadow-none'><i class='fa-solid fa-eye'></i>&nbsp;&nbsp;Mostrar</a></li>
                                                    <li class='dropdown-item'><a href='' class='btn btn-sm btn-warning w-100 shadow-none'><i class='fa-solid fa-pen-to-square'></i>&nbsp;&nbsp;Editar</a></li>                                  
                                                    <li class='dropdown-item'><button type='button' class='btn btn-sm btn-danger w-100 shadow-none' id='btn-Eliminarempleado' idRegistro='".$dato->id."' data-bs-toggle='modal' data-bs-target='#eliminarEmpleado'><i class='fa-solid fa-trash-can'></i>&nbsp;&nbsp;Eliminar</button></li>    
                                                </ul>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                            ";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php
                    if($num_rows > 9){ ?>
                        <ul class="pagination mx-auto">
                            <li class="page-item <?=($_GET['page']<=1) ? 'disabled' : ''?>">
                                <a class="page-link shadow-none" href="http://localhost/elitesac/admin/view/empleados.php?page=<?=$_GET['page']-1?>">Anterior</a>
                            </li>
                            
                            <?php for ($i=1; $i <= $num_pages ; $i++) { ?>
                                <li class="page-item <?=($_GET['page'] == $i) ? 'active':''?>"><a class="page-link shadow-none" href="http://localhost/elitesac/admin/view/empleados.php?page=<?=$i?>"><?=$i?></a></li>
                            <?php } ?>

                            <li class="page-item <?=($_GET['page']>=$num_pages) ? 'disabled' : ''?>">
                                <a class="page-link shadow-none" href="http://localhost/elitesac/admin/view/empleados.php?page=<?=$_GET['page']+1?>">Siguiente</a>
                            </li>
                        </ul>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
        var formulario = document.querySelector("#formulario");

        formulario.onsubmit = (e)=>{
            e.preventDefault();
            const data = new FormData(formulario);
            data.append("agregar-empleado", "agregar-empleado");
            fetch("http://localhost/elitesac/admin/Controller/adminController.php", {
                method: "POST",
                body: data
            }).then(function(response) {
                if(response.ok){ return response.text();}
                else{ return "Error en la llamada Ajax";}
            }).then(function(texto) {

                if(texto == "success"){
                    formulario.reset();
                    location.href = "http://localhost/elitesac/admin/view/empleados.php";
                }



                console.log(texto);
            }).catch(function(err) {
                console.log(err);
            })
        }

        var searchValue = document.querySelector("#search-value");
        var searchSelect = document.querySelector("#search-select");

        searchSelect.onchange = ()=>{

            searchValue.onkeyup = ()=>{
                document.querySelector("#table-body-filtrar").innerHTML = "";
                const data = new URLSearchParams("inpurValue=" + searchValue.value + "&selectValue=" + searchSelect.value);
                data.append("buscar-empleado", "buscar-empleado");
                fetch("http://localhost/elitesac/admin/Controller/adminController.php", {
                    method: "POST",
                    body: data
                }).then(function(response) {
                    if(response.ok){ return response.text();}
                    else{ return "Error en la llamada Ajax";}
                }).then(function(texto) {
                    document.querySelector("#table-body-filtrar").innerHTML += texto;
                }).catch(function(err) {
                    console.log(err);
                })
            }
        
        }


        // ELIMINAR EMPLEADO
        var btnEliminar = document.querySelectorAll("#btn-Eliminarempleado");
        var modalEliminar = document.querySelector("#md-eliminarEmpleado");
        var nombrelEliminar = document.querySelectorAll(".nombreEmpleado");
        var btnModalEliminar = document.querySelector("#modalbtn-eliminarEmpleado");

        btnEliminar.forEach((posicion, i) => {
            btnEliminar[i].onclick = ()=>{
                modalEliminar.textContent = "Esta seguro que desea borrar a " + nombrelEliminar[i].textContent + "?";

                btnModalEliminar.onclick = ()=>{
                    const data = new URLSearchParams("idEmpleadoEliminar=" + btnEliminar[i].getAttribute("idRegistro"));
                    data.append("eliminar-empleado", "eliminar-empleado");
                    fetch("http://localhost/elitesac/admin/Controller/adminController.php", {
                        method: "POST",
                        body: data
                    }).then(function(response) {
                        if(response.ok){ return response.text();}
                        else{ return "Error en la llamada Ajax";}
                    }).then(function(texto) {
                        if(texto == "success"){
                            location.href = "http://localhost/elitesac/admin/view/empleados.php";
                        }
                        console.log(texto);
                    }).catch(function(err) {
                        console.log(err);
                    })
                }
            }
        });
        // btnEliminar.onclick = ()=>{
        //     modalEliminar.textContent = "Esta seguro que desea borrar a " + nombreEmpleado + "?";
        // }

    </script>
</body>
</html>