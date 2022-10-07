<?php
    // require '../../../bd/conexion.php';

    
    class Celulares extends Conexion{
        public function ListarCelulares(){
            $celulares = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 9 and estatus = 'publicado' order by precioDescuento asc;");

	        $celulares = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $celulares;
        }

        public function ListarPrecioMasbajo(){
            $celulares = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 9 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $celulares = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $celulares;
        }

        public function ListarPrecioMasAlto(){
            $celulares = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 9 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $celulares = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $celulares;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $celulares = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 9 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $celulares = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $celulares;
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