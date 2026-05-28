<?php

session_start();

include("../conexion.php");

$id_usuario = $_SESSION['id_usuario'];

$id_candidato = $_POST['id_candidato'];

$sqlUsuario = "SELECT * FROM usuarios
               WHERE id = $id_usuario";

$resultadoUsuario = $conexion->query($sqlUsuario);

$usuario = $resultadoUsuario->fetch_assoc();

if($usuario['ya_voto']){

    header("Location: votar.php");

    exit();

}

$sql = "INSERT INTO votos

(id_usuario, id_candidato, fecha_voto)

VALUES

('$id_usuario',
 '$id_candidato',
 NOW())";

if($conexion->query($sql)){

    $conexion->query("UPDATE usuarios
                      SET ya_voto = 1
                      WHERE id = $id_usuario");

}else{

    die("Error al registrar voto");

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Voto Registrado</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    <style>

        body{

            background:
            linear-gradient(
                135deg,
                #111827,
                #1f2937
            );

            min-height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

            font-family:'Poppins', sans-serif;

        }

        .success-card{

            background:white;

            width:100%;
            max-width:500px;

            border-radius:28px;

            padding:50px;

            text-align:center;

            box-shadow:
            0 20px 50px rgba(0,0,0,0.18);

        }

        .success-icon{

            width:100px;
            height:100px;

            background:#dcfce7;

            color:#16a34a;

            border-radius:50%;

            display:flex;

            justify-content:center;

            align-items:center;

            font-size:50px;

            margin:auto;

            margin-bottom:30px;

        }

        .title{

            font-weight:600;

            color:#111827;

            margin-bottom:15px;

        }

        .text{

            color:#6b7280;

            margin-bottom:35px;

            line-height:1.7;

        }

        .btn-custom{

            border-radius:14px;

            padding:12px 25px;

            font-weight:500;

        }

    </style>

</head>

<body>

<div class="success-card">

    <div class="success-icon">

        ✓

    </div>

    <h1 class="title">

        Voto Registrado

    </h1>

    <p class="text">

        Su voto ha sido registrado correctamente
        en el sistema electoral.

        <br><br>

        Gracias por participar.

    </p>

    <a href="../dashboard.php"
       class="btn btn-success btn-custom">

        Volver al Panel

    </a>

</div>

</body>

</html>