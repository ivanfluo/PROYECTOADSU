<?php

include("../conexion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$rol = $_POST['rol'];

$sql = "UPDATE usuarios

        SET

        nombre='$nombre',
        usuario='$usuario',
        password='$password',
        rol='$rol'

        WHERE id=$id";

if($conexion->query($sql)){

    header("Location: listar.php");

}else{

    echo "Error al actualizar";

}

?>