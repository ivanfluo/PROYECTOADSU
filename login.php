<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Iniciar Sesión</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    <style>

        *{

            margin:0;
            padding:0;
            box-sizing:border-box;

        }

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

        .login-card{

            width:100%;
            max-width:420px;

            background:white;

            border-radius:24px;

            padding:45px;

            box-shadow:
            0 15px 40px rgba(0,0,0,0.18);

        }

        .logo{

            width:85px;
            height:85px;

            background:#111827;

            border-radius:20px;

            display:flex;

            justify-content:center;

            align-items:center;

            margin:auto;

            margin-bottom:25px;

            color:white;

            font-size:34px;

            font-weight:700;

        }

        .title{

            text-align:center;

            font-weight:600;

            color:#111827;

            margin-bottom:10px;

        }

        .subtitle{

            text-align:center;

            color:#6b7280;

            margin-bottom:35px;

            font-size:14px;

        }

        .form-control{

            border-radius:14px;

            padding:14px;

            border:1px solid #d1d5db;

        }

        .form-control:focus{

            box-shadow:none;

            border-color:#111827;

        }

        .btn-login{

            background:#111827;

            color:white;

            border:none;

            border-radius:14px;

            padding:14px;

            font-weight:500;

            transition:0.3s;

        }

        .btn-login:hover{

            background:#000;

        }

        .footer-text{

            text-align:center;

            margin-top:25px;

            color:#9ca3af;

            font-size:13px;

        }

    </style>

</head>

<body>

<div class="login-card">

    <div class="logo">

        SV

    </div>

    <h2 class="title">

        Sistema de Votaciones

    </h2>

    <p class="subtitle">

        Acceso seguro al sistema electoral.

    </p>

    <form action="validar.php"
          method="POST">

        <div class="mb-3">

            <label class="form-label">

                Usuario

            </label>

            <input type="text"
                   name="usuario"
                   class="form-control"
                   required>

        </div>

        <div class="mb-4">

            <label class="form-label">

                Contraseña

            </label>

            <input type="password"
                   name="password"
                   class="form-control"
                   required>

        </div>

        <button class="btn btn-login w-100">

            Iniciar Sesión

        </button>

    </form>

    <div class="footer-text">

        Plataforma de votación electrónica

    </div>

</div>

</body>

</html>