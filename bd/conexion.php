<?php
    class Conexion{
        private $host = "localhost:3307";
        private $user = "root";
        private $DB = "bd_elite";
        private $psw = "";

        public function Conectar(){
            $conexion = null;
            try{
                $conexion = new PDO("mysql:host=$this->host;dbname=$this->DB;", $this->user, $this->psw);
            }catch(PDOException $e){
                $conexion = $e->getMessage();
            }
            return $conexion;
        }
    }
?>