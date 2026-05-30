<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Nueva Votación</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header">

                    <h3>Nueva Votación</h3>

                </div>

                <div class="card-body">

                    <form action="guardar.php"
                          method="POST">

                        <div class="mb-3">

                            <label>Nombre</label>

                            <input type="text"
                                   name="nombre"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label>Fecha</label>

                            <input type="date"
                                   name="fecha"
                                   class="form-control"
                                   required>

                        </div>

                        <button class="btn btn-success">

                            Guardar

                        </button>

                        <a href="listar.php"
                           class="btn btn-secondary">

                            Volver

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>