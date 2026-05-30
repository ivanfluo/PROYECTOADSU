<?php

include("../conexion.php");

$nombre = $_POST['nombre'];

$partido = $_POST['partido'];

$foto = $_POST['foto'];

$sql = "INSERT INTO candidatos

(nombre, partido, foto)

VALUES

('$nombre',
 '$partido',
 '$foto')";

if($conexion->query($sql)){

    header("Location: listar.php");

}else{

    echo "Error al guardar";

}

?>