<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Revisión</title>
    <link rel="icon" type="image/png" href="../../images/images-interface/logo.png"></link>
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/fontawesome/css/all.min.css">
</head>
<body>
    <?php
        session_start();
        require '../../bd/conexion.php';
        require '../model/productos/productos.php';
        $productos = new productos();

        if(!isset($_SESSION['empleado'])){
            header("location: http://localhost/elitesac/admin/");
        }

        // print_r($productos->listarProductosPublicados());
    ?>
    
    <div class="container-fluid p-0">
        <div class="d-flex">
            <?php include 'navegacion.php'; ?>
            <div class="float-end w-100 p-4" style="margin-left:11rem">
                <h3 class="h3 text-center mb-3">Productos en Revisión</h3>

                <div class="mb-3">
                    <div class="w-50">
                        <form action="" method="post">
                            <div class="d-flex">
                                <input type="text" class="form-control shadow-none" placeholder="Filtrar por...">
                                <button type="submit" class="btn btn-primary shadow-none mx-2">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                

                <!-- Modal -->
                <div class="modal fade" id="modal-mostrar-producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Publicar Producto</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modal-body">
                                <!-- <div class="card w-100 shadow-none border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="w-50 text-center">
                                                <img style="width:50%" src="https://bit.ly/3tfPhVH" alt="...">
                                            </div>
                                            <div class="w-50">
                                                <p>Cliente: <span class="modal-cliente"></span></p>
                                                <p>Correo: <span class="modal-correo"></span></p>
                                                <p>Nombre de usuario: <span class="modal-user"></span></p>
                                                <p>Telefono: <span class="modal-telefono"></span></p>
                                            </div>
                                        </div>

                                        <h5 class="card-title">Publicación</h5>
                                        <p class="card-text">Código: <span class="modal-descripcion"></span></p>
                                        <p class="card-text">Producto: <span class="modal-descripcion"></span></p>
                                        <p class="card-text">Descripción: <span class="modal-descripcion"></span></p>
                                        <p class="card-text">Categoría: <span class="modal-descripcion"></span></p>
                                        <p class="card-text">Cantidad: <span class="modal-descripcion"></span></p>
                                        <p class="card-text">Estado: <span class="modal-descripcion"></span></p>
                                        <p class="card-text">Precio: <span class="modal-descripcion"></span></p>
                                        <p class="card-text">Precio Descuento: <span class="modal-descripcion"></span></p>

                                        <div class="w-100 text-center">
                                            <img style="width:50%" src="https://bit.ly/3tfPhVH" alt="...">
                                        </div>
                                        
                                    </div>
                                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="eliminar-publicacion">Eliminar Publicacion</button>
                                <button type="button" class="btn btn-warning" id="editar-producto">Editar</button>
                                <button type="button" class="btn btn-success" id="publicar-producto">Publicar</button>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="table-table-responsive-md">
                    <table class="table table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Prod.</th>
                                <th>Cant.</th>
                                <th>Prec.</th>
                                <th>Desc.</th>
                                <th>Estado</th>
                                <th>Categoría</th>
                                <th>Usuario</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-sm align-middle">
                            <?php
                                $rows = $productos->listarProductosEnRevision();
                                if(count($rows) > 0){
                                    foreach ($rows as $dato) {
                                        echo "
                                        <tr>
                                            <td>
                                                <img style='width:70px;height:70px;object-fit:contain' src='../../images/images-products/".$dato->imagen."' alt=''>
                                            </td>
                                            <td>".$dato->producto."</td>
                                            <td>".$dato->cantidad."u.</td>
                                            <td>S/".$dato->precio."</td>
                                            <td>S/".$dato->precioDescuento."</td>
                                            <td>
                                                ".$dato->estado."
                                            </td>
                                            <td>".$dato->categoria."</td>
                                            <td>".$dato->usuario."</td>
                                            <td>
                                                <div class='btn-group dropstart'>
                                                    <button type='button' class='btn btn-secondary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        
                                                    </button>
                                                    <ul class='dropdown-menu mx-auto'>
                                                        <li class='dropdown-item'><button type='button' class='btn btn-sm btn-primary w-100 shadow-none btn-modal' idProducto='".$dato->id."' data-bs-toggle='modal' data-bs-target='#modal-mostrar-producto'><i class='fa-solid fa-eye'></i>&nbsp;&nbsp;Mostrar</button></li>
                                                        <li class='dropdown-item'><a href='' class='btn btn-sm btn-warning w-100 shadow-none'><i class='fa-solid fa-pen-to-square'></i>&nbsp;&nbsp;Editar</a></li>
                                                        <li class='dropdown-item'><a href='' class='btn btn-sm btn-danger w-100 shadow-none'><i class='fa-solid fa-trash-can'></i>&nbsp;&nbsp;Eliminar</a></li>    
                                                        <li class='dropdown-item'><a href='' class='btn btn-sm btn-success w-100 shadow-none'><i class='fa-solid fa-circle-check'></i>&nbsp;&nbsp;Publicar</a></li>                                    
                                                    </ul>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                            ";
                                    }
                                }else{
                                    echo "<tr><td colspan='9'>No hay productos en revisión</td></tr>";
                                }
                            

                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../../js/sweetalert/sweetalert.js"></script>

    <script>
        var btnModal = document.querySelectorAll(".btn-modal");

        btnModal.forEach((posicion, i) => {
            btnModal[i].onclick = ()=>{
                const data = new URLSearchParams("idModalBuscarProducto=" + btnModal[i].getAttribute("idProducto"));
                data.append("publicar-producto", "abrir-modal");
                fetch("http://localhost/elitesac/admin/Controller/adminController.php", {
                    method: "POST",
                    body: data
                }).then(function(response) {
                    if(response.ok){ return response.text();}
                    else{ return "Error en la llamada Ajax";}
                }).then(function(texto) {
                    let rpta = JSON.parse(texto);

                    document.querySelector("#modal-body").innerHTML = `
                        <div class="card w-100 shadow-none border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="w-50 text-center">
                                        <img style="width:50%" src="http://localhost/elitesac/images/images-users/${rpta['fotoUsuario']}" alt="...">
                                    </div>
                                    <div class="w-50">
                                        <p>Cliente: <span>${rpta['nombreUsuario'] + " " + rpta['apellidoUsuario']}</span></p>
                                        <p>Correo: <span>${rpta['correoUsuario']}</span></p>
                                        <p>Nombre de usuario: <span>${rpta['userUsuario']}</span></p>
                                        <p>Telefono: <span>${rpta['telefonoUsuario']}</span></p>
                                    </div>
                                </div>

                                <h5 class="card-title">Publicación</h5>
                                <p class="card-text">Código: <span>${rpta['id']}</span></p>
                                <p class="card-text">Producto: <span>${rpta['nombre']}</span></p>
                                <p class="card-text">Descripción: <span>${rpta['descripcion']}</span></p>
                                <p class="card-text">Categoría: <span>${rpta['categoria']}</span></p>
                                <p class="card-text">Cantidad: <span>${rpta['cantidad']}u.</span></p>
                                <p class="card-text">Estado: <span>${(rpta['estado'] == 'R' ? 'Reparado' : 'Segunda mano')}</span></p>
                                <p class="card-text">Precio: <span>S/${rpta['precio']}</span></p>
                                <p class="card-text">Precio Descuento: <span>S/${rpta['precioDescuento']}</span></p>

                                <div class="w-100 text-center">
                                    <img style="width:50%" src="http://localhost/elitesac/images/images-products/${rpta['imagen']}" alt="...">
                                </div>
                                        
                            </div>
                         </div>
                    `;

                    var btnpublicar = document.querySelector("#publicar-producto");

                    btnpublicar.onclick = ()=>{
                        const data = new URLSearchParams("idModalBuscarProducto=" + btnModal[i].getAttribute("idProducto"));
                        data.append("publicar-producto", "btn-publicar-producto");
                        fetch("http://localhost/elitesac/admin/Controller/adminController.php", {
                            method: "POST",
                            body: data
                        }).then(function(response) {
                            if(response.ok){ return response.text();}
                            else{ return "Error en la llamada Ajax";}
                        }).then(function(texto) {
                            if(texto == "success"){
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Producto publicado exitosamente',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                setTimeout(() => {
                                    location.href = "http://localhost/elitesac/admin/view/prodRevision.php";
                                }, 1500);
                                
                            }
                        }).then(function(err) {
                            console.log(err);
                        })
                    }
                }).catch(function(err) {
                    console.log(err);
                })
            } 
        });
    </script>

</body>
</html>