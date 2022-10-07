<?php
    // require '../../../bd/conexion.php';

    class Roperos extends Conexion{
        public function ListarRoperos(){
            $roperos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 12 and estatus = 'publicado' order by precioDescuento asc");

	        $roperos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $roperos;
        }

        public function ListarPrecioMasbajo(){
            $roperos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 12 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $roperos = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $roperos;
        }

        public function ListarPrecioMasAlto(){
            $roperos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 12 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $roperos = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $roperos;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $roperos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 12 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $roperos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $roperos;
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