<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú principal</title>
    <link rel="stylesheet" href="../bootstrap.min.css">

    <?php

        session_start();

        if(empty($_SESSION["user"]) && empty($_SESSION["admin"])){
            header("location:../sesion/login.php");
            exit;
        }

    ?>
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Bienvenido al sistema de fly with</h1>
        <p class="mt-3 ">Elige una opción:</p>
        <div class="d-grid gap-3 col-6 mx-auto mt-4">
            <a href="planes.php" class="btn btn-primary btn-lg">Ver planes</a>
        </div>
    </div>

    <a href="../sesion/logout.php">Cerrar sesion</a>

    
</body>
</html>