<?php


    $_host = "localhost";
    $_bd = "flywith";
    $_usuario = "root";
    $_contrasenia = "";


    //Crear la conexion usando PDO (PHP DATA OBJECT)
    try{
        
        $_conexion = new PDO("mysql:host=$_host;dbname=$_bd;charset=utf8",$_usuario,$_contrasenia);

        
        $_conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){
        die("ERROR: No se puede conectar a la BBDD -> " . $e->getMessage());
    }



?>