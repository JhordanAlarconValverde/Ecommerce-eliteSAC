<?php
    // require '../../../bd/conexion.php';

    
    class Parlantes extends Conexion{
        public function ListarParlantes(){
            $parlantes = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 8 and estatus = 'publicado' order by precioDescuento asc");

	        $parlantes = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $parlantes;
        }

        public function ListarPrecioMasbajo(){
            $parlantes = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 8 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $parlantes = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $parlantes;
        }

        public function ListarPrecioMasAlto(){
            $parlantes = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 8 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $parlantes = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $parlantes;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $parlantes = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 8 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $parlantes = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $parlantes;
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