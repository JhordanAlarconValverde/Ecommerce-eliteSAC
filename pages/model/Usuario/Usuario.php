<?php
    class Usuario extends Conexion{
        public function ListarUsuarios(){
            $roperos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from usuario");

	        $roperos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $roperos;
        }

        public function ListarUsuarioPorID($id){
            $usuario = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select * from usuario where id = :id");
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);

            if($consulta->execute()){
                $usuario = $consulta->fetch(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $usuario;
        }

        public function ListarUsuarioPorUsuario($user){
            $usuario = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from usuario where usuario = '{$user}';");

            $usuario = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $usuario;
        }


        public function LoguearUsuario($user, $clave){
            $usuario = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select * from usuario where usuario = :usuario and clave = :clave");

            $consulta->bindParam(":usuario", $user, PDO::PARAM_STR, 45);
            $consulta->bindParam(":clave", $clave, PDO::PARAM_STR, 45);

            $consulta->execute();

            $usuario = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $usuario;
        }

        public function InsertarUsuario(M_Usuario $m_usuario){
            try{
                $conexion = $this->Conectar();

                $consulta = $conexion->prepare("call sp_InsertarUsuario
                (:idDistrito, :nombre, :apellido, :telefono, :direccion, :referencia, :correo, :clave, :usuario, :foto);");

                $consulta->bindParam(":idDistrito", $m_usuario->idDistrito, PDO::PARAM_STR, 20);
                $consulta->bindParam(":nombre", $m_usuario->nombre, PDO::PARAM_STR, 90);
                $consulta->bindParam(":apellido", $m_usuario->apellido, PDO::PARAM_STR, 90);
                $consulta->bindParam(":telefono", $m_usuario->telefono, PDO::PARAM_STR, 20);
                $consulta->bindParam(":direccion", $m_usuario->direccion, PDO::PARAM_STR, 90);
                $consulta->bindParam(":referencia", $m_usuario->referencia, PDO::PARAM_STR, 90);
                $consulta->bindParam(":correo", $m_usuario->correo, PDO::PARAM_STR, 90);
                $consulta->bindParam(":clave", $m_usuario->clave, PDO::PARAM_STR, 45);
                $consulta->bindParam(":usuario", $m_usuario->usuario, PDO::PARAM_STR, 45);
                $consulta->bindParam(":foto", $m_usuario->foto, PDO::PARAM_STR);

                $consulta->execute();

                $conexion = null;

            }catch(PDOException $e){
                die($e->getMessage());
            }
        }

        public function ActualizarUsuario(M_Usuario $m_usuario){
            $row;
            try{
                $conexion = $this->Conectar();

                $consulta = $conexion->prepare("call sp_ActualizarUsuario
                (:id, :nombre, :apellido, :telefono, :direccion, :referencia, :correo, :clave, :usuario, :idDistrito, :foto);");

                $consulta->bindParam(":id", $m_usuario->id, PDO::PARAM_INT);                
                $consulta->bindParam(":nombre", $m_usuario->nombre, PDO::PARAM_STR, 90);
                $consulta->bindParam(":apellido", $m_usuario->apellido, PDO::PARAM_STR, 90);
                $consulta->bindParam(":telefono", $m_usuario->telefono, PDO::PARAM_STR, 20);
                $consulta->bindParam(":direccion", $m_usuario->direccion, PDO::PARAM_STR, 90);
                $consulta->bindParam(":referencia", $m_usuario->referencia, PDO::PARAM_STR, 90);
                $consulta->bindParam(":correo", $m_usuario->correo, PDO::PARAM_STR, 90);
                $consulta->bindParam(":clave", $m_usuario->clave, PDO::PARAM_STR, 45);
                $consulta->bindParam(":usuario", $m_usuario->usuario, PDO::PARAM_STR, 45);                
                $consulta->bindParam(":idDistrito", $m_usuario->idDistrito, PDO::PARAM_STR, 20);
                $consulta->bindParam(":foto", $m_usuario->foto, PDO::PARAM_STR);

                if($consulta->execute()){
                    $row = 1;
                }else{
                    $row = 0;
                }
                
                $conexion = null;
                

            }catch(PDOException $e){
                $row = 0;
                die($e->getMessage());
            }
            return $row;
        }

        public function ListarPublicacionPorIDUsuario($id){
            $productos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbp.id, tbp.imagen, tbp.nombre, tbp.descripcion, tbp.cantidad, 
            case tbp.estado
            when 'R' then 'Reparado'
            when 'S' then 'Segunda mano'
            end 'estado', tbp.precio, tbp.precioDescuento, tbc.nombre 'categoria', tbp.estatus from producto tbp inner join categoria tbc 
            on(tbp.idCategoria=tbc.id) where idUsuario=:id and estatus != 'revision' order by estado");

            $consulta->bindParam(':id', $id, PDO::PARAM_INT);

            if($consulta->execute()){
                $productos = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $productos;
        }

        public function ListarProductosEnRevision($id){
            $productos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("
            select tbp.id, tbp.imagen, tbp.nombre, tbp.descripcion, tbp.cantidad, 
            case tbp.estado
            when 'R' then 'Reparado'
            when 'S' then 'Segunda mano'
            end 'estado', tbp.precio, tbp.precioDescuento, tbc.nombre 'categoria', tbp.estatus from producto tbp inner join categoria tbc 
            on(tbp.idCategoria=tbc.id) where idUsuario={$id} and estatus = 'revision';");

            $productos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $productos;
        }
        	
        // UBIGEO
        public function ListarDepartamentos(){
            $departamentos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from departamento;");

	        $departamentos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $departamentos;
        }

        public function ListarProvinciaByDepartamento($cod){
            $pronvincias = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select * from provincia where idDepartamento = :cod;");

            $consulta->bindParam(":cod", $cod, PDO::PARAM_STR, 20);

            $consulta->execute();

	        $pronvincias = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $pronvincias;
        }

        public function ListarDistritoByProvincia($cod){
            $distritos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select * from distrito where idProvincia = :cod;");

            $consulta->bindParam(":cod", $cod, PDO::PARAM_STR, 20);

            $consulta->execute();

	        $distritos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $distritos;
        }
    }

    // $obj = new Televisores();
    // $obj->ListarTelevisores();
    // $televisores = $obj->ListarTelevisores();
    // echo "<pre>";
    // print_r($televisores);
    // foreach ($televisores as $data) {
    //     # code...
    // }

        // $obj = new Conexion();
        // $conexion = new PDO("mysql:host=localhost:3307;dbname=bd_elite;", "root", "");


        // $consulta = $conexion->query("select * from producto");
	    // $empleado = $consulta->fetchAll(PDO::FETCH_OBJ);
        // print_r($empleado);

?>