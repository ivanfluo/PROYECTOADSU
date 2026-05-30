<?php

session_start();
if($_SESSION['rol'] != 'admin'){
    header("Location: ../dashboard.php");
}

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

include("../conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM candidatos
        WHERE id = $id";

$resultado = $conexion->query($sql);

$candidato = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Editar Candidato</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>
<?php include("../includes/navbar.php"); ?>
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header">

                    <h3>Editar Candidato</h3>

                </div>

                <div class="card-body">

                    <form action="actualizar.php"
                          method="POST">

                        <input type="hidden"
                               name="id"
                               value="<?php echo $candidato['id']; ?>">

                        <div class="mb-3">

                            <label>Nombre</label>

                            <input type="text"
                                   name="nombre"
                                   class="form-control"
                                   value="<?php echo $candidato['nombre']; ?>"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label>Partido</label>

                            <input type="text"
                                   name="partido"
                                   class="form-control"
                                   value="<?php echo $candidato['partido']; ?>"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label>URL Foto</label>

                            <input type="text"
                                   name="foto"
                                   class="form-control"
                                   value="<?php echo $candidato['foto']; ?>"
                                   required>

                        </div>

                        <button class="btn btn-warning">

                            Actualizar

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