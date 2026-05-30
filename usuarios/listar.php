<?php

session_start();

if($_SESSION['rol'] != 'admin'){
    header("Location: ../dashboard.php");
}

include("../conexion.php");

$sql = "SELECT usuarios.*,
               mesas.numero_mesa

        FROM usuarios

        LEFT JOIN mesas
        ON usuarios.id_mesa = mesas.id";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Usuarios</title>

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

        .container-box{

            background:white;

            padding:30px;

            border-radius:20px;

            box-shadow:0 5px 20px rgba(0,0,0,0.06);

        }

        .page-title{

            font-weight:600;

            color:#1f2937;

        }

        .table{

            vertical-align:middle;

        }

        .table thead{

            background:#1f2937;

            color:white;

        }

        .badge-admin{

            background:#0d6efd;

            padding:8px 12px;

            border-radius:10px;

            font-size:12px;

        }

        .badge-votante{

            background:#198754;

            padding:8px 12px;

            border-radius:10px;

            font-size:12px;

        }

        .estado-si{

            color:#198754;

            font-weight:600;

        }

        .estado-no{

            color:#dc3545;

            font-weight:600;

        }

        .btn-custom{

            border-radius:10px;

            padding:6px 14px;

            font-size:14px;

        }

        .search-box{

            border-radius:12px;

            padding:10px 15px;

            border:1px solid #d1d5db;

        }

    </style>

</head>

<body>

<?php include("../includes/navbar.php"); ?>

<?php

if(isset($_GET['success'])){

?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.addEventListener('DOMContentLoaded', function(){

    Swal.fire({

        icon: 'success',

        title: 'Usuario registrado',

        text: 'El usuario fue creado correctamente.',

        confirmButtonColor: '#0d6efd',

        confirmButtonText: 'Aceptar'

    });

});

</script>

<?php

}

?>

<div class="container py-5">

    <div class="container-box">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="page-title">

                    Gestión de Usuarios

                </h2>

                <p class="text-muted">

                    Administración de votantes y administradores.

                </p>

            </div>

            <a href="crear.php"
               class="btn btn-primary btn-custom">

                + Nuevo Usuario

            </a>

        </div>

        <div class="mb-4">

            <input type="text"
                   id="buscador"
                   class="form-control search-box"
                   placeholder="Buscar usuario...">

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle"
                   id="tablaUsuarios">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Nombre</th>
                        <th>DPI</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Mesa</th>
                        <th>Estado</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                <?php while($fila = $resultado->fetch_assoc()){ ?>

                    <tr>

                        <td>

                            <?php echo $fila['id']; ?>

                        </td>

                        <td>

                            <?php echo $fila['nombre']; ?>

                        </td>

                        <td>

                            <?php echo $fila['dpi']; ?>

                        </td>

                        <td>

                            <?php echo $fila['usuario']; ?>

                        </td>

                        <td>

                            <?php

                            if($fila['rol'] == 'admin'){

                                echo "<span class='badge-admin'>
                                      Admin
                                      </span>";

                            }else{

                                echo "<span class='badge-votante'>
                                      Votante
                                      </span>";

                            }

                            ?>

                        </td>

                        <td>

                            Mesa
                            <?php echo $fila['numero_mesa']; ?>

                        </td>

                        <td>

                            <?php

                            if($fila['ya_voto']){

                                echo "<span class='estado-si'>
                                      Ya votó
                                      </span>";

                            }else{

                                echo "<span class='estado-no'>
                                      Pendiente
                                      </span>";

                            }

                            ?>

                        </td>

                        <td>

                            <a href="editar.php?id=<?php echo $fila['id']; ?>"
                               class="btn btn-warning btn-sm btn-custom">

                                Editar

                            </a>

                            <a href="eliminar.php?id=<?php echo $fila['id']; ?>"
                               class="btn btn-danger btn-sm btn-custom">

                                Eliminar

                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

const buscador = document.getElementById("buscador");

buscador.addEventListener("keyup", function(){

    let filtro = buscador.value.toLowerCase();

    let filas =
    document.querySelectorAll("#tablaUsuarios tbody tr");

    filas.forEach(function(fila){

        let texto = fila.innerText.toLowerCase();

        fila.style.display =
        texto.includes(filtro)
        ? ""
        : "none";

    });

});

</script>

</body>

</html>