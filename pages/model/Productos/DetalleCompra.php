
<?php
    // require '../../../bd/conexion.php';
    class DetalleCompra extends Conexion{
        public function insertarDetalleCarrito(M_DetalleCompra $detalleCompra){

            $consulta = $this->Conectar()->prepare("insert into DetalleCompra(idCompra,idProducto,precioProducto,cantidad,descuento,subtotal) values(:idCompra,:idProducto,:precioProducto,:cantidad,:descuento,:subtotal)");
            $consulta->bindParam(":idCompra", $detalleCompra->idCompra , PDO::PARAM_INT);
            $consulta->bindParam(":idProducto", $detalleCompra->idProducto , PDO::PARAM_INT);
            $consulta->bindParam(":precioProducto", $detalleCompra->precioProducto , PDO::PARAM_INT);
            $consulta->bindParam(":cantidad", $detalleCompra->cantidad , PDO::PARAM_INT);
            $consulta->bindParam(":descuento", $detalleCompra->descuento , PDO::PARAM_INT);
            $consulta->bindParam(":subtotal", $detalleCompra->subtotal , PDO::PARAM_INT);

            $n_rows = 0;

            if($consulta->execute()){
                $n_rows = 1;
            }

            $conexion = null;
            return $n_rows;
        }

        public function listarDetalleCompra($idUsuario){
            $compras = null;

            $conexion = $this->conectar();

            $consulta = $conexion->prepare("select tbc.id 'idCompra',
            tbc.idUsuario 'idUsuario',
            tbp.imagen 'imagen', 
            tbdc.idProducto 'idProducto', 
            tbp.nombre 'producto', 
            tbdc.precioProducto 'precioProducto', 
            tbdc.descuento 'descuento', 
            tbdc.cantidad 'cantidad', 
            tbdc.subtotal 'subtotal', 
            tbc.total 'total', 
            tbmp.nombre 'MetodoPago', 
            tbc.fechaDePago 'fechaDePago', 
            tbc.fechaDeEntrega 'fechaDeEntrega'
            from detalleCompra tbdc 
            inner join compra tbc on(tbdc.idCompra = tbc.id) 
            inner join metodoPago tbmp on(tbc.idMetodoPago = tbmp.id) 
            inner join producto tbp on(tbdc.idProducto = tbp.id) where tbc.idUsuario = :idUsuario");

            $consulta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

            if($consulta->execute()){
                $compras = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;
            
            return $compras;
        }
    }
?>