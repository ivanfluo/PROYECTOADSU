<?php

include("../conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM votaciones
        WHERE id = $id";

if($conexion->query($sql)){

    header("Location: listar.php");

}else{

    echo "Error al eliminar";

}

?>