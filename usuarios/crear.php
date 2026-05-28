<?php

session_start();
if($_SESSION['rol'] != 'admin'){
    header("Location: ../dashboard.php");
}

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

include("../conexion.php");

$mesas = $conexion->query("SELECT * FROM mesas");

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Nuevo Usuario</title>

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

                    <h3>Nuevo Usuario</h3>

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

                            <label>DPI</label>

                            <input type="text"
                                    name="dpi"
                                    class="form-control"
                                    maxlength="13"
                                    pattern="[0-9]{13}"
                                    title="El DPI debe contener exactamente 13 números"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    required>

                        </div>

                        <div class="mb-3">

                            <label>Usuario</label>

                            <input type="text"
                                   name="usuario"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label>Contraseña</label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label>Rol</label>

                            <select name="rol"
                                    class="form-control">

                                <option value="admin">
                                    Admin
                                </option>

                                <option value="votante">
                                    Votante
                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label>Mesa Asignada</label>

                            <select name="id_mesa"
                                    class="form-control">

                                <?php while($mesa = $mesas->fetch_assoc()){ ?>

                                    <option value="<?php echo $mesa['id']; ?>">

                                        Mesa <?php echo $mesa['numero_mesa']; ?>

                                    </option>

                                <?php } ?>

                            </select>

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