<?php
    class Administrador extends Conexion{
        public function insertarAdministrados(M_Administrador $m_admin){
            try{
                $conexion = $this->Conectar();
                $consulta = $conexion->prepare("insert into Empleado(idTurno, nombre, apellido, telefono, correo, clave, usuario, foto, rol) values(:idTurno, :nombre, :apellido, :telefono, :correo, :clave, :usuario, :foto, :rol)");
                $consulta->bindParam(":idTurno", $m_admin->idTurno, PDO::PARAM_INT);
                $consulta->bindParam(":nombre", $m_admin->nombre, PDO::PARAM_STR, 90);
                $consulta->bindParam(":apellido", $m_admin->apellido, PDO::PARAM_STR, 90);
                $consulta->bindParam(":telefono", $m_admin->telefono, PDO::PARAM_STR, 90);
                $consulta->bindParam(":correo", $m_admin->correo, PDO::PARAM_STR, 90);
                $consulta->bindParam(":clave", $m_admin->clave, PDO::PARAM_STR, 45);
                $consulta->bindParam(":usuario", $m_admin->usuario, PDO::PARAM_STR, 90);
                $consulta->bindParam(":foto", $m_admin->foto, PDO::PARAM_STR);
                $consulta->bindParam(":rol", $m_admin->rol, PDO::PARAM_STR, 45);

                $consulta->execute();
            }catch(PDOException $e){
                die($e->getMessage());
            }

            $conexion = null;
        }

        public function loguearAdministrador($correo, $clave){
            $admin = null;
            $conexion = $this->Conectar();
            $consulta = $conexion->prepare("select * from Empleado where correo = :correo and clave = :clave");
            $consulta->bindParam(":correo", $correo, PDO::PARAM_STR, 45);
            $consulta->bindParam(":clave", $clave, PDO::PARAM_STR, 45);

            if($consulta->execute()){
                $admin = $consulta->fetch(PDO::FETCH_OBJ);
            }

            $conexion = null;
            return $admin;
        }

        // DASHBOARD

        public function admin_listarProductosMasVendidos(){
            $productos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select 
            p.id 'id',
            p.nombre 'producto',
            p.descripcion 'descripcion',
            case p.estado
            when 'R' then 'Reparado' when 'S' then 'Segunda mano' end 'estado',
            p.precio 'precio',
            p.precioDescuento 'precioDescuento',
            p.imagen 'imagen',
            sum(dc.cantidad) 'cantidadVendida' from DetalleCompra dc inner join producto p 
            on(dc.idProducto = p.id) group by p.id order by sum(dc.cantidad) desc limit 10;");

            $productos = $consulta->fetchAll(PDO::FETCH_OBJ);

            return $productos;
        }

        public function admin_listarUltimosUsuariosRegistrados(){
            $usuarios = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from usuario order by id desc limit 10;");

            $usuarios = $consulta->fetchAll(PDO::FETCH_OBJ);
            
            return $usuarios;
        }

        public function admin_usuariosRegistrados(){
            return intval($consulta = $this->Conectar()->query("select * from usuario")->rowCount());
        }

        public function admin_comprasRealizadas(){
            return intval($consulta = $this->Conectar()->query("select * from compra")->rowCount());
        }

        public function admin_productosDisponibles(){
            return intval($consulta = $this->Conectar()->query("select * from producto where estatus = 'publicado'")->rowCount());
        }

        public function admin_productosVendidos(){
            return intval($consulta = $this->Conectar()->query("select * from DetalleCompra")->rowCount());
        }

        public function admin_categoriaMasVendida(){
            $conexion = $this->Conectar();

            $consulta = $conexion->query("select tbca.nombre from DetalleCompra tbdc inner join compra tbc on(tbdc.idCompra=tbc.id) 
            inner join producto tbp on(tbdc.idProducto=tbp.id) inner join categoria tbca on
            (tbp.idCategoria=tbca.id) group by tbca.nombre order by sum(tbdc.cantidad) desc limit 1;");

            foreach ($consulta->fetch(PDO::FETCH_OBJ) as $dato) {
                return $dato;
            }
        }

        public function admin_categoriasVendidas(){
            $arreglo = null;
            $conexion = $this->Conectar();

            $consulta = $conexion->query("select sum(tbdc.cantidad) 'cantidad', tbca.nombre from DetalleCompra tbdc inner join compra tbc on(tbdc.idCompra=tbc.id) 
            inner join producto tbp on(tbdc.idProducto=tbp.id) inner join categoria tbca on
            (tbp.idCategoria=tbca.id) group by tbca.nombre order by sum(tbdc.cantidad);");

            $arreglo = $consulta->fetchAll(PDO::FETCH_OBJ);

            return $arreglo;
        }

        // public function admin_ventasPorFecha($fechaInicio,$fechaFin){
        //     $arreglo = null;

        //     $conexion = $this->Conectar();

        //     $consulta = $conexion->query("select sum(total) 'total',MONTHNAME(fechaDePago) 'formato_mes', fechaDePago from compra where fechaDePago 
        //     between '2019-01-01' and '2019-12-30' group by MONTHNAME(fechaDePago) order by fechaDePago");

        //     $arreglo = $consulta->fetchAll(PDO::FETCH_OBJ);
        //     return $arreglo;
        // }

        public function admin_ventasPorFecha($fechaAnio){
            $arreglo = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select sum(total) 'total', MONTHNAME(fechaDePago) 'mes', fechaDePago 'fecha' from compra 
            where YEAR(fechaDePago) = {$fechaAnio} group by MONTHNAME(fechaDePago) order by fechaDePago;");

            $arreglo = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $arreglo;
        }

        

        

        

        // public function admin_UsuariosRegistrados(){
        //     $conexion = $this->Conectar();

        //     $consulta = $conexion->query("select * from producto");

        //     $usuarios = $consulta->fetchAll(PDO::FETCH_OBJ);
            
        //     return $consulta->rowCount();
        // }

    } 



?>