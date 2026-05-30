<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

include("../conexion.php");

$id_usuario = $_SESSION['id_usuario'];

$sqlUsuario = "SELECT * FROM usuarios
               WHERE id = $id_usuario";

$resultadoUsuario = $conexion->query($sqlUsuario);

$usuario = $resultadoUsuario->fetch_assoc();

if($usuario['ya_voto']){

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Voto Ya Registrado</title>

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

        .info-card{

            background:white;

            width:100%;
            max-width:520px;

            border-radius:28px;

            padding:50px;

            text-align:center;

            box-shadow:
            0 20px 50px rgba(0,0,0,0.18);

        }

        .icon{

            width:100px;
            height:100px;

            background:#fef3c7;

            color:#d97706;

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

            padding:12px 24px;

            font-weight:500;

        }

    </style>

</head>

<body>

<div class="info-card">

    <div class="icon">

        🗳️

    </div>

    <h1 class="title">

        Voto Ya Registrado

    </h1>

    <p class="text">

        Nuestro sistema indica que usted
        ya realizó su voto anteriormente.

        <br><br>

        Por seguridad electoral,
        únicamente se permite un voto
        por usuario registrado.

    </p>

    <a href="../dashboard.php"
       class="btn btn-dark btn-custom">

        Volver al Panel

    </a>

</div>

</body>

</html>

<?php

exit();

}

$sqlEleccion = "SELECT * FROM elecciones
                WHERE estado = 1
                LIMIT 1";

$resultadoEleccion = $conexion->query($sqlEleccion);

if($resultadoEleccion->num_rows == 0){

    echo "<h2>No hay elecciones activas.</h2>";
    exit();

}

$eleccion = $resultadoEleccion->fetch_assoc();

$ahora = date("Y-m-d H:i:s");

if($ahora < $eleccion['fecha_inicio']
   || $ahora > $eleccion['fecha_fin']){

    echo "<h2>La votación no está disponible actualmente.</h2>";
    exit();

}

$sqlCandidatos = "SELECT * FROM candidatos";

$candidatos = $conexion->query($sqlCandidatos);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Votar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>
<?php include("../includes/navbar.php"); ?>
<div class="container mt-5">

    <h2 class="mb-4 text-center">

        Seleccione su candidato

    </h2>

    <div class="row">

    <?php while($candidato = $candidatos->fetch_assoc()){ ?>

        <div class="col-md-4 mb-4">

            <div class="card shadow h-100">

                <img src="<?php echo $candidato['foto']; ?>"
                     class="card-img-top"
                     style="height:300px; object-fit:cover;">

                <div class="card-body text-center">

                    <h4>

                        <?php echo $candidato['nombre']; ?>

                    </h4>

                    <p>

                        <?php echo $candidato['partido']; ?>

                    </p>

                    <form action="guardar_voto.php"
                          method="POST">

                        <input type="hidden"
                               name="id_candidato"
                               value="<?php echo $candidato['id']; ?>">

                        <button class="btn btn-success w-100">

                            Votar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

</body>
</html>