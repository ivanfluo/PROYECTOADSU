<?php

include("../conexion.php");

$id = $_POST['id'];

$nombre = $_POST['nombre'];

$fecha = $_POST['fecha'];

$sql = "UPDATE votaciones

        SET

        nombre='$nombre',
        fecha='$fecha'

        WHERE id=$id";

if($conexion->query($sql)){

    header("Location: listar.php");

}else{

    echo "Error al actualizar";

}

?>