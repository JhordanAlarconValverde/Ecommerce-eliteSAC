<?php
    // require '../../../bd/conexion.php';

    
    class Tabletas extends Conexion{
        public function ListarTabletas(){
            $tabletas = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 5 and estatus = 'publicado' order by precioDescuento asc");

	        $tabletas = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $tabletas;
        }

        public function ListarPrecioMasbajo(){
            $tabletas = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 5 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $tabletas = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $tabletas;
        }

        public function ListarPrecioMasAlto(){
            $tabletas = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 5 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $tabletas = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $tabletas;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $tabletas = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 5 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $tabletas = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $tabletas;
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