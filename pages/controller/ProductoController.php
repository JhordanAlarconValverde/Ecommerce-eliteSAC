<?php
    session_start();
    require '../../bd/conexion.php';
    require '../model/Productos/Productos.php';
    require '../model/Audifonos/Audifonos.php';
    require '../model/Calzados/Calzados.php';

    require '../model/Celulares/Celulares.php';
    require '../model/Computadoras/Computadoras.php';
    require '../model/DronesyCamaras/DronesyCamaras.php';
    require '../model/Jeans/Jeans.php';
    require '../model/Mesas/Mesas.php';
    require '../model/Parlantes/Parlantes.php';
    require '../model/Roperos/Roperos.php';

    require '../model/Tabletas/Tabletas.php';
    require '../model/TecnologiaPortatil/TecnologiaPortatil.php';
    require '../model/Televisores/Televisores.php';

    require '../model/Productos/DetalleCompra.php';
    require '../model/Productos/M_DetalleCompra.php';
    require '../model/Productos/Compra.php';
    require '../model/Productos/M_Compra.php';
    
    $productos = new Productos();
    $audifonos = new Audifonos();
    $calzados = new Calzados();

    $celulares = new Celulares();
    $computadoras = new Computadoras();
    $dronesyCamaras = new DronesyCamaras();
    $jeans = new Jeans();
    $mesas = new Mesas();
    $parlantes = new Parlantes();
    $roperos = new Roperos();
    $tabletas = new Tabletas();
    $tecnologiaPortatil = new TecnologiaPortatil();
    $televisores = new Televisores();

    
    function carrito($comando){
        $usuario_carrito = $_SESSION['usuario-carrito'];
        $cantidad_productos = 0;
        $subtotal = 0;
        foreach ($usuario_carrito as $dato) {
            $cantidad_productos += $dato["productoCantidad"];
            $subtotal += $dato["productoSubtotal"];
        }

        switch ($comando) {
            case 'subtotal':
                return floatval($subtotal);
                break;
            case 'cantidad':
                return intval($cantidad_productos);
                break;            
            default:
                return intval(0);
                break;
        }
    }


    // AGREGAR CARRITO
    if(isset($_POST['agregar-carrito'])){
        $idProducto = $_POST['idProducto'];
        $cantidad = $_POST['cantidad'];
        $condicion = $productos->DetalleProductobyID($idProducto);

        if(isset($_SESSION['usuario-cliente'])){
            if($condicion){
                
                if(!isset($_SESSION['usuario-carrito']) || count($_SESSION['usuario-carrito']) == 0){
                    
                    $subtotal = 0;
                    $arreglo[] = array(
                        "usuarioID" => $_SESSION['usuario-cliente']['id'],
                        "productoID" => $idProducto,
                        "productoNombre" => $condicion->nombre,
                        "productoDescripcion" => $condicion->descripcion,
                        "productoCantidad" => $cantidad,
                        "productoPrecio" => $condicion->precio,
                        "productoPrecioDescuento" => $condicion->precioDescuento,
                        "productoFoto" => $condicion->imagen,
                        "productoSubtotal" => ($cantidad * $condicion->precioDescuento),
                        "productoMaxCantidad" => $condicion->cantidad
                    );
                    $_SESSION['usuario-carrito'] = $arreglo;
                    echo "producto agregado";
               }else{
                    $arregloCarrito = $_SESSION['usuario-carrito'];

                    $encontro = 0;
                    foreach ($arregloCarrito as $dato) {
                        if($dato['productoID'] == $idProducto){
                            $encontro = 1;
                        }
                    }

                    if($encontro == 0){
                        $arregloNuevoCarrito = array(
                            "usuarioID" => $_SESSION['usuario-cliente']['id'],
                            "productoID" => $idProducto,
                            "productoNombre" => $condicion->nombre,
                            "productoDescripcion" => $condicion->descripcion,
                            "productoCantidad" => $cantidad,
                            "productoPrecio" => $condicion->precio,
                            "productoPrecioDescuento" => $condicion->precioDescuento,
                            "productoFoto" => $condicion->imagen,
                            "productoSubtotal" => ($cantidad * $condicion->precioDescuento),
                            "productoMaxCantidad" => $condicion->cantidad
                        );

                        array_push($arregloCarrito, $arregloNuevoCarrito);
                        $_SESSION['usuario-carrito'] = $arregloCarrito;
                        echo "producto agregado";
                    }

                    if($encontro == 1){
                        // echo json_encode(array(carrito("cantidad"),"ya existe"));
                        echo "ya existe";
                    }
               }
            }
        }else{
            // echo json_encode(array("","no logueado"));
            echo "no logueado";
        }
    }

    // EDITAR CARRITO
    if(isset($_POST['cambiarCantidad'])){
        $idProducto = $_POST['idProducto'];
        $cantidad = $_POST['cantidad'];
        $arregloCarrito = $_SESSION['usuario-carrito'];

        // print_r($arregloCarrito);
        $subtotal = 0;
        foreach ($arregloCarrito as $key => $dato) {
            if($dato['productoID'] == $idProducto){
                $arregloCarrito[$key]['productoCantidad'] = $cantidad;
                $arregloCarrito[$key]['productoSubtotal'] = ($cantidad * $arregloCarrito[$key]['productoPrecioDescuento']);
            }
        }
        
        foreach ($arregloCarrito as $key => $dato) {
            $subtotal += ($dato['productoCantidad'] * $dato['productoPrecioDescuento']);
        }
        $_SESSION['subtotal_total'] = $subtotal;
        $_SESSION['usuario-carrito'] = $arregloCarrito;
    }

    // ELIMINAR PRODUCTO CARRITO
    if(isset($_POST['idProductoEliminar'])){
        $id = $_POST['idProducto'];
        $arregloCarrito = $_SESSION['usuario-carrito'];
        $subtotal = 0;
        $mensaje = "";
        foreach ($arregloCarrito as $key => $dato) {
            if($dato['productoID'] == $id){
                unset($arregloCarrito[$key]);
                $mensaje = "eliminado";
            }
        }

        foreach ($arregloCarrito as $key => $dato) {
            $subtotal += ($dato['productoCantidad'] * $dato['productoPrecioDescuento']);
        }

        $jsonshow = array($mensaje, $subtotal);
        echo json_encode($jsonshow);
        $_SESSION['usuario-carrito'] = $arregloCarrito;
        $_SESSION['subtotal_total'] = $subtotal;
    }

    // FINALIZAR COMPRA
    if(isset($_GET['btnFinalizarCompra'])){
        if(empty($_SESSION['usuario-carrito'])){
            header("location: http://localhost/elitesac/pages/view/Carrito/Carrito.php");
        }else{
            header("location: http://localhost/elitesac/pages/view/FinalizarCompra/FinalizarCompra.php");
        }
    }
    
    // RANGE PRODUCTO
     if(isset($_POST['between-producto'])){
        $idCategoria = $_POST['between-producto'];
        $valor1 = $_POST['valor1'];
        $valor2 = $_POST['valor2'];

        $condicion = "";
        $condicion_productos = "";

        switch ($idCategoria) {
            case '4':
                $condicion = $computadoras->ListarPrecioBetween($valor1, $valor2);
            break;
            case '5':
                $condicion = $tabletas->ListarPrecioBetween($valor1, $valor2);
            break;
            case '6':
                $condicion = $dronesyCamaras->ListarPrecioBetween($valor1, $valor2);
            break;
            case '7':
                $condicion = $audifonos->ListarPrecioBetween($valor1, $valor2);
            break;
            case '8':
                $condicion = $parlantes->ListarPrecioBetween($valor1, $valor2);
            break;
            case '9':
                $condicion = $celulares->ListarPrecioBetween($valor1, $valor2);
            break;
            case '10':
                $condicion = $televisores->ListarPrecioBetween($valor1, $valor2);
            break;
            case '11':
                $condicion = $tecnologiaPortatil->ListarPrecioBetween($valor1, $valor2);
            break;
            case '12':
                $condicion = $roperos->ListarPrecioBetween($valor1, $valor2);
            break;
            case '13':
                $condicion = $mesas->ListarPrecioBetween($valor1, $valor2);
            break;
            case '14':
                $condicion = $calzados->ListarPrecioBetween($valor1, $valor2);
            break;
            case '15':
                $condicion = $jeans->ListarPrecioBetween($valor1, $valor2);
            break;
            case '100':
                $condicion_productos = $productos->ListarPrecioBetween($valor1, $valor2);
            break;
            default:
                echo "error";
                break;
        }
        
        if($condicion){
            foreach ($condicion as $datos) {
                $estado = ($datos->estado == "R") ? 'Reparado' : 'Segunda mano';

                echo "
                    <a href='http://localhost/elitesac/pages/view/DetalleProducto/DetalleProducto.php?id_producto=".$datos->id."' class='text-decoration-none text-dark'>
                                <div class='card border border-0' style='cursor:pointer;'>
                                    <div class='card_img_scale text-center'>
                                        <img  src='http://localhost/elitesac/images/images-products/".$datos->imagen."' class='w-100 img-fluid img_scale' alt='".$datos->imagen."'>
                                    </div>
                                    <div class='card-body'>
                                        <span class='d-inline-block text-truncate w-100 fs-5'>".$datos->descripcion."</span>
                                        <span class='card-text text-primary fs-5'>".$estado."</span>

                                        <div>
                                        <span class='card-text d-inline text-danger text-decoration-line-through fs-6'>S/".$datos->precio."</span>
                                        <span class='card-text d-inline text-success ps-2 fs-6'>S/".$datos->precioDescuento."</span> 
                                        </div>

                                        <div class='my-3 d-lg-none d-sm-block'>
                                            <button type='button' class='w-100 btn btn-danger d-block'>Ver Producto</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                
                ";
            }
        }

        if($condicion_productos){
            foreach ($condicion_productos as $datos) {
                $estado = ($datos->estado == "R") ? 'Reparado' : 'Segunda mano';
                echo "
                    <a href='http://localhost/elitesac/pages/view/DetalleProducto/DetalleProducto.php?id_producto=".$datos->id."' class='text-decoration-none text-dark'>
                                <div class='card border border-0' style='cursor:pointer;'>
                                    <div class='card_img_scale text-center' style='height:300px;min-height:100px;object-fit:cover;'>
                                        <img  src='http://localhost/elitesac/images/images-products/".$datos->imagen."' class='img-fluid img_scale' alt='".$datos->imagen."'>
                                    </div>
                                    <div class='card-body'>
                                        <span class='d-inline-block text-truncate w-100 fs-5'>".$datos->descripcion."</span>
                                        <span class='card-text text-primary fs-5'>".$estado."</span>

                                        <div>
                                        <span class='card-text d-inline text-danger text-decoration-line-through fs-6'>S/".$datos->precio."</span>
                                        <span class='card-text d-inline text-success ps-2 fs-6'>S/".$datos->precioDescuento."</span> 
                                        </div>

                                        <div class='my-3 d-lg-none d-sm-block'>
                                            <button type='button' class='w-100 btn btn-danger d-block'>Ver Producto</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                
                ";
            }
        }
    }

    // COMPRAR MAS
    if(isset($_POST['btnComprarMas'])){
        $idCategoria = $_POST['btnComprarMas']; 
        $condicion_productos = "";
        
        switch ($idCategoria) {
            case '100':
                $condicion_productos = $productos->ListarProductos();
                break;
            
            default:
                echo "Error";
                break;
        }

        if($condicion_productos){
            foreach ($condicion_productos as $datos) {
                $estado = ($datos->estado == "R") ? 'Reparado' : 'Segunda mano';

                // $id_session = (isset($_SESSION["usuario-cliente"]['id'])) ? $_SESSION["usuario-cliente"]['id'] : '';
                // $class = ($datos->estatus == 'publicado') ? 'bg-success' : 'bg-danger';

                // if($id_session){
                //     if($id_session == $datos->idUsuario){
                //         $insert = 
                //     "<div class='position-absolute top-0 text-white p-2 ".$class."'>"
                //         .($datos->estatus == 'publicado') ? 'Mi Publicacion' : 'En Revision'.
                //     "</div>" ;
                //     }
                // }

                $html =  "
                            <a href='http://localhost/elitesac/pages/view/DetalleProducto/DetalleProducto.php?id_producto=".$datos->id."' class='text-decoration-none text-dark'>
                                <div class='card border border-0' style='cursor:pointer;'>
                                    <div class='card_img_scale text-center' style='height:300px;min-height:100px;object-fit:cover;'>
                                        <img  src='http://localhost/elitesac/images/images-products/".$datos->imagen."' class='img-fluid img_scale' alt='".$datos->imagen."'>";
                                    
                $html .=    "</div>
                                    <div class='card-body'>
                                        <span class='d-inline-block text-truncate w-100 fs-5'>".$datos->descripcion."</span>
                                        <span class='card-text text-primary fs-5'>".$estado."</span>

                                        <div>
                                        <span class='card-text d-inline text-danger text-decoration-line-through fs-6'>S/".$datos->precio."</span>
                                        <span class='card-text d-inline text-success ps-2 fs-6'>S/".$datos->precioDescuento."</span> 
                                        </div>

                                        <div class='my-3 d-lg-none d-sm-block'>
                                            <button type='button' class='w-100 btn btn-danger d-block'>Ver Producto</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                
                ";

                echo $html;
            }
        }
    }


    if(isset($_POST['btnComprarPedido'])){
        $tipoPago = !empty($_POST['tipoPago']) ? trim($_POST['tipoPago']) : '';
        $codCuenta = !empty($_POST['codCuenta']) ? trim($_POST['codCuenta']) : '';
        $codCCV = !empty($_POST['codCCV']) ? trim($_POST['codCCV']) : '';
        $codCCV2 = !empty($_POST['conCodCCV']) ? trim($_POST['conCodCCV']) : '';

        $mensaje = array();

        if($tipoPago && $codCuenta && $codCCV && $codCCV2){
            
            $compra = new Compra();
            if($codCCV == $codCCV2){
                
                if(isset($_SESSION['usuario-carrito'])){
                    $m_compra = new M_Compra();
                    $m_compra->id = '';
                    $m_compra->idUsuario = $_SESSION['usuario-cliente']['id'];
                    $m_compra->idMetodoPago = $tipoPago;
                    $m_compra->total = $_SESSION['subtotal_total'];
                    $m_compra->fechaDePago = date("Y-m-d");
                    $m_compra->fechaDeEntrega = date("Y-m-d");
                    $id_last = $compra->insertarCompra($m_compra);
                    if($id_last != 0){
                        $arreglo = $_SESSION['usuario-carrito'];
                        $detalleCompra = new DetalleCompra();
                        foreach ($arreglo as $key => $dato) {
                            $m_detalle = new M_DetalleCompra();
                            $m_detalle->id = '';
                            $m_detalle->idCompra = $id_last;
                            $m_detalle->idProducto = $dato['productoID'];
                            $m_detalle->precioProducto = $dato['productoPrecio'];
                            $m_detalle->cantidad = $dato['productoCantidad'];
                            $m_detalle->descuento = $dato['productoPrecioDescuento'];
                            $m_detalle->subtotal = $dato['productoSubtotal'];
                            $detalleCompra->insertarDetalleCarrito($m_detalle);
                        }

                        foreach ($arreglo as $dato) {
                            $nuevaCantidad = $dato["productoMaxCantidad"] - $dato["productoCantidad"];

                            $productos->actualizarStockProducto($dato["productoID"],$nuevaCantidad);
                        }

                        
                        unset($_SESSION['usuario-carrito']);
                        unset($_SESSION['subtotal_total']);
                        echo "compra exitosa";
                    }
                }
            }else{
                echo "compra fallida";
            }
        }else{
            echo "compra vacia";
        }
       
    }

    if(isset($_POST['buscar'])){
        $condicion = $productos->listarProductoPorNombre($_POST['valor'],$_POST["buscar"]);

        foreach ($condicion as $dato) {
            $enlace;
            switch ($dato->idCategoria) {
                case 4:
                    $enlace = "Electrodomesticos/Computadoras.php";
                    break;
                case 5:
                    $enlace = "Electrodomesticos/Tabletas.php";
                    break;
                case 6:
                    $enlace = "Electrodomesticos/DronesyCamaras.php";
                    break;
                case 7:
                    $enlace = "Electrodomesticos/Audifonos.php";
                    break;
                case 8:
                    $enlace = "Electrodomesticos/Parlantes.php";
                    break;
                case 9:
                    $enlace = "Electrodomesticos/Celulares.php";
                    break;
                case 10:
                    $enlace = "Electrodomesticos/Televisores.php";
                    break;
                case 11:
                    $enlace = "Electrodomesticos/TecnologiaPortatil.php";
                    break;
                case 12:
                    $enlace = "Muebles/Roperos.php";
                    break;
                case 13:
                    $enlace = "Muebles/Mesas.php";  
                    break;
                case 14:
                    $enlace = "Moda/Calzados.php";  
                    break;
                case 15:
                    $enlace = "Moda/Jeans.php";  
                    break;
            }
            echo "<a href='http://localhost/elitesac/pages/view/Productos/{$enlace}' class='text-dark text-decoration-none'><li class='list-group-item'>{$dato->nombre}</li></a>";
        }

        
        // print_r($condicion);
        // if($condicion){
        //     foreach ($condicion as $datos) {
        //         $estado = ($datos->estado == "R") ? 'Reparado' : 'Segunda mano';
        //         echo "
        //             <a href='http://localhost/elitesac/pages/view/DetalleProducto/DetalleProducto.php?id_producto=".$datos->id."' class='text-decoration-none text-dark'>
        //                         <div class='card border border-0' style='cursor:pointer;'>
        //                             <div class='card_img_scale text-center'>
        //                                 <img  src='http://localhost/elitesac/images/images-products/".$datos->imagen."' class='w-100 img-fluid img_scale' alt='".$datos->imagen."'>
        //                             </div>
        //                             <div class='card-body'>
        //                                 <span class='d-inline-block text-truncate w-100 fs-5'>".$datos->descripcion."</span>
        //                                 <span class='card-text text-primary fs-5'>".$estado."</span>

        //                                 <div>
        //                                 <span class='card-text d-inline text-danger text-decoration-line-through fs-6'>S/".$datos->precio."</span>
        //                                 <span class='card-text d-inline text-success ps-2 fs-6'>S/".$datos->precioDescuento."</span> 
        //                                 </div>

        //                                 <div class='my-3 d-lg-none d-sm-block'>
        //                                     <button type='button' class='w-100 btn btn-danger d-block'>Ver Producto</button>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                     </a>
                
        //         ";
        //     }
        // }
        // echo ;
        // print_r($_POST);
    }
?>