<?php

    error_reporting(E_ALL);
    ini_set("display_errors",1);


    header("Content-Type: application/json"); //se usa para enviar una cabecera HTTP 
                                            // a palo seco, normalmente lo hemos usado para redirigir
                                            // pero tambien se puede usar para indicar el tipo de contenido
                                            // de la respuesta
    require "../conexion_pdo.php";
    
    $metodo = $_SERVER["REQUEST_METHOD"]; //Guardar el metodo del cliente en la variable
    $entrada = file_get_contents("php://input"); //lee el cuerpo de las solicitudes enviadas

    var_dump($entrada); //para ver que obtenemos

    $entrada = json_decode($entrada, true); //convierte el JSON en un array asociativo

    var_dump($entrada);

    
    switch($metodo){

        case "GET":
            controlGet($_conexion);
            break;

        default:
            echo json_encode(["metodo" => "otro"]);
            break;

    }


    //Empezamos con las funciones!!! :D
    function controlGet($_conexion){

        //$ciudad = $_GET["ciudad"]??"";

        if(isset($_GET["ciudad"])  and $_GET["ciudad"]!=""){

            $consulta = "SELECT * FROM desarrolladoras WHERE ciudad = :c";
            $stmt = $_conexion -> prepare($consulta);
            $stmt -> execute(["c"=>$_GET["ciudad"]]);

        }
        else{

            $consulta = "SELECT * FROM desarrolladoras";
            $stmt = $_conexion->prepare($consulta);
            $stmt -> execute();

        }

        $res = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        /***
         * Devuevle todos los registros como un array ASOCIATIVO
         * [
         *  ["nombre_desarrolladora"=>"nombre1", ...],
         *  ["nombre_desarrolladora"=>"nombre2", ...],
         *  ["nombre_desarrolladora"=>"nombre3", ...]
         * ]
         */

         echo json_encode($res);
         //Lo contrario que el json_decode(), los valores del array asociativo, los transforma
         //en JSON y los envía
    }



?>