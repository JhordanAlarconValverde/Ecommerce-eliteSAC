<?php
    // require '../../../bd/conexion.php';

    
    class Audifonos extends Conexion{
        public function ListarAudifonos(){
            $audifonos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 7 and estatus = 'publicado' order by precioDescuento asc;");

	        $audifonos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $audifonos;
        }

        public function ListarPrecioMasbajo(){
            $audifonos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 7 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $audifonos = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $audifonos;
        }

        public function ListarPrecioMasAlto(){
            $audifonos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 7 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $audifonos = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $audifonos;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $audifonos = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 7 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $audifonos = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $audifonos;
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