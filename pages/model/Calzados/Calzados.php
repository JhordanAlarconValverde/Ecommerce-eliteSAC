<?php
    // require '../../../bd/conexion.php';

    
    class Calzados extends Conexion{
        public function ListarCalzados(){
            $calzados = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 14 and estatus = 'publicado' order by precioDescuento asc;");

	        $calzados = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $calzados;
        }

        public function ListarPrecioMasbajo(){
            $calzados = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 14 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $calzados = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $calzados;
        }

        public function ListarPrecioMasAlto(){
            $calzados = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 14 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $calzados = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $calzados;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $calzados = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 14 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $calzados = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $calzados;
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