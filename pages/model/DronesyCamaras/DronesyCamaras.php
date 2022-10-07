<?php
    // require '../../../bd/conexion.php';

    
    class DronesyCamaras extends Conexion{
        public function ListarDronesyCamaras(){
            $dronesycamaras = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 6 and estatus = 'publicado' order by precioDescuento asc;");

	        $dronesycamaras = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $dronesycamaras;
        }

        public function ListarPrecioMasbajo(){
            $dronesycamaras = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 6 and estatus = 'publicado' order by precioDescuento asc limit 1");

	        $dronesycamaras = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $dronesycamaras;
        }

        public function ListarPrecioMasAlto(){
            $dronesycamaras = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 6 and estatus = 'publicado' order by precioDescuento desc limit 1;");

	        $dronesycamaras = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $dronesycamaras;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $dronesycamaras = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 6 and estatus = 'publicado' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $dronesycamaras = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $dronesycamaras;
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