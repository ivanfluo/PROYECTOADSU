<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

include("../conexion.php");

$sql = "SELECT * FROM votaciones";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Votaciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">

        <h2>Votaciones</h2>

        <a href="crear.php"
           class="btn btn-primary">

            Nueva Votación

        </a>

    </div>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

        <?php while($fila = $resultado->fetch_assoc()){ ?>

            <tr>

                <td><?php echo $fila['id']; ?></td>

                <td><?php echo $fila['nombre']; ?></td>

                <td><?php echo $fila['fecha']; ?></td>

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