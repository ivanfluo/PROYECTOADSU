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

$sql = "SELECT * FROM usuarios WHERE id = $id";

$resultado = $conexion->query($sql);

$usuario = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php include("../includes/navbar.php"); ?>
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header">
                    <h3>Editar Usuario</h3>
                </div>

                <div class="card-body">

                    <form action="actualizar.php" method="POST">

                        <input type="hidden"
                               name="id"
                               value="<?php echo $usuario['id']; ?>">

                        <div class="mb-3">
                            <label>Nombre</label>

                            <input type="text"
                                   name="nombre"
                                   class="form-control"
                                   value="<?php echo $usuario['nombre']; ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Usuario</label>

                            <input type="text"
                                   name="usuario"
                                   class="form-control"
                                   value="<?php echo $usuario['usuario']; ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Contraseña</label>

                            <input type="text"
                                   name="password"
                                   class="form-control"
                                   value="<?php echo $usuario['password']; ?>"
                                   required>
                        </div>

                        <div class="mb-3">

                            <label>Rol</label>

                            <select name="rol"
                                    class="form-control">

                                <option value="admin"
                                    <?php
                                    if($usuario['rol'] == 'admin'){
                                        echo "selected";
                                    }
                                    ?>>
                                    Admin
                                </option>

                                <option value="usuario"
                                    <?php
                                    if($usuario['rol'] == 'usuario'){
                                        echo "selected";
                                    }
                                    ?>>
                                    Usuario
                                </option>

                            </select>

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