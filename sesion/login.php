<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap.min.css">

    

    <?php

        session_start();
        error_reporting(E_ALL);
        ini_set("display_errors",1);

        require "../conexion.php";




        if($_SERVER["REQUEST_METHOD"]=="POST"){

            $email = $_POST["email"]??"";
            $password = $_POST["contrasena"]??"";

            $consulta = "SELECT * FROM users WHERE email = :e";
                $stmt = $_conexion->prepare($consulta);
                $stmt->execute(
                    [
                        "e"=>$email
                    ]
                    );

            $res = $stmt->fetch();


            if(!$res){
                $err_user = "El usuario o contraseña no son correctos";
            }
            else{
                var_dump($res);
                /*
                $user = $res;
                if(password_verify($password, $user["password"])){
                    $bien = "SE INICIO SESION!!";

                    $_SESSION["usuario"] = $usuario;

                    header("location: ../paginas/index.php");
                } 
                else {
                    $err_password = "La contraseña no coincide!!";
                }
                    */
                
            }

            
        }
    ?>
</head>
<body>
    <div class="container">
        <h1>Iniciar sesion:</h1>
        <form action="" method="post" enctype="multipart/form-data" class="col-4">
            <div class="mb-3">
                <label class="form-label" name="email">Email</label>
                <input type="text" name="email" class="form-control">
                <p class="bg-warning"><?php if(isset($err_user)) echo $err_user; ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label" name="contrasena">Contraseña</label>
                <input type="password" name="contrasena" class="form-control">
                <p class="bg-warning"><?php if(isset($err_password)) echo $err_password; ?></p>
            </div>
            <div class="mb-3">
                <input type="submit" value="Login" class="btn btn-primary">
            </div>
        </form>
        <h3>Si no tienes cuenta, registrate!!</h3>
        <a href="singup.php" class="btn btn-secondary">Registrarse</a>
    </div>

    <p class="bg-info"><?php if(isset($bien)) echo $bien; ?></p>
    
</body>
</html>