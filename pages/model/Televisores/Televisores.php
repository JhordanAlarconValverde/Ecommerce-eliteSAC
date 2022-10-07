<?php
    // require '../../../bd/conexion.php';

    
    class Televisores extends Conexion{
        public function ListarTelevisores(){
            $televisores = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 10 and estatus = 'publicado' order by precioDescuento asc");

	        $televisores = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $televisores;
        }

        public function ListarPrecioMasbajo(){
            $televisores = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 10 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $televisores = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $televisores;
        }

        public function ListarPrecioMasAlto(){
            $televisores = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 10 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $televisores = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $televisores;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $televisores = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 10 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $televisores = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $televisores;
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