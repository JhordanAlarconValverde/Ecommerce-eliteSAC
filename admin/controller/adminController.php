<?php
    session_start();
    require '../../bd/conexion.php';
    require '../model/administrador/Administrador.php';
    require '../model/administrador/M_Administrador.php';
    require '../model/empleados/empleados.php';
    require '../model/empleados/m_empleados.php';
    require '../model/productos/productos.php';
    require '../model/usuarios/usuarios.php';

    $admin = new Administrador();
    $empleado = new empleados();
    $productos = new productos();
    // listarProductosEnRevisionPorID

    if(isset($_POST['role'])){
        $rol = $_POST['role'];

        // REGISTRAR
        if($rol == 0){
            $nombre = !empty($_POST['reg-admin-nombre']) ? $_POST['reg-admin-nombre'] : '';
            $apellido = !empty($_POST['reg-admin-apellido']) ? $_POST['reg-admin-apellido'] : '';
            $telefono = !empty($_POST['reg-admin-telefono']) ? $_POST['reg-admin-telefono'] : '';
            $correo = !empty($_POST['reg-admin-correo']) ? $_POST['reg-admin-correo'] : '';
            $usuario = !empty($_POST['reg-admin-usuario']) ? $_POST['reg-admin-usuario'] : '';
            $clave = !empty($_POST['reg-admin-clave']) ? $_POST['reg-admin-clave'] : '';
            $idTurno = 4;
            // $foto = 'QzpceGFtcHBcdG1wXHBocDQ3OEMudG1w.png';
            $role = 'Administrador';

            if($nombre && $apellido && $telefono && $correo && $usuario && $clave){
                $m_admin = new M_Administrador();
                $m_admin->id = 0;
                $m_admin->idTurno = $idTurno;
                $m_admin->nombre = $nombre;
                $m_admin->apellido = $apellido;
                $m_admin->telefono = $telefono;
                $m_admin->correo = $correo;
                $m_admin->clave = $clave;
                $m_admin->usuario = $usuario;

                $foto_copy = "../../images/images-employees/QzpceGFtcHBcdG1wXHBocDQ3OEMudG1w.png";
                if($foto_copy){
                    $foto_copy_nombre = date('YmdHms').".png";
                    copy($foto_copy, "../../images/images-employees/".$foto_copy_nombre);
                    $m_admin->foto = $foto_copy_nombre;
                }
                $m_admin->rol = $role;
                
                $admin->insertarAdministrados($m_admin);

                // print_r($m_admin);
                $condicion = $admin->loguearAdministrador($m_admin->correo, $m_admin->clave);


            }else{
                echo "complete los campos";
            }
        }

        // LOGUEAR
        if($rol == 1){

            $correo =!empty($_POST['reg-admin-correo']) ? $_POST['reg-admin-correo'] : '';
            $clave = !empty($_POST['reg-admin-clave']) ? $_POST['reg-admin-clave'] : '';

            $condicion = $admin->loguearAdministrador($correo, $clave);

            if($condicion){
                $_SESSION['empleado']['id'] = $condicion->id;
                $_SESSION['empleado']['idTurno'] = $condicion->idTurno;
                $_SESSION['empleado']['nombre'] = $condicion->nombre;
                $_SESSION['empleado']['apellido'] = $condicion->apellido;
                $_SESSION['empleado']['telefono'] = $condicion->telefono;
                $_SESSION['empleado']['correo'] = $condicion->correo;
                $_SESSION['empleado']['clave'] = $condicion->clave;
                $_SESSION['empleado']['usuario'] = $condicion->usuario;
                $_SESSION['empleado']['foto'] = $condicion->foto;
                $_SESSION['empleado']['rol'] = $condicion->rol;
                echo "success";
            }else{
                echo "failed";
            }
        }
        // print_r($_POST);
    }

    // REGISTRAR EMPLEADO
    if (isset($_POST['agregar-empleado'])) {
        $id = !empty($_POST['reg-id']) ? trim($_POST['reg-id']) : '';
        $nombre = !empty($_POST['reg-nombre']) ? trim($_POST['reg-nombre']) : '';
        $apellido = !empty($_POST['reg-apellido']) ? trim($_POST['reg-apellido']) : '';
        $telefono = !empty($_POST['reg-telefono']) ? trim($_POST['reg-telefono']) : '';
        $correo = !empty($_POST['reg-correo']) ? trim($_POST['reg-correo']) : '';
        $usuario = !empty($_POST['reg-usuario']) ? trim($_POST['reg-usuario']) : '';
        $clave = !empty($_POST['reg-clave']) ? password_hash(trim($_POST['reg-clave']), PASSWORD_DEFAULT) : '';
        $turno = !empty($_POST['reg-turno']) ? $_POST['reg-turno'] : '';
        $role = !empty($_POST['reg-role']) ? $_POST['reg-role'] : '';
        // $foto = "QzpceGFtcHBcdG1wXHBocDQ3OEMudG1w.png";
        
    
        if($nombre && $apellido && $telefono && $correo && $usuario && $clave && $role ){
            $m_empleados = new m_empleados();
            $m_empleados->id = $id;
            $m_empleados->idTurno = $turno;
            $m_empleados->nombre = $nombre;
            $m_empleados->apellido = $apellido;
            $m_empleados->telefono = $telefono;
            $m_empleados->correo = $correo;
            $m_empleados->clave = $clave;
            $m_empleados->usuario = $usuario;

            $foto_copy = "../../images/images-employees/QzpceGFtcHBcdG1wXHBocDQ3OEMudG1w.png";
            if($foto_copy){
                $foto_copy_nombre = date('YmdHms').".png";
                copy($foto_copy, "../../images/images-employees/".$foto_copy_nombre);
                $m_empleados->foto = $foto_copy_nombre;
            }
            $m_empleados->rol = $role;

            if($_POST['agregar-empleado']){
                $empleado->insertarEmpleado($m_empleados);
                echo "success";
            }
            // print_r($m_empleados);
            // echo $_POST['agregar-empleado'];
            // echo $nombre;
            // echo $apellido;
            // echo $telefono;
            // echo $correo;
            // echo $usuario;
            // echo $clave;
            // echo $rol;
            // echo $foto;
        }else{
            echo "no";
        }
    }

    // BUSCAR EMPLEADO
    if(isset($_POST['buscar-empleado'])){
        $inputValue = !empty($_POST['inpurValue']) ? $_POST['inpurValue'] : '';
        $selectValue = !empty($_POST['selectValue']) ? $_POST['selectValue'] : '';

        // echo $inputValue;
        // echo $selectValue;
        $condicion = $empleado->listarEmpleadosLike($selectValue,$inputValue);

        if($condicion){
            foreach ($condicion as $dato) {
                echo "
                <tr>
                <td>
                    <img style='width:70px;height:70px;object-fit:contain' src='../../images/images-users/".$dato->foto."' alt=''>
                </td>
                <td>".$dato->nombre ." " . $dato->apellido."</td>
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
                            <li class='dropdown-item'><a href='' class='btn btn-sm btn-danger w-100 shadow-none'><i class='fa-solid fa-trash-can'></i>&nbsp;&nbsp;Eliminar</a></li>                                    
                        </ul>
                    </div>
                    
                </td>
            </tr>";
            }
        }
        // $condicion = $empleados->listarEmpleadosLike($selectValue, $inputValue);

        // if($condicion){
        //     print_r($condicion);
        // }
    }

    // ELIMINAR EMPLEADO
    if(isset($_POST['eliminar-empleado'])){
        $idEliminar = !empty($_POST['idEmpleadoEliminar']) ? trim($_POST['idEmpleadoEliminar']): '';

        if($idEliminar){
            $empleado->eliminarEmpleado($idEliminar);
            echo "success";
        }
    }

    // CERRAR SESSION
    if(isset($_POST['cerrarSesion'])){
        unset($_SESSION['empleado']);
        echo "success";
    }



    // PUBLICAR PRODUCTO
    if(isset($_POST['publicar-producto'])){
        $condicion = $_POST['publicar-producto'];

        $id = !empty($_POST['idModalBuscarProducto']) ? trim($_POST['idModalBuscarProducto']) : '';
        if($condicion == "abrir-modal"){
           

            if($id){
                echo json_encode($productos->listarProductosEnRevisionPorID($id));
            } 
        }
       
        if($condicion == "btn-publicar-producto"){
            if($id){
               $num_rows = $productos->publicarProducto($id); 

                if($num_rows>0){
                    echo "success";
                }
            }
        }
    }



    // ELIMINAR USUARIO
    if(isset($_GET["idEliminar"])){
        $usuario = new usuarios();

        $condicion = $usuario->buscarUsurioPorID($_GET["idEliminar"]);

        if($condicion){
            $encontrar_foto = "../../images/images-users/".$condicion->foto;
            
            if($encontrar_foto){
                unlink($encontrar_foto);
                echo "foto eliminada";
            }

            $eliminar = $usuario->eliminarUsuario($_GET["idEliminar"]);
            if($condicion){
                header("location: http://localhost/elitesac/admin/view/usuarios.php");
            }
        }
    }
?>