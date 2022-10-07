<?php
    // require '../../../bd/conexion.php';

    
    class Jeans extends Conexion{
        public function ListarJeans(){
            $jeans = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 15 and estatus = 'publicado' order by precioDescuento asc");

	        $jeans = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $jeans;
        }

        public function ListarPrecioMasbajo(){
            $jeans = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 15 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $jeans = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $jeans;
        }

        public function ListarPrecioMasAlto(){
            $jeans = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 15 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $jeans = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $jeans;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $jeans = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 15 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $jeans = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $jeans;
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