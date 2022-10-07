<?php
    session_start();
    include '../../bd/conexion.php';
    include '../model/Usuario/Usuario.php';
    include '../model/Usuario/M_Usuario.php';
    include '../model/Productos/Productos.php';
    include '../model/Productos/M_Productos.php';
    

    $usuario = new Usuario();
    if(isset($_POST['btn-reg-usuario'])){

        $_id = !empty($_POST['reg-id']) ? trim($_POST['reg-id']) : '';
        $_idDistrito = !empty($_POST['reg-distrito']) ? trim($_POST['reg-distrito']) : '';  
        $_nombre = !empty($_POST['reg-nombre']) ? trim($_POST['reg-nombre']) : '';
        $_apellido = !empty($_POST['reg-apellido']) ? trim($_POST['reg-apellido']) : '';
        $_telefono = !empty($_POST['reg-telefono']) ? trim($_POST['reg-telefono']) : '';
        $_direccion = !empty($_POST['reg-direccion']) ? trim($_POST['reg-direccion']) : '';
        $_referencia = !empty($_POST['reg-referencia']) ? trim($_POST['reg-referencia']) : '';
        $_correo = !empty($_POST['reg-correo']) ? trim($_POST['reg-correo']) : '';
        $_clave = !empty($_POST['reg-clave']) ? trim($_POST['reg-clave']) : '';
        $_usuario = !empty($_POST['reg-usuario']) ? trim($_POST['reg-usuario']) : '';
        $_foto = !empty($_FILES['reg-img']['name']) ? trim($_FILES['reg-img']['name']) : '';
        $_confirmar = !empty($_POST['reg-confirmar-cave']) ? trim($_POST['reg-confirmar-cave']) : '';

        $_idProvincia = !empty($_POST['reg-provincia']) ? trim($_POST['reg-provincia']) : '';
        $_idDepartamento = !empty($_POST['reg-departamento']) ? trim($_POST['reg-departamento']) : '';

        $condicion_correo;
        $condicion_usuario;

        if($_nombre){
            $_SESSION['form-validation']['nombre-valid'] = $_nombre;
        }else{
            $_SESSION['form-validation']['nombre-invalid'] = "El Nombre es requerido";
        }

        if($_apellido){
            $_SESSION['form-validation']['apellido-valid'] = $_apellido;
        }else{
            $_SESSION['form-validation']['apellido-invalid'] = "El Apellido es requerido";
        }

        if($_telefono){
            $_SESSION['form-validation']['telefono-valid'] = $_telefono;
        }else{
            $_SESSION['form-validation']['telefono-invalid'] = "El Telefono es requerido";
        }

        // Ubigeo
        if($_idDepartamento){
            $_SESSION['form-validation']['idDepartamento-valid'] = $_idDepartamento;
        }else{
            $_SESSION['form-validation']['idDepartamento-invalid'] = "El Departamento es requerido";
        }

        if($_idProvincia){
            $_SESSION['form-validation']['idProvincia-valid'] = $_idProvincia;
        }else{
            $_SESSION['form-validation']['idProvincia-invalid'] = "La Provincia es requerido";
        }

        if($_idDistrito){
            $_SESSION['form-validation']['idDistrito-valid'] = $_idDistrito;
        }else{
            $_SESSION['form-validation']['idDistrito-invalid'] = "El Distrito es requerido";
        }

        if($_direccion){
            $_SESSION['form-validation']['direccion-valid'] = $_direccion;
        }else{
            $_SESSION['form-validation']['direccion-invalid'] = "La Dirección es requerido";
        }

        if($_referencia){
            $_SESSION['form-validation']['referencia-valid'] = $_referencia;
        }else{
            $_SESSION['form-validation']['referencia-invalid'] = "La Referencia es requerido";
        }

        if($_correo){
            $_SESSION['form-validation']['correo-valid'] = $_correo;

            foreach ($usuario->ListarUsuarios() as $key => $dato) {
                if($dato->correo == $_SESSION['form-validation']['correo-valid']){
                    $condicion_correo = 0;
                    unset($_SESSION['form-validation']['correo-valid']);
                    $_SESSION['form-validation']['correo-invalid'] = "Este correo ya esta en uso";
                    header('location: http://localhost/elitesac/pages/Registrar.php');
                }else{
                    $condicion_correo = 1;
                }
            }
        }else{
            $_SESSION['form-validation']['correo-invalid'] = "El Correo es requerido";
        }

        if($_usuario){
            $_SESSION['form-validation']['usuario-valid'] = $_usuario;

            foreach ($usuario->ListarUsuarios() as $key => $dato) {
                if($dato->usuario == $_SESSION['form-validation']['usuario-valid']){
                    $condicion_usuario = 0;
                    unset($_SESSION['form-validation']['usuario-valid']);
                    $_SESSION['form-validation']['usuario-invalid'] = "Este usuario ya esta en uso";
                    header('location: http://localhost/elitesac/pages/Registrar.php');
                }else{
                    $condicion_usuario = 1;
                }
            }
        }else{
            $_SESSION['form-validation']['usuario-invalid'] = "El Usuario es requerido";
        }

        if($_clave){
            $_SESSION['form-validation']['clave-valid'] = $_clave;
        }else{
            $_SESSION['form-validation']['clave-invalid'] = "La Clave es requerido";
        }
        if($_confirmar){
            $_SESSION['form-validation']['confirmar-valid'] = $_confirmar;
        }else{
            $_SESSION['form-validation']['confirmar-invalid'] = "Confirme la clave";
        }

        if($_SESSION['form-validation']['clave-valid'] != $_SESSION['form-validation']['confirmar-valid']){
            unset($_SESSION['form-validation']['clave-valid']);
            unset($_SESSION['form-validation']['confirmar-valid']);
            $_SESSION['form-validation']['clave-invalid'] = "Las claves deben coincidir";
            $_SESSION['form-validation']['confirmar-invalid'] = "Las claves deben coincidir";
            header('location: http://localhost/elitesac/pages/Registrar.php');
        }

        if($_idDistrito && $_direccion && $_referencia && $_nombre && $_apellido && $_telefono && $_correo && $_clave && $_confirmar && $_usuario){
            
            
            if($_clave == $_confirmar){
                if($condicion_correo == 1 && $condicion_usuario == 1){
                    $m_usuario = new M_Usuario();
                    $m_usuario->id = $_id;
                    $m_usuario->idDistrito = $_idDistrito;
                    $m_usuario->nombre = $_nombre;
                    $m_usuario->apellido = $_apellido;
                    $m_usuario->telefono = $_telefono;
                    $m_usuario->direccion = $_direccion;
                    $m_usuario->referencia = $_referencia;
                    $m_usuario->correo = $_correo;
                    $m_usuario->clave = $_clave;
                    $m_usuario->usuario = $_usuario;

                    if(!$_foto){
                        $foto_copy = "../../images/images-users/QzpceGFtcHBcdG1wXHBocDQ3OEMudG1w.png";
                        $foto_copy_nombre = date('YmdHms').".png";
                        echo $foto_copy_nombre;
                        copy($foto_copy, "../../images/images-users/".$foto_copy_nombre);
                        $m_usuario->foto = $foto_copy_nombre;
                    }
                    
                    $usuario->InsertarUsuario($m_usuario);

                    $condicion =$usuario->LoguearUsuario($_SESSION['form-validation']['usuario-valid'],$_SESSION['form-validation']['clave-valid']);
                    
                    if(count($condicion) > 0){
                        foreach ($condicion as $dato) {
                            $_SESSION['usuario-cliente']['id'] = $dato->id;
                            $_SESSION['usuario-cliente']['idDistrito'] = $dato->idDistrito;
                            $_SESSION['usuario-cliente']['nombre'] = $dato->nombre;
                            $_SESSION['usuario-cliente']['apellido'] = $dato->apellido;
                            $_SESSION['usuario-cliente']['telefono'] = $dato->telefono;
                            $_SESSION['usuario-cliente']['direccion'] = $dato->direccion;
                            $_SESSION['usuario-cliente']['referencia'] = $dato->referencia;
                            $_SESSION['usuario-cliente']['correo'] = $dato->correo;
                            $_SESSION['usuario-cliente']['clave'] = $dato->clave;
                            $_SESSION['usuario-cliente']['usuario'] = $dato->usuario;
                            $_SESSION['usuario-cliente']['foto'] = $dato->foto;
                        }
                        header('location: http://localhost/elitesac/index.php');
                    }
                    unset($_SESSION['form-validation']);
                }
            }
        }else{
            header('location: http://localhost/elitesac/pages/Registrar.php');
        }
    }

    if(isset($_POST['actualizar-usuario'])){
        // $condicion = $usuario->ListarUsuarioPorUsuario($_POST['mc-usuario']);

        // if(!$condicion){
            if(isset($_SESSION['usuario-cliente'])){
                $m_usuario = new M_Usuario();
                $m_usuario->id = $_SESSION['usuario-cliente']['id'];
                $m_usuario->idDistrito = $_SESSION['usuario-cliente']['idDistrito'];
                $m_usuario->nombre = !empty($_POST['mc-nombre']) ? trim($_POST['mc-nombre']) : $_SESSION['usuario-cliente']['nombre'];
                $m_usuario->apellido = !empty($_POST['mc-apellido']) ? trim($_POST['mc-apellido']) : $_SESSION['usuario-cliente']['apellido'];
                $m_usuario->telefono = !empty($_POST['mc-telefono']) ? trim($_POST['mc-telefono']) : $_SESSION['usuario-cliente']['telefono'];
                $m_usuario->direccion = $_SESSION['usuario-cliente']['direccion'];
                $m_usuario->referencia = $_SESSION['usuario-cliente']['referencia'];
                $m_usuario->correo = $_SESSION['usuario-cliente']['correo'];
                $m_usuario->clave = $_SESSION['usuario-cliente']['clave'];
                $m_usuario->usuario = !empty($_POST['mc-usuario']) ? trim($_POST['mc-usuario']) : $_SESSION['usuario-cliente']['usuario'];
                $m_usuario->foto = !empty($_FILES['fileMicuenta']['name']) ? trim($_FILES['fileMicuenta']['name']) : $_SESSION['usuario-cliente']['foto'];


                if($m_usuario->foto != $_SESSION['usuario-cliente']['foto']){
                    $temp = $_FILES['fileMicuenta']['tmp_name'];
                    $m_usuario->foto = date('YmdHms') . '.' . pathinfo($_FILES['fileMicuenta']['name'], PATHINFO_EXTENSION);
                    unlink('../../images/images-users/'.$_SESSION['usuario-cliente']['foto']);
                    move_uploaded_file($temp, '../../images/images-users/'.$m_usuario->foto);
                }

                $row = $usuario->ActualizarUsuario($m_usuario);
                $arreglo = array();
                if($row > 0){
                    $condicion = $usuario->ListarUsuarioPorID($_SESSION['usuario-cliente']['id']);
                    
                    if($condicion){
                        $_SESSION['usuario-cliente']['id'] = $condicion->id;
                        $_SESSION['usuario-cliente']['idDistrito'] = $condicion->idDistrito;
                        $_SESSION['usuario-cliente']['nombre'] = $condicion->nombre;
                        $_SESSION['usuario-cliente']['apellido'] = $condicion->apellido;
                        $_SESSION['usuario-cliente']['telefono'] = $condicion->telefono;
                        $_SESSION['usuario-cliente']['direccion'] = $condicion->direccion;
                        $_SESSION['usuario-cliente']['referencia'] = $condicion->referencia;
                        $_SESSION['usuario-cliente']['correo'] = $condicion->correo;
                        $_SESSION['usuario-cliente']['clave'] = $condicion->clave;
                        $_SESSION['usuario-cliente']['usuario'] = $condicion->usuario;
                        $_SESSION['usuario-cliente']['foto'] = $condicion->foto;
                    }
                    $arreglo = ['update-success','http://localhost/elitesac/images/images-users/'.$_SESSION['usuario-cliente']['foto']];
                    echo json_encode($arreglo);
                }else{
                    $arreglo = ['update-failed',''];
                    echo json_encode($arreglo);
                }
            }
        // }else{
        //     $arreglo = ['update-exists',''];
        //     echo json_encode($arreglo);
        // }
    }

    if(isset($_POST['iniciarSesion'])){
        $user = !empty($_POST['txt-login-user-Usuario']) ? trim($_POST['txt-login-user-Usuario']) : '';
        $clave = !empty($_POST['txt-login-password-Usuario']) ? trim($_POST['txt-login-password-Usuario']) : '';

        if($user && $clave){
            $condicion = $usuario->LoguearUsuario($user,$clave);
            if(count($condicion) > 0){
                foreach ($condicion as $dato) {
                    $_SESSION['usuario-cliente']['id'] = $dato->id;
                    $_SESSION['usuario-cliente']['idDistrito'] = $dato->idDistrito;
                    $_SESSION['usuario-cliente']['nombre'] = $dato->nombre;
                    $_SESSION['usuario-cliente']['apellido'] = $dato->apellido;
                    $_SESSION['usuario-cliente']['telefono'] = $dato->telefono;
                    $_SESSION['usuario-cliente']['direccion'] = $dato->direccion;
                    $_SESSION['usuario-cliente']['referencia'] = $dato->referencia;
                    $_SESSION['usuario-cliente']['correo'] = $dato->correo;
                    $_SESSION['usuario-cliente']['clave'] = $dato->clave;
                    $_SESSION['usuario-cliente']['usuario'] = $dato->usuario;
                    $_SESSION['usuario-cliente']['foto'] = $dato->foto;
                }
                echo "login-success";
            }else{
                echo "login-failed";
            }
        }
    }

    if(isset($_POST['publicar-producto'])){
        if(!isset($_SESSION['usuario-cliente'])){
            header('location: http://localhost/elitesac/pages/IniciarSesion.php');
        }

        $idUsuario = $_SESSION['usuario-cliente']['id'];
        $nombre = !empty($_POST['public-product-nombre']) ? trim($_POST['public-product-nombre']) : '';
        $idCategoria = !empty($_POST['public-product-categoria']) ? trim($_POST['public-product-categoria']) : '';
        $descripcion = !empty($_POST['public-product-descripcion']) ? trim($_POST['public-product-descripcion']) : '';
        $estado = !empty($_POST['public-product-estado']) ? trim($_POST['public-product-estado']) : '';
        $cantidad = !empty($_POST['public-product-cantidad']) ? trim($_POST['public-product-cantidad']) : '';
        $precio = !empty($_POST['public-product-precio']) ? trim($_POST['public-product-precio']) : '';
        $precioDescuento = !empty($_POST['public-product-precioDescuento']) ? trim($_POST['public-product-precioDescuento']) : '';
        $imagen = !empty($_FILES['public-product-imagen']['name']) ? trim($_FILES['public-product-imagen']['name']) : '';
        
        $producto = new Productos();
        if($idUsuario && $nombre && $idCategoria && $descripcion && $estado && $cantidad && $precio && $precioDescuento && $imagen){
            $m_producto = new M_Productos();
            $imagen = date('YmdHms') . "." . pathinfo($imagen, PATHINFO_EXTENSION);
            $temp = $_FILES['public-product-imagen']['tmp_name'];
            

            $m_producto->id = 0;
            $m_producto->idCategoria = $idCategoria;
            $m_producto->idUsuario = $idUsuario;
            $m_producto->nombre = $nombre;
            $m_producto->descripcion = $descripcion;
            $m_producto->cantidad = $cantidad;
            $m_producto->estado = $estado;
            $m_producto->precio = $precio;
            $m_producto->precioDescuento = $precioDescuento;
            $m_producto->imagen = $imagen;
            $m_producto->estatus = "revision";

            $num_rows = $producto->insertarProducto($m_producto);
            if($num_rows > 0){
                move_uploaded_file($temp , "../../images/images-products/".$imagen);
                echo "success";
            }else{
                echo "failed";
            }
            
        }else{
            echo "failed";
        }
    }

    if(isset($_POST['btn-cerrar-session'])){
        unset($_SESSION['usuario-cliente']);
        header('location: http://localhost/elitesac/index.php');
    }

    // UBIGEO
    if(isset($_POST['codDepartamento'])){
        $condicion = $usuario->ListarProvinciaByDepartamento($_POST['codDepartamento']);
        if($condicion){
            echo  "<option value='' selected didabled>Selecciona una provincia</option>";
                
            foreach ($condicion as $dato) {
                echo  "<option value='$dato->id'>".$dato->nombre."</option>";
            }
        }else{
            echo "<option value=''>No existen datos</option>";
        }
    }

    if(isset($_POST['codProvincia'])){
        $condicion = $usuario->ListarDistritoByProvincia($_POST['codProvincia']);
        if($condicion){
            echo  "<option value='' selected didabled>Selecciona un distrito</option>";
                
            foreach ($condicion as $dato) {
                echo  "<option value='$dato->id'>".$dato->nombre."</option>";
            }
        }else{
            echo "<option value=''>No existen datos</option>";
        }
    }


    // if(isset($_POST['actualizar-usuario'])){
    //     if(isset($_SESSION['usuario-cliente'])){
    //         // $id = $_SESSION['usuario-cliente']['id'];
    //         print_r($_SESSION['usuario-cliente']);
            // $nombre = !empty($_POST['mc-nombre']) ? trim($_POST['mc-nombre']) : $_SESSION['usuario-cliente']['nombre'];
            // $apellido = !empty($_POST['mc-apellido']) ? trim($_POST['mc-apellido']) : $_SESSION['usuario-cliente']['apellido'];
            // $telefono = !empty($_POST['mc-telefono']) ? trim($_POST['mc-telefono']) : $_SESSION['usuario-cliente']['telefono'];
            // $idDistrito = $_SESSION['usuario-cliente']['idDistrito'];
            // $direccion = $_SESSION['usuario-cliente']['direccion'];
            // $referencia = $_SESSION['usuario-cliente']['referencia'];
            // $correo = $_SESSION['usuario-cliente']['correo'];
            // $clave = $_SESSION['usuario-cliente']['clave'];
            // $usuario = !empty($_POST['mc-usuario']) ? trim($_POST['mc-usuario']) : $_SESSION['usuario-cliente']['usuario'];
            // $foto = !empty($_FILES['fileMicuenta']['name']) ? trim($_FILES['fileMicuenta']['name']) : '';

            // echo "id  --->" .$id ."\n";
            // echo "nombre  --->" .$nombre ."\n";
            // echo "apellido  --->" .$apellido ."\n";
            // echo "telefono  --->" .$telefono ."\n";
            // echo "idDistrito --->" .$idDistrito ."\n";
            // echo "direccion  --->" .$direccion ."\n";
            // echo "referencia  --->" .$referencia ."\n";
            // echo "correo  --->" .$correo ."\n";
            // echo "clave  --->" .$clave ."\n";
            // echo "usuario  --->" .$usuario ."\n";
            // echo "foto  --->" .$foto ."\n";

            // echo "Referencia = " . $_SESSION['usuario-cliente']['referencia'];
            // print_r($usuario->ListarUsuarios());
            // $m_usuario = new M_Usuario();
            // $m_usuario->id = $id;
            // $m_usuario->idDistrito = $idDistrito;
            // $m_usuario->nombre = $nombre;
            // $m_usuario->apellido = $apellido;
            // $m_usuario->telefono = $telefono;
            // $m_usuario->direccion = $direccion;
            // $m_usuario->referencia = $referencia;
            // $m_usuario->correo = $correo;
            // $m_usuario->clave = $clave;
            // $m_usuario->usuario = $usuario;
            // $m_usuario->foto = $_SESSION['usuario-cliente']['foto'];
            // $usuario->actualizarUsuario($m_usuario);
            // if($foto){
            //     $foto_temp = $_FILES['fileMicuenta']['tmp_name'];
            //     $foto = date('YmdHms') . '.' . pathinfo($foto, PATHINFO_EXTENSION);
            //     copy($foto_temp, 'http://localhost/elitesac/images/images-users/'.$foto);

            // }else{
            //     $foto = $_SESSION['usuario-cliente']['foto'];
            // }
            
            // $m_usuario->foto = $foto;
            // // echo "<pre>";
            // // print_r($m_usuario);
            // $condicion = $usuario->actualizarUsuario($m_usuario);

            // if($condicion){
            //     echo "usurio actualizado";
            // }else{
            //     echo "error";
            // }
            // echo "actualizado xd";
        // }

        // // ;
        // print_r($usuario->ListarUsuarios());
        // $usuario->actualizarUsuario($m_usuario);
        // header("location: http://localhost/elitesac/pages/view/MiCuenta/MiCuenta.php");
        // print_r($m_usuario);
    // }

?>