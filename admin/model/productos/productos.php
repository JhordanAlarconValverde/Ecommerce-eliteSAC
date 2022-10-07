<?php
    class productos extends Conexion{
        public function listarProductos(){
            $produtos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbp.id, tbp.imagen, tbp.nombre 'producto', tbp.descripcion, tbp.cantidad, 
            case tbp.estado
                when 'R' then 'Reparado'
                when 'S' then 'Segunda mano'
            end 'estado'
            , tbp.precio, tbp.precioDescuento,
            tbc.nombre 'categoria', tbu.usuario 'usuario' from producto tbp inner join categoria tbc 
            on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario = tbu.id) order by tbc.nombre asc");

            if($consulta->execute()){
                $produtos = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $produtos;
        }

        public function listarProductosLimit($limit1, $limit2){
            $produtos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbp.id, tbp.imagen, tbp.nombre 'producto', tbp.descripcion, tbp.cantidad, 
            case tbp.estado
                when 'R' then 'Reparado'
                when 'S' then 'Segunda mano'
            end 'estado'
            , tbp.precio, tbp.precioDescuento,
            tbc.nombre 'categoria', tbu.usuario 'usuario' from producto tbp inner join categoria tbc 
            on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario = tbu.id) where tbp.cantidad > 0 order by tbc.nombre asc limit :valor1, :valor2");

            $consulta->bindParam(":valor1", $limit1, PDO::PARAM_INT);
            $consulta->bindParam(":valor2", $limit2, PDO::PARAM_INT);

            if($consulta->execute()){
                $produtos = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $produtos;
        }

        public function listarProductosPublicados(){
            $produtos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbp.id, tbp.imagen, tbp.nombre 'producto', tbp.descripcion, tbp.cantidad, 
            case tbp.estado
                when 'R' then 'Reparado'
                when 'S' then 'Segunda mano'
            end 'estado'
            , tbp.precio, tbp.precioDescuento,
            tbc.nombre 'categoria', tbu.usuario 'usuario', tbp.estatus from producto tbp inner join categoria tbc 
            on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario = tbu.id) where tbp.estatus = 'publicado' order by tbc.nombre asc");

            if($consulta->execute()){
                $produtos = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $produtos;
        }

        public function listarProductosEnRevision(){
            $produtos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbp.id, tbp.imagen, tbp.nombre 'producto', tbp.descripcion, tbp.cantidad, 
            case tbp.estado
                when 'R' then 'Reparado'
                when 'S' then 'Segunda mano'
            end 'estado'
            , tbp.precio, tbp.precioDescuento,
            tbc.nombre 'categoria', tbu.usuario 'usuario', tbp.estatus from producto tbp inner join categoria tbc 
            on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario = tbu.id) where tbp.estatus = 'revision' order by tbc.nombre asc");

            if($consulta->execute()){
                $produtos = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $produtos;
        }

        public function listarProductosEnRevisionPorID($id){
            $produtos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbp.*, tbc.nombre 'categoria', tbu.nombre 'nombreUsuario', tbu.apellido 'apellidoUsuario', tbu.telefono 'telefonoUsuario', tbu.correo 'correoUsuario', tbu.usuario 'userUsuario', tbu.foto 'fotoUsuario'
            from producto tbp inner join categoria tbc on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario=tbu.id) where tbp.id = :id");

            $consulta->bindParam(":id", $id, PDO::PARAM_INT);

            if($consulta->execute()){
                $produtos = $consulta->fetch(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $produtos;
        }

        public function publicarProducto($id){
            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("update producto set estatus = 'publicado' where id = :id");

            $consulta->bindParam(":id", $id, PDO::PARAM_INT);

            $num_rows = 0;
            if($consulta->execute()){
                $num_rows = 1;
                // $produtos = $consulta->fetch(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $num_rows;
        }


        public function listarProductosSinStock(){
            $produtos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbp.id, tbp.imagen, tbp.nombre 'producto', tbp.descripcion, tbp.cantidad, 
            case tbp.estado
                when 'R' then 'Reparado'
                when 'S' then 'Segunda mano'
            end 'estado'
            , tbp.precio, tbp.precioDescuento,
            tbc.nombre 'categoria', tbu.usuario 'usuario' from producto tbp inner join categoria tbc 
            on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario = tbu.id) where tbp.cantidad = 0 order by tbc.nombre asc");

            if($consulta->execute()){
                $produtos = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $produtos;
        }

        public function listarProductosSinStockLimit($limit1, $limit2){
            $produtos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbp.id, tbp.imagen, tbp.nombre 'producto', tbp.descripcion, tbp.cantidad, 
            case tbp.estado
                when 'R' then 'Reparado'
                when 'S' then 'Segunda mano'
            end 'estado'
            , tbp.precio, tbp.precioDescuento,
            tbc.nombre 'categoria', tbu.usuario 'usuario' from producto tbp inner join categoria tbc 
            on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario = tbu.id) where tbp.cantidad = 0 order by tbc.nombre asc limit :valor1, :valor2");

            $consulta->bindParam(":valor1", $limit1, PDO::PARAM_INT);
            $consulta->bindParam(":valor2", $limit2, PDO::PARAM_INT);

            if($consulta->execute()){
                $produtos = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $produtos;
        }
        
    }


?>