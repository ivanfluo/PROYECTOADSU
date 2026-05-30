<?php

include("../conexion.php");

$nombre = $_POST['nombre'];

$fecha = $_POST['fecha'];

$sql = "INSERT INTO votaciones
        (nombre, fecha)

        VALUES

        ('$nombre', '$fecha')";

if($conexion->query($sql)){

    header("Location: listar.php");

}else{

    echo "Error al guardar";

}

?>