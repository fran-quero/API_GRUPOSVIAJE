<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <?php

        error_reporting(E_ALL);
        ini_set("display_errors",1);

        require "../conexion.php";



        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $email = $_POST["email"]??"";
            $password = $_POST["contrasena"]??"";
            $name = $_POST["name"]??"";
            $surname = $_POST["surname"]??"";
            $number = $_POST["number"]??"";

            $caracteres_especiales = ".\ñ";
            //$patron = "/^(?=.*[A-Z])(?=.*[$caracteres_especiales])[\w$caracteres_especiales]{10,}$/";
            $patron = "/[a-zA-Z]/";
            if(!preg_match($patron,$password)){
                $err_pass = "La contraseña debe tener al menos un caracter especial ($caracteres_especiales), una letra mayuscula y 10 o mas caracteres";
            }
            else{

                //Comprobamos si ya existe ese email registrado
                $consulta = "SELECT * FROM users WHERE email = :e";
                $stmt = $_conexion->prepare($consulta);
                $stmt->execute(
                    [
                        "e"=>$email
                    ]
                    );
                $res = $stmt->fetch();
                
                if($res){
                    $err_user = "El usuario ya esta registrado";
                }
                else{
    
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $consulta = "INSERT INTO users (email, password, name, surname, number) VALUES (:e, :p, :n, :s, :num)";
                    $stmt=$_conexion->prepare($consulta);
                    $stmt->execute(
                        [
                            "e"=>$email,
                            "p"=>$password,
                            "n"=>$name,
                            "s"=>$surname,
                            "num"=>$number
                        ]
                        );
                    if($stmt){
                        $bien = "Se creo correctamente el usuario";
                    }
                    else{
                        $bien = "Algo fallo: nose el que!";
                    }
                }

                
                
            }


        }
    ?>
</head>
<body>
    <div class="container">
        <h1>Formulario de registro:</h1>
        <form action="" method="post" enctype="multipart/form-data" class="col-4">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="password" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="password" name="surname" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Telefono</label>
                <input type="password" name="number" class="form-control">
            </div>
            <div class="mb-3">
                <input type="submit" value="Registrarse" class="btn btn-primary">
            </div>
        </form>
        <h3>Si ya tienes cuenta, inicia sesión</h3>
        <a href="login.php" class="btn btn-secondary">Iniciar sesión</a>
        <p class="bg-warning"><?php if(isset($err_user)) echo $err_user; ?></p>
        <p class="bg-warning"><?php if(isset($err_pass)) echo $err_pass; ?></p>
        <p class="bg-info"><?php if(isset($bien)) echo $bien; ?></p>
    </div>


    
</body>
</html>