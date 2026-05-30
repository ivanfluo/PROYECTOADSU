<?php

include("../conexion.php");

$numero_mesa = $_POST['numero_mesa'];

$ubicacion = $_POST['ubicacion'];

$sql = "INSERT INTO mesas
        (numero_mesa, ubicacion)

        VALUES

        ('$numero_mesa', '$ubicacion')";

if($conexion->query($sql)){

    header("Location: listar.php");

}else{

    echo "Error al guardar";

}

?>