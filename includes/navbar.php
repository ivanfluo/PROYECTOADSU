<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container-fluid">

        <a class="navbar-brand"
           href="../dashboard.php">

            Sistema Votaciones

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav me-auto">

                <?php if($_SESSION['rol'] == 'admin'){ ?>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="../usuarios/listar.php">

                            Usuarios

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="../mesas/listar.php">

                            Mesas

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="../candidatos/listar.php">

                            Candidatos

                        </a>

                    </li>

                <?php } ?>

                <li class="nav-item">

                    <a class="nav-link"
                       href="../votos/votar.php">

                        Votar

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="../votos/resultados.php">

                        Resultados

                    </a>

                </li>

            </ul>

            <span class="navbar-text text-white me-3">

                <?php echo $_SESSION['usuario']; ?>

            </span>

            <a href="../logout.php"
               class="btn btn-danger btn-sm">

                Cerrar Sesión

            </a>

        </div>

    </div>

</nav>