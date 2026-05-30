```php
<?php

session_start();

include("conexion.php");

$usuario = $_POST['usuario'];

$password = $_POST['password'];


$sql = "SELECT *
        FROM usuarios
        WHERE usuario = ?
        AND password = ?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param(
    "ss",
    $usuario,
    $password
);

$stmt->execute();

$resultado = $stmt->get_result();


if($resultado->num_rows > 0){

    $fila = $resultado->fetch_assoc();

    $_SESSION['id_usuario'] = $fila['id'];

    $_SESSION['usuario'] = $fila['usuario'];

    $_SESSION['rol'] = $fila['rol'];

    if(
    $fila['rol'] == 'votante'
    &&
    $fila['ya_voto'] == 0
){

    header("Location: votos/votar.php");

}else{

    header("Location: dashboard.php");

}

exit();

}else{

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Acceso Denegado</title>

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

        .error-card{

            background:white;

            width:100%;
            max-width:500px;

            border-radius:28px;

            padding:50px;

            text-align:center;

            box-shadow:
            0 20px 50px rgba(0,0,0,0.18);

        }

        .error-icon{

            width:100px;
            height:100px;

            background:#fee2e2;

            color:#dc2626;

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

            line-height:1.7;

            margin-bottom:35px;

        }

        .btn-custom{

            border-radius:14px;

            padding:12px 25px;

            font-weight:500;

        }

    </style>

</head>

<body>

<div class="error-card">

    <div class="error-icon">

        ✕

    </div>

    <h1 class="title">

        Acceso Denegado

    </h1>

    <p class="text">

        El usuario o la contraseña ingresados
        no son válidos.

        <br><br>

        Verifique sus credenciales e
        inténtelo nuevamente.

    </p>

    <a href="login.php"
       class="btn btn-dark btn-custom">

        Volver al Login

    </a>

</div>

</body>

</html>

<?php

}

?>
```
