<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
    <?php

        session_start();
        error_reporting(E_ALL);
        ini_set("display_errors",1);

        if(empty($_SESSION["admin"]) && empty($_SESSION["user"]) ){
            header("location: ../sesion/login.php");
            die();
        }
        
        if(!empty($_SESSION["admin"])){
            $admin = true;
        }
        else{
            $admin=false;
        }

    ?>

   <script>

                

            function mostrarFormulario(){
                let metodoSeleccionado = document.querySelector('select[name=metodo]').value;

                let campoGet = document.getElementById("datosGet");
                let campoPostPut = document.getElementById("datosPostPut");
                let campoDelete = document.getElementById("datosDelete");
                let btn = document.getElementById("boton");
                
                campoGet.style.display = "none";
                campoPostPut.style.display = "none";
                campoDelete.style.display = "none";

                if(metodoSeleccionado=="GET"){
                    campoGet.style.display = "block";
                }
                else if(metodoSeleccionado == "POST"){
                    campoPostPut.style.display = "block"; 
                }
                else if(metodoSeleccionado == "PUT"){
                    campoPostPut.style.display = "block"; 

                }
                else if(metodoSeleccionado == "DELETE"){
                    campoDelete.style.display = "block"; 
                }

                btn.style.display = "block";

            }

        
    </script>

</head>
<body>
    
    <div class="container m-4">
        <h1>Probando nucleo api fly with</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Selecciona el método</label>
                <select name="metodo" class="form-select" onchange="mostrarFormulario()">
                    <option value="" selected disabled> ---- ELIGE UN DATO --- </option>
                    <option value="GET">GET (Recuperar datos)</option>
                    <?php if($admin): ?>
                    <option value="POST">POST (Insertar datos)</option>
                    <option value="PUT">PUT (Actualizar datos)</option>
                    <option value="DELETE">DELETE (Borrar datos)</option>
                    <?php  endif;?>
                </select>
            </div>
            <div id="datosGet" class="mb-3" style="display: none;">
                <label class="form-label">Datos para GET:</label>
                <input type="texto" name="id_plan" class="form-control" placeholder="ID del plan">
            </div>
            <div id="datosPostPut" class="mb-3" style="display: none;">
                <label class="form-label">Datos para POST (insertar plan):</label>
                <input type="texto" name="id1" class="form-control" placeholder="ID del plan">
                <input type="texto" name="city" class="form-control" placeholder="Nombre de la ciudad">
                <input type="texto" name="plan" class="form-control" placeholder="Actividades">
            </div>
            <div id="datosDelete" class="mb-3" style="display: none;">
                <label class="form-label">Datos para DELETE:</label>
                <input type="texto" name="id2" class="form-control" placeholder="ID del plan">
            </div>
            <button style="display: none;" type="submit" class="btn btn-primary" id="boton">Enviar peticion</button>
        </form>

        <a href="../sesion/logout.php">Cerrar sesion</a>

        <?php

            if($_SERVER["REQUEST_METHOD"]=="POST"){

                $metodo = $_POST["metodo"];
                $url = "http://localhost/API_GRUPOSVIAJE/nucleo_api/api_sesion.php";
                

                if($metodo=="GET"){

                    echo "<h3>Hemos lanzado un get</h3>";

                    //Miramos si nos dio la id o sino mandamos el primer registro
                    $id_plan = isset($_POST["id_plan"]) && !empty($_POST["id_plan"]) ? "?id_plan=" . urlencode($_POST["id_plan"]) : "";
                    $url .= $id_plan; 
                    echo "URL generada: " .  htmlspecialchars($url) . "<br>";
                    
                    try{

                        $res = file_get_contents($url); //Cogemos el body de la pagina
                        echo "<pre>" . htmlspecialchars($res) . "</pre>";

                    }catch (Exception $e){
                        echo "Error al realizar la solicitud: " . $e->getMessage();
                    }


                }
                elseif($metodo == "POST" || $metodo == "PUT" || $metodo == "DELETE"){

                    echo "<h3>Hemos lanzado un post, put o delete</h3>";
    
                    $datos = [];

                    if($metodo == "POST" || $metodo == "PUT"){

                        $datos = [
                            "id" => $_POST["id1"],
                            "city" => $_POST["city"],
                            "plan" => $_POST["plan"]
                        ];

                    }
                    elseif($metodo == "DELETE"){

                        $datos = [
                            "id" => $_POST["id2"]
                        ];

                    }

                    $opciones = [
                        "http"=>[
                            "header" => "Content-Type: application/json",
                            "method" => "$metodo",
                            "content" => json_encode($datos)
                        ]
                    ];
    
                    $contexto = stream_context_create($opciones); //Crear un contexto HTTP
    
                    try{
    
                        $respuesta = file_get_contents($url, false, $contexto);
                        /***
                         *  Construye una conexion HTTP usando el contexto creado por stream_context_create()
                         *  y envia la solicitud POST al server con los datos, devuelve la respuesta del server
                         *  si todo va bien o lanza un fallo en caso de que vaya mal. El false es del atributo
                         *  $use_include_path, si lo ponemos a false PHP no buscará el archivo en las rutas
                         *  especificadas en el include_path
                         */
    
    
                    }catch(Exception $e){
    
                        echo "Error al realizar la solicitud " . $e->getMessage();
    
                    }
    
                    echo "<pre>AAA" . htmlspecialchars($respuesta) . "</pre>";
                    
    
                }

               

                    

                

                

            }
            

        ?>
    </div>

</body>
</html>