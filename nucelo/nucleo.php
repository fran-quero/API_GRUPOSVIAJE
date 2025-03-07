<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

header("Content-Type: application/json");

require "../conexion.php";

$metodo = $_SERVER["REQUEST_METHOD"];
$entrada = file_get_contents("php://input");

var_dump($entrada);

$entrada = json_decode($entrada, true);

switch ($metodo) {

    case "GET":

        controlGet($_conexion);

        break;

    case "POST":

        controlPost($_conexion, $entrada);

        break;

    case "DELETE":

        controlDelete($_conexion, $entrada);

        break;

    case "PUT":

        controlPut($_conexion, $entrada);

        break;

    default:

        echo json_encode(["metodo" => "otro"]);

        break;
}

function controlGet($_conexion)
{
    if (isset($_GET["ID"]) && $_GET["ID"] != "") {

        $consulta = "SELECT * FROM plans WHERE id = :i";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute(["i" => $_GET["ID"]]);
    } else {
        $consulta = "SELECT city FROM plans";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute();
    }

    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($res);
}

function controlPost($_conexion, $entrada)
{

    if (isset($entrada["id"]) && isset($entrada["city"]) && isset($entrada["plan"])) {

        $consulta = "INSERT INTO plans (id, city, plan);
        VALUES (:i, :c, :p)";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute([
            "i" => $entrada["id"],
            "c" => $entrada["city"],
            "p" => $entrada["plan"]

        ]);

        if ($stmt) {

            echo json_encode(["mensaje" => "Se ha insertado correctamente la fila"]);
        } else {

            echo json_encode(["mensaje" => "Liada criminal"]);
        }
    }
}

function controlPut($_conexion, $entrada)
{

    if (isset($entrada["id"]) && $entrada["id"] != "") {
        $resFinal = [
            "city",
            "plan"
        ];

        $consulta2 = "SELECT * FROM plans WHERE id = :i";
        $stmt = $_conexion->prepare($consulta2);
        $stmt->execute([
            "i" => $entrada["id"]
        ]);
        $res = $stmt->fetch();
        ($entrada["city"] == "") ? $resFinal["city"] = $res["city"] : $resFinal["city"] = $entrada["city"];
        ($entrada["plan"] == "") ? $resFinal["plan"] = $res["plan"] : $resFinal["plan"] = $entrada["plan"];
        

        $consulta = "UPDATE plans SET id = :i, city = :c, plan = :p WHERE id = :i";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute([
            "i" => $entrada["ID"],
            "c" => $resFinal["city"],
            "p" => $resFinal["plan"]
        ]);

        if ($stmt) {

            echo json_encode(["Mensaje" => "Se ha actualizado correctamente la fila"]);
        } else {

            echo json_encode(["Mensaje" => "Liada criminal"]);
        }
    } else {

        echo json_encode(["Mensaje" => "Debes introducir el titulo y el nombre de la desarrolladora para actualizar la tabla"]);
    }
}

function controlDelete($_conexion, $entrada)
{

    if ($entrada["id"] != "") {

        if ($entrada["id"] == "ADMIN") {

            $consulta = "DELETE FROM plans";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute();

            if ($stmt) {

                echo json_encode(["mensaje" => "La tabla se ha borrado correctamente"]);
            } else {

                echo json_encode(["mensaje" => "Error a la hora de eliminar la tabla " . $entrada["titulo_borrar"]]);
            }
        } else {

            $consulta = "DELETE FROM plans WHERE id = :i";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([
                "i" => $entrada["id"]
            ]);

            if ($stmt) {

                echo json_encode(["mensaje" => "La desarrolladora se ha borrado correctamente"]);
            } else {

                echo json_encode(["mensaje" => "Error a la hora de eliminar la desarrolladora " . $entrada["titulo_borrar"]]);
            }
        }
    } else {

        echo json_encode(["mensaje" => "No has introducido nada en el campo"]);
    }
}
