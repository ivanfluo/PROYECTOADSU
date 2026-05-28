<?php

include("../conexion.php");

$id = $_POST['id'];

$numero_mesa = $_POST['numero_mesa'];

$ubicacion = $_POST['ubicacion'];

$sql = "UPDATE mesas

        SET

        numero_mesa='$numero_mesa',
        ubicacion='$ubicacion'

        WHERE id=$id";

if($conexion->query($sql)){

    header("Location: listar.php");

}else{

    echo "Error al actualizar";

}

?>