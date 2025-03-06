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
            $usuario = $_POST["usuario"]??"";
            $password = $_POST["contrasena"]??"";

            $caracteres_especiales = "./ñ-_";
            $patron = "/^(?=.*[A-Z])(?=.*[$caracteres_especiales])[\w$caracteres_especiales]{10,}$/";

            if(!preg_match($patron,$password)){
                $err_pass = "La contraseña debe tener al menos un caracter especial ($caracteres_especial), una letra mayuscula y 10 o mas caracteres";
            }
            else{
                $password = password_hash($password, PASSWORD_DEFAULT);

                $datos = [
                    "user"=>$usuario,

                ]
                
                
            }

            /*

            $consulta = "SELECT * FROM usuarios WHERE user='$usuario'";
            $user = $_conexion -> query($consulta);

            if($user -> num_rows!=0){
                $err_user = "Ya existe el usuario";
            }
            else{
                $password = password_hash($password,PASSWORD_DEFAULT);

                $consulta = "INSERT INTO usuarios VALUES
                                ('$usuario','$password')";

                $_conexion->query($consulta);

                $bien = "SE INGRESO EL USUARIO!!";
            }

            */
        }
    ?>
</head>
<body>
    <div class="container">
        <h1>Formulario de registro:</h1>
        <form action="" method="post" enctype="multipart/form-data" class="col-4">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control">
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