<?php
    // require '../../../bd/conexion.php';

    
    class Mesas extends Conexion{
        public function ListarMesas(){
            $mesas = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 13 and estatus = 'publicado' order by precioDescuento asc");

	        $mesas = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $mesas;
        }

        public function ListarPrecioMasbajo(){
            $mesas = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 13 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $mesas = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $mesas;
        }

        public function ListarPrecioMasAlto(){
            $mesas = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 13 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $mesas = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $mesas;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $mesas = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 13 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $mesas = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $mesas;
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