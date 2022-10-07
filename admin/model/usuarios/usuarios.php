<?php
    class usuarios extends Conexion{
        public function listarUsuarios(){
            $usuarios = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select * from usuario order by nombre asc");

            if($consulta->execute()){
                $usuarios = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $usuarios;
        }
        
        public function listarUsuariosLimit($limit1, $limit2){
            $usuarios = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbu.*, tbd.nombre 'distrito'  
            from usuario tbu inner join distrito tbd on(tbu.idDistrito = tbd.id) order by tbu.nombre asc limit :valor1, :valor2");

            $consulta->bindParam(":valor1", $limit1, PDO::PARAM_INT);
            $consulta->bindParam(":valor2", $limit2, PDO::PARAM_INT);

            if($consulta->execute()){
                $usuarios = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $usuarios;
        }

        public function listarVentas(){
            $ventas = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbc.*, concat(tbu.nombre, ' ', tbu.apellido) 'usuario',tbp.nombre 'metodoPago', tbdc.idProducto, tbdc.precioProducto, tbdc.descuento, tbdc.cantidad, tbdc.subtotal 
            from detallecompra tbdc inner join compra tbc on(tbdc.idCompra=tbc.id) inner join usuario tbu on(tbc.idUsuario=tbu.id) inner join metodopago tbp on(tbc.idMetodoPago=tbp.id) order by fechaDePago");

            if($consulta->execute()){
                $ventas = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $ventas;
        }

        public function eliminarUsuario($id){
            $usuarios = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("delete from usuario where id = :id");

            $consulta->bindParam(":id", $id, PDO::PARAM_INT);

            if( $consulta->execute()){
                $nfilas = 1;
            }else{
                $nfilas = 0;
            }

            $conexion = null;
            return $nfilas;
        }

        public function buscarUsurioPorID($id){
            $usuarios = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select * from usuario where id = :id");

            $consulta->bindParam(":id", $id, PDO::PARAM_INT);

            if($consulta->execute()){
                $usuarios = $consulta->fetch(PDO::FETCH_OBJ);
            }
            
            $conexion = null;

            return $usuarios;
        }
    }


?>