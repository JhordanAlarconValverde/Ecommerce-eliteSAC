<?php
    // require '../../../bd/conexion.php';

    
    class Productos extends Conexion{
        public function Listar8Productos(){
            $productos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where estatus = 'publicado' limit 0, 8");

	        $productos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $productos;
        }
        
        public function ListarProductos(){
            $productos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where estatus = 'publicado'");

	        $productos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $productos;
        }

        public function DetalleProductobyID($cod){
            $producto = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where id = {$cod}");

	        $producto = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $producto;
        }

        public function ListarProductosEnOferta(){
            $producto = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select * from producto where estatus = 'publicado' order by precioDescuento asc limit 4;");

            $consulta->execute();

	        $producto = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $producto;
        }

        public function ListarMetodosDePago(){
            $metodos_pago = null;
    
            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from metodopago");

            $metodos_pago = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $metodos_pago;
        }

        public function ListarPrecioMasbajo(){
            $parlantes = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where estatus = 'publicado' order by precioDescuento asc limit 1");

	        $producto = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $producto;
        }

        public function ListarPrecioMasAlto(){
            $producto = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where estatus = 'publicado' order by precioDescuento desc limit 1");

	        $producto = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $producto;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $producto = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $producto = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $producto;
        }

        public function ListarProductosMasVendidos(){
            $producto = null;
    
            $conexion = $this->Conectar();
    
            $consulta = $conexion->query("select 
            p.id 'id',
            p.nombre 'producto',
            p.descripcion 'descripcion',
            p.estado 'estado',
            p.precio 'precio',
            p.precioDescuento 'precioDescuento',
            p.imagen 'imagen',
            sum(dc.cantidad) 'cantidadVendida' from DetalleCompra dc inner join producto p 
            on(dc.idProducto = p.id) group by p.id order by sum(dc.cantidad) desc limit 4;");
    
            $producto = $consulta->fetchAll(PDO::FETCH_OBJ);
    
            $conexion = null;
    
            return $producto;
        }

        public function listarCategorias(){
            $categorias = null;
    
            $conexion = $this->Conectar();
    
            $consulta = $conexion->query("select * from categoria where id != 1 and id !=2 and id != 3;");
    
            $categorias = $consulta->fetchAll(PDO::FETCH_OBJ);
    
            $conexion = null;
    
            return $categorias;
        }

        public function insertarProducto(M_Productos $m_producto){
            $num_rows = 0;
            try{
                $conexion = $this->Conectar();
                $consulta = $conexion->prepare("insert into Producto(idCategoria,idUsuario,nombre,descripcion,cantidad,estado,precio,precioDescuento,imagen,estatus) 
                values(:idCategoria,:idUsuario,:nombre,:descripcion,:cantidad,:estado,:precio,:precioDescuento,:imagen,:estatus)");

                $consulta->bindParam(":idCategoria", $m_producto->idCategoria , PDO::PARAM_INT);
                $consulta->bindParam(":idUsuario", $m_producto->idUsuario , PDO::PARAM_INT);
                $consulta->bindParam(":nombre", $m_producto->nombre , PDO::PARAM_STR);
                $consulta->bindParam(":descripcion", $m_producto->descripcion , PDO::PARAM_STR);
                $consulta->bindParam(":cantidad", $m_producto->cantidad , PDO::PARAM_INT);
                $consulta->bindParam(":estado", $m_producto->estado , PDO::PARAM_STR);
                $consulta->bindParam(":precio", $m_producto->precio , PDO::PARAM_INT);
                $consulta->bindParam(":precioDescuento", $m_producto->precioDescuento , PDO::PARAM_INT);
                $consulta->bindParam(":imagen", $m_producto->imagen , PDO::PARAM_STR);
                $consulta->bindParam(":estatus", $m_producto->estatus , PDO::PARAM_STR);

                if($consulta->execute()){
                    $num_rows = $conexion->lastInsertId();
                }

                $conexion = null;

                return $num_rows;
            }catch(PDOException $e){
                return 0;
                die($e->getMessage());
            }

            return $num_rows;
        }

        public function listarProductoPorNombre($valor, $comando){
            $producto = null;
    
            $conexion = $this->Conectar();

            if($comando == "keyup"){
                $consulta = $conexion->query("select distinct nombre, idCategoria from producto where nombre like '%{$valor}%';");
            }else{
                $consulta = $conexion->query("select * from producto where nombre like '%{$valor}%';");
            }
            
            $producto = $consulta->fetchAll(PDO::FETCH_OBJ);
    
            $conexion = null;
    
            return $producto;
        }


        public function actualizarStockProducto($idProducto, $cantidad){
            $conexion = $this->Conectar();
            $consulta = $conexion->prepare("update producto set cantidad = :cantidad where id = :id;");
            $consulta->bindParam(":cantidad", $cantidad , PDO::PARAM_INT);
            $consulta->bindParam(":id", $idProducto , PDO::PARAM_INT);
            $consulta->execute();
            $conexion = null;
        }
    }
?>