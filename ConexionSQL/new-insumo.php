<?php 
include "conexion.php";

if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["estado"]) && !empty($_POST["fecha-registro"])) {

    $sql = "INSERT INTO insumos (NomInsumo, Descripcion, Estado, FechaRegistro) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $_POST["nombre"], $_POST["descripcion"], $_POST["estado"], $_POST["fecha-registro"]);

    if ($stmt->execute()) {
        header("location: ../php/admin-insumos.php");
    } else {
        echo "Problemas al dar de alta insumo: " . $stmt->error;
    }
    $stmt->close();
}
?>
