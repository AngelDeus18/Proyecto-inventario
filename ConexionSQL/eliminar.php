<?php 
include "conexion.php";

if(!empty($_GET["id"])){
    $id = $_GET["id"];
    $sql = $conn->query("DELETE FROM usuarios WHERE id='$id'");
    if ($sql) {
        header("location: ../php/administrador.php");
        exit(); 
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
}
?>

