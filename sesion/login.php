<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap.min.css">

    

    <?php

        error_reporting(E_ALL);
        ini_set("display_errors",1);

        require "../conexion.php";




        if($_SERVER["REQUEST_METHOD"]=="POST"){

            $email = $_POST["email"]??"";
            $password = $_POST["contrasena"]??"";

            $admin = false;

            $consulta = "SELECT * FROM admins WHERE email = :e";
                $stmt = $_conexion->prepare($consulta);
                $stmt->execute(
                    [
                        "e"=>$email
                    ]
                    );

            $res1 = $stmt->fetch();

            if(!$res1){
                $consulta = "SELECT * FROM users WHERE email = :e";
                $stmt = $_conexion->prepare($consulta);
                $stmt->execute(
                    [
                        "e"=>$email
                    ]
                    );

                $res2 = $stmt->fetch();
            }
            else{
                $admin = true;
            }
            

            //Si no es admin y el res de usuario no hay registro
            if(!$admin && !$res2){
                $err_user = "El usuario o contraseña no son correctos";
            }
            //Si es admin
            elseif($admin){
                //if(password_verify($password, $res1["password"])){
                if($password == $res1["password"]){
                    session_start();
                    $_SESSION["admin"] = $res1["email"];

                    header("location: ../paginas/index.php");
                }
                else{
                    $err_user = "El usuario o contraseña no son correctos";
                }
            }
            //Si el usuarios existe
            else{
                if(password_verify($password, $res2["password"])){
                    session_start();
                    $_SESSION["user"] = $res2["email"];

                    header("location: ../paginas/index.php");
                }
                else{
                    $err_user = "El usuario o contraseña no son correctos";
                }
                
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