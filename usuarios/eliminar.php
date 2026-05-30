<?php
session_start();

if($_SESSION['rol'] != 'admin'){
    header("Location: ../dashboard.php");
}

include("../conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM usuarios
        WHERE id = $id";

if($conexion->query($sql)){

    header("Location: listar.php");

}else{

    echo "Error al eliminar";

}

?>