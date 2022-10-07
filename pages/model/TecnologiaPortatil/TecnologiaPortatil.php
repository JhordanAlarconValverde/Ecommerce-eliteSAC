<?php
    // require '../../../bd/conexion.php';

    
    class TecnologiaPortatil extends Conexion{
        public function ListarTecnologiaPortatil(){
            $tecnologiaPortatil = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 11 and estatus != 'revision' order by precioDescuento asc");

	        $tecnologiaPortatil = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $tecnologiaPortatil;
        }

        public function ListarPrecioMasbajo(){
            $tecnologiaPortatil = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 11 and estatus != 'revision' order by precioDescuento asc limit 1");

	        $tecnologiaPortatil = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $tecnologiaPortatil;
        }

        public function ListarPrecioMasAlto(){
            $tecnologiaPortatil = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 11 and estatus != 'revision' order by precioDescuento desc limit 1;");

	        $tecnologiaPortatil = $consulta->fetch(PDO::FETCH_OBJ);

            $conexion = null;

            return $tecnologiaPortatil;
        }

        public function ListarPrecioBetween($valor1, $valor2){
            $tecnologiaPortatil = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->query("select * from producto where idCategoria = 11 and estatus != 'revision' and precioDescuento between {$valor1} and {$valor2} order by precioDescuento asc");

	        $tecnologiaPortatil = $consulta->fetchAll(PDO::FETCH_OBJ);

            $conexion = null;

            return $tecnologiaPortatil;
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