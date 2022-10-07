<?php
    // require '../../../bd/conexion.php';

    
    class Computadoras extends Conexion{
        public function ListarComputadoras(){
            $computadoras = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 4 and estatus = 'publicado' order by precioDescuento asc;");

	        $computadoras = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $computadoras;
        }

        public function ListarPrecioMasbajo(){
            $computadoras = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 4 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $computadoras = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $computadoras;
        }

        public function ListarPrecioMasAlto(){
            $computadoras = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 4 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $computadoras = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $computadoras;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $computadoras = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 4 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $computadoras = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $computadoras;
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