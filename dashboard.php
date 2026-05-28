<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
}

include("conexion.php");

$id_usuario = $_SESSION['id_usuario'];

$rol = $_SESSION['rol'];

$sqlUsuario = "SELECT usuarios.*,
                      candidatos.nombre AS candidato_votado

               FROM usuarios

               LEFT JOIN votos
               ON usuarios.id = votos.id_usuario

               LEFT JOIN candidatos
               ON votos.id_candidato = candidatos.id

               WHERE usuarios.id = $id_usuario";

$resultadoUsuario = $conexion->query($sqlUsuario);

$usuario = $resultadoUsuario->fetch_assoc();

$totalUsuarios =
$conexion->query("SELECT COUNT(*) AS total
                  FROM usuarios")
          ->fetch_assoc()['total'];

$totalVotos =
$conexion->query("SELECT COUNT(*) AS total
                  FROM votos")
          ->fetch_assoc()['total'];

$participacion = 0;

if($totalUsuarios > 0){

    $participacion =
    ($totalVotos * 100) / $totalUsuarios;

}

$sqlResultados = "SELECT candidatos.nombre,
                         candidatos.partido,
                         candidatos.foto,
                         COUNT(votos.id) AS total_votos

                  FROM candidatos

                  LEFT JOIN votos
                  ON candidatos.id = votos.id_candidato

                  GROUP BY candidatos.id

                  ORDER BY total_votos DESC";

$resultados = $conexion->query($sqlResultados);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Dashboard</title>

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

}

.topbar{

    background:#111827;

    padding:18px 35px;

    color:white;

    display:flex;

    justify-content:space-between;

    align-items:center;

}

.logo{

    font-size:24px;

    font-weight:600;

}

.card-custom{

    border:none;

    border-radius:24px;

    box-shadow:0 5px 20px rgba(0,0,0,0.06);

}

.vote-alert{

    background:linear-gradient(
        135deg,
        #2563eb,
        #1d4ed8
    );

    color:white;

}

.success-alert{

    background:linear-gradient(
        135deg,
        #059669,
        #047857
    );

    color:white;

}

.candidate-img{

    width:80px;
    height:80px;

    object-fit:cover;

    border-radius:16px;

}

.progress{

    height:22px;

    border-radius:20px;

}

.section-title{

    font-weight:600;

    color:#111827;

}

</style>

</head>

<body>

<div class="topbar">

    <div>

        <div class="logo">

            Sistema de Votaciones

        </div>

        <small>

            Bienvenido,
            <?php echo $_SESSION['usuario']; ?>

        </small>

    </div>

    <a href="logout.php"
       class="btn btn-danger">

        Cerrar Sesión

    </a>

</div>

<div class="container py-5">

    <?php if(!$usuario['ya_voto']){ ?>

        <div class="card card-custom vote-alert mb-5">

            <div class="card-body p-5">

                <h2 class="mb-3">

                    Su voto está pendiente

                </h2>

                <p class="mb-4">

                    Usted aún no ha emitido su voto
                    en el sistema electoral.

                </p>

                <a href="votos/votar.php"
                   class="btn btn-light btn-lg">

                    Ir a Votar

                </a>

            </div>

        </div>

    <?php }else{ ?>

        <div class="card card-custom success-alert mb-5">

            <div class="card-body p-5">

                <h2 class="mb-3">

                    Voto Registrado Correctamente

                </h2>

                <p>

                    Su voto ya fue registrado
                    en el sistema electoral.

                </p>

                <h4 class="mt-4">

                    Usted votó por:

                    <strong>

                        <?php
                        echo $usuario['candidato_votado'];
                        ?>

                    </strong>

                </h4>

            </div>

        </div>

    <?php } ?>

    <div class="card card-custom mb-5">

        <div class="card-body p-4">

            <h4 class="section-title mb-4">

                Participación Electoral

            </h4>

            <div class="progress">

                <div class="progress-bar bg-success"

                     style="width:
                     <?php echo $participacion; ?>%;">

                    <?php
                    echo round($participacion,2);
                    ?>%

                </div>

            </div>

        </div>

    </div>

    <h3 class="section-title mb-4">

        Resultados en Vivo

    </h3>

    <?php while($fila = $resultados->fetch_assoc()){ ?>

        <?php

        $porcentaje = 0;

        if($totalVotos > 0){

            $porcentaje =
            ($fila['total_votos'] * 100)
            / $totalVotos;

        }

        ?>

        <div class="card card-custom mb-4">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-2 text-center">

                        <img src="<?php echo $fila['foto']; ?>"
                             class="candidate-img">

                    </div>

                    <div class="col-md-4">

                        <h4>

                            <?php echo $fila['nombre']; ?>

                        </h4>

                        <p class="text-muted">

                            <?php echo $fila['partido']; ?>

                        </p>

                    </div>

                    <div class="col-md-2 text-center">

                        <h2>

                            <?php
                            echo $fila['total_votos'];
                            ?>

                        </h2>

                        <small>

                            votos

                        </small>

                    </div>

                    <div class="col-md-4">

                        <div class="progress">

                            <div class="progress-bar bg-success"

                                 style="width:
                                 <?php echo $porcentaje; ?>%;">

                                <?php
                                echo round($porcentaje,1);
                                ?>%

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    <?php } ?>

    <?php if($rol == 'admin'){ ?>

    <div class="mt-5">

        <h3 class="section-title mb-4">

            Administración

        </h3>

        <div class="row g-4">

            <div class="col-md-4">

                <a href="usuarios/listar.php"
                   class="btn btn-dark w-100 p-4">

                    Usuarios

                </a>

            </div>

            <div class="col-md-4">

                <a href="mesas/listar.php"
                   class="btn btn-dark w-100 p-4">

                    Mesas

                </a>

            </div>

            <div class="col-md-4">

                <a href="candidatos/listar.php"
                   class="btn btn-dark w-100 p-4">

                    Candidatos

                </a>

            </div>

        </div>

    </div>

    <?php } ?>

</div>

</body>

</html>