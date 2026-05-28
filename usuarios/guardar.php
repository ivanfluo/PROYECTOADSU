<?php

session_start();

if($_SESSION['rol'] != 'admin'){
    header("Location: ../dashboard.php");
}

include("../conexion.php");

$nombre = $_POST['nombre'];

$dpi = $_POST['dpi'];

$usuario = $_POST['usuario'];

$password = $_POST['password'];

$rol = $_POST['rol'];

$id_mesa = $_POST['id_mesa'];

$sql = "INSERT INTO usuarios

(nombre, dpi, usuario, password, rol, id_mesa)

VALUES

('$nombre',
 '$dpi',
 '$usuario',
 '$password',
 '$rol',
 '$id_mesa')";

try{

    if($conexion->query($sql)){

        header("Location: listar.php");

    }

}catch(mysqli_sql_exception $e){

    $mensaje = "";

    if(str_contains($e->getMessage(), 'dpi')){

        $mensaje =
        "El DPI ingresado ya se encuentra registrado.";

    }elseif(str_contains($e->getMessage(), 'usuario')){

        $mensaje =
        "El nombre de usuario ya existe.";

    }else{

        $mensaje =
        "Ocurrió un error al guardar el usuario.";

    }

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Error</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    <style>

        body{

            background:#f4f6f9;

            font-family:'Poppins', sans-serif;

            display:flex;

            justify-content:center;

            align-items:center;

            height:100vh;

        }

        .error-card{

            background:white;

            padding:40px;

            border-radius:24px;

            width:100%;
            max-width:500px;

            box-shadow:0 10px 30px rgba(0,0,0,0.08);

            text-align:center;

        }

        .error-icon{

            font-size:70px;

            margin-bottom:20px;

        }

        .error-title{

            font-weight:600;

            color:#dc3545;

            margin-bottom:15px;

        }

        .error-text{

            color:#6b7280;

            margin-bottom:30px;

        }

        .btn-custom{

            border-radius:12px;

            padding:10px 20px;

        }

    </style>

</head>

<body>

<div class="error-card">

    <div class="error-icon">

        ⚠️

    </div>

    <h2 class="error-title">

        Registro no válido

    </h2>

    <p class="error-text">

        <?php echo $mensaje; ?>

    </p>

    <a href="crear.php"
       class="btn btn-danger btn-custom">

        Volver

    </a>

</div>

</body>

</html>

<?php

}

?>