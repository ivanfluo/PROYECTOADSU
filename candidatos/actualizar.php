<?php

include("../conexion.php");

$id = $_POST['id'];

$nombre = $_POST['nombre'];

$partido = $_POST['partido'];

$foto = $_POST['foto'];

$sql = "UPDATE candidatos

        SET

        nombre='$nombre',
        partido='$partido',
        foto='$foto'

        WHERE id=$id";

if($conexion->query($sql)){

    header("Location: listar.php");

}else{

    echo "Error al actualizar";

}

?>