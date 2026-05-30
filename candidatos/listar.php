<?php

session_start();
if($_SESSION['rol'] != 'admin'){
    header("Location: ../dashboard.php");
}

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

include("../conexion.php");

$sql = "SELECT * FROM candidatos";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Candidatos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>
<?php include("../includes/navbar.php"); ?>
<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">

        <h2>Candidatos</h2>

        <a href="crear.php"
           class="btn btn-primary">

            Nuevo Candidato

        </a>

    </div>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Nombre</th>
                <th>Partido</th>
                <th>Foto</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

        <?php while($fila = $resultado->fetch_assoc()){ ?>

            <tr>

                <td><?php echo $fila['id']; ?></td>

                <td><?php echo $fila['nombre']; ?></td>

                <td><?php echo $fila['partido']; ?></td>

                <td>

                    <img src="<?php echo $fila['foto']; ?>"
                         width="80">

                </td>

                <td>

                    <a href="editar.php?id=<?php echo $fila['id']; ?>"
                       class="btn btn-warning btn-sm">

                        Editar

                    </a>

                    <a href="eliminar.php?id=<?php echo $fila['id']; ?>"
                       class="btn btn-danger btn-sm">

                        Eliminar

                    </a>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>