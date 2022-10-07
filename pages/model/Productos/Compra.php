
<?php
    // require '../../../bd/conexion.php';
    class Compra extends Conexion{
        public function insertarCompra(M_Compra $compra){
            $conexion = $this->Conectar();
            $consulta = $conexion->prepare("insert into Compra(idUsuario,idMetodoPago,total,fechaDePago,fechaDeEntrega) values(:idUsuario,:idMetodoPago,:total,:fechaDePago,:fechaDeEntrega)");
            $consulta->bindParam(":idUsuario", $compra->idUsuario , PDO::PARAM_INT);
            $consulta->bindParam(":idMetodoPago", $compra->idMetodoPago , PDO::PARAM_INT);
            $consulta->bindParam(":total", $compra->total , PDO::PARAM_INT);
            $consulta->bindParam(":fechaDePago", $compra->fechaDePago , PDO::PARAM_STR);
            $consulta->bindParam(":fechaDeEntrega", $compra->fechaDeEntrega , PDO::PARAM_STR);
            // $consulta->execute();
            $id = 0;

            if($consulta->execute()){
                $id = $conexion->lastInsertId();
            }

            $conexion = null;
            return $id;
        }
    }
?>