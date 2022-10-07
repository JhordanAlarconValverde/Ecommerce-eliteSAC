<?php
    class empleados extends Conexion{
        public function listarEmpleados(){
            $empleados = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbe.*, case tbt.turno 
            when 'M' then 'Mañana'
            when 'T' then 'Tarde'
            when 'N' then 'Noche'
            when 'D' then 'Diario'
            end 'turno' from empleado tbe inner join turno tbt on(tbe.idTurno=tbt.id) order by tbe.nombre asc");

            if($consulta->execute()){
                $empleados = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $empleados;
        }
        
        public function listarEmpleadosLimit($limit1, $limit2){
            $empleados = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select tbe.*, case tbt.turno 
            when 'M' then 'Mañana'
            when 'T' then 'Tarde'
            when 'N' then 'Noche'
            when 'D' then 'Diario'
            end 'turno' from empleado tbe inner join turno tbt on(tbe.idTurno=tbt.id) order by tbe.nombre asc limit :valor1, :valor2");

            $consulta->bindParam(":valor1", $limit1, PDO::PARAM_INT);
            $consulta->bindParam(":valor2", $limit2, PDO::PARAM_INT);

            if($consulta->execute()){
                $empleados = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $empleados;
        }

        public function insertarEmpleado(m_empleados $m_empleado){
            try {
                $conexion = $this->Conectar();

                $consulta = $conexion->prepare("insert into Empleado(idTurno, nombre, apellido, telefono, correo, clave, usuario, foto, rol) values(:idTurno, :nombre, :apellido, :telefono, :correo, :clave, :usuario, :foto, :rol)");
                $consulta->bindParam(":idTurno", $m_empleado->idTurno, PDO::PARAM_INT);
                $consulta->bindParam(":nombre", $m_empleado->nombre, PDO::PARAM_STR, 90);
                $consulta->bindParam(":apellido", $m_empleado->apellido, PDO::PARAM_STR, 90);
                $consulta->bindParam(":telefono", $m_empleado->telefono, PDO::PARAM_STR, 90);
                $consulta->bindParam(":correo", $m_empleado->correo, PDO::PARAM_STR, 90);
                $consulta->bindParam(":clave", $m_empleado->clave, PDO::PARAM_STR, 45);
                $consulta->bindParam(":usuario", $m_empleado->usuario, PDO::PARAM_STR, 45);
                $consulta->bindParam(":foto", $m_empleado->foto, PDO::PARAM_STR);
                $consulta->bindParam(":rol", $m_empleado->rol, PDO::PARAM_STR, 45);

                $consulta->execute();

                $conexion = null;
                
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public function actualizarEmpleado(m_empleados $m_empleado){
            try {
                $conexion = $this->Conectar();

                $consulta = $conexion->prepare("up Empleado(idTurno, nombre, apellido, telefono, correo, clave, usuario, foto, rol) values(:idTurno, :nombre, :apellido, :telefono, :correo, :clave, :usuario, :foto, :rol)");
                $consulta->bindParam(":idTurno", $m_empleado->idTurno, PDO::PARAM_INT);
                $consulta->bindParam(":nombre", $m_empleado->nombre, PDO::PARAM_STR, 90);
                $consulta->bindParam(":apellido", $m_empleado->apellido, PDO::PARAM_STR, 90);
                $consulta->bindParam(":telefono", $m_empleado->telefono, PDO::PARAM_STR, 90);
                $consulta->bindParam(":correo", $m_empleado->correo, PDO::PARAM_STR, 90);
                $consulta->bindParam(":clave", $m_empleado->clave, PDO::PARAM_STR, 45);
                $consulta->bindParam(":usuario", $m_empleado->usuario, PDO::PARAM_STR, 45);
                $consulta->bindParam(":foto", $m_empleado->foto, PDO::PARAM_STR);
                $consulta->bindParam(":rol", $m_empleado->rol, PDO::PARAM_STR, 45);

                $consulta->execute();

                $conexion = null;
                
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public function eliminarEmpleado($id){
            try {
                $conexion = $this->Conectar();

                $consulta = $conexion->prepare("delete from empleado where id = :id");
                $consulta->bindParam(":id", $id, PDO::PARAM_INT);

                $consulta->execute();

                $conexion = null;
                
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public function listarTurnos(){
            $turnos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select id, case turno
            when 'M' then 'Mañana'
            when 'T' then 'Tarde'
            when 'N' then 'Noche'
            when 'D' then 'Diario' end turno from turno;");
            if($consulta->execute()){
                $turnos = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $turnos;
        }

        public function listarEmpleadosLike($selectValue, $inputValue){
            $empleados = null;

            $conexion = $this->Conectar();

            switch ($selectValue) {
                case 'nombre':
                    $consulta = $conexion->prepare("select tbe.*, case tbt.turno 
                    when 'M' then 'Mañana'
                    when 'T' then 'Tarde'
                    when 'N' then 'Noche'
                    when 'D' then 'Diario'
                    end 'turno' from empleado tbe 
                    inner join turno tbt 
                    on(tbe.idTurno=tbt.id) where tbe.nombre like '%' :inputValue '%' order by tbe.nombre asc");
                    break;
                case 'apellido':
                    $consulta = $conexion->prepare("select tbe.*, case tbt.turno 
                    when 'M' then 'Mañana'
                    when 'T' then 'Tarde'
                    when 'N' then 'Noche'
                    when 'D' then 'Diario'
                    end 'turno' from empleado tbe 
                    inner join turno tbt 
                    on(tbe.idTurno=tbt.id) where tbe.nombre like '%' :inputValue '%' order by tbe.apellido asc");
                    break;
                case 'correo':
                    $consulta = $conexion->prepare("select tbe.*, case tbt.turno 
                    when 'M' then 'Mañana'
                    when 'T' then 'Tarde'
                    when 'N' then 'Noche'
                    when 'D' then 'Diario'
                    end 'turno' from empleado tbe 
                    inner join turno tbt 
                    on(tbe.idTurno=tbt.id) where tbe.nombre like '%' :inputValue '%' order by tbe.correo asc");
                    break;
                case 'usuario':
                    $consulta = $conexion->prepare("select tbe.*, case tbt.turno 
                    when 'M' then 'Mañana'
                    when 'T' then 'Tarde'
                    when 'N' then 'Noche'
                    when 'D' then 'Diario'
                    end 'turno' from empleado tbe 
                    inner join turno tbt 
                    on(tbe.idTurno=tbt.id) where tbe.nombre like '%' :inputValue '%' order by tbe.usuario asc");
                    break;
                case 'rol':
                    $consulta = $conexion->prepare("select tbe.*, case tbt.turno 
                    when 'M' then 'Mañana'
                    when 'T' then 'Tarde'
                    when 'N' then 'Noche'
                    when 'D' then 'Diario'
                    end 'turno' from empleado tbe 
                    inner join turno tbt 
                    on(tbe.idTurno=tbt.id) where tbe.rol  like '%' :inputValue '%' order by tbe.rol asc");
                    break;
                case 'turno':
                    $consulta = $conexion->prepare("select tbe.*, case tbt.turno 
                    when 'M' then 'Mañana'
                    when 'T' then 'Tarde'
                    when 'N' then 'Noche'
                    when 'D' then 'Diario'
                    end 'turno' from empleado tbe 
                    inner join turno tbt 
                    on(tbe.idTurno=tbt.id) where tbt.turno like '%' :inputValue '%' order by tbt.turno asc");
                    break;
                default:
                    
                    break;
            }

            $consulta->bindParam(":inputValue", $inputValue);
            
            if($consulta->execute()){
                $empleados = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $empleados;
        }

        public function listarIncidencias(){
            $incidencias = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("select 
            tbi.id 'idIncidencia' , tbi.idEmpleado 'idEmpleado' ,tbi.idCompra 'idCompra' ,tbi.descripcion 'reclamo' ,tbi.imagen 'imagen' ,tbi.fecha 'fechaReclamo' ,tbi.hora 'horaReclamo',
            tbc.idMetodoPago ,tbc.total ,tbc.fechaDePago ,tbc.fechaDeEntrega,
            tbu.nombre 'nombreUsuario' ,tbu.apellido 'apellidoUsuario' , tbu.correo 'correoUsuario'
            from incidencia tbi 
            inner join empleado tbe 
            on(tbi.idempleado=tbe.id) 
            inner join Compra tbc 
            on(tbi.idCompra=tbc.id) 
            inner join usuario tbu 
            on(tbc.idUsuario=tbu.id);");
            if($consulta->execute()){
                $incidencias = $consulta->fetchAll(PDO::FETCH_OBJ);
            }

            $conexion = null;

            return $incidencias;
        }
    }


?>