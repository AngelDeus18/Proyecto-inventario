<?php 
include "conexion.php";

if (!empty($_POST["nombre"]) && !empty($_POST["email"]) && !empty($_POST["cedula"]) && !empty($_POST["contraseña"]) && !empty($_POST["rol"]) && !empty($_POST["nombre"])) {

    $sql = "INSERT INTO usuarios (nombre, email, cedula, contraseña, id_roles) VALUES (?, ?, ?, ?, ?)";
    echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $_POST["nombre"], $_POST["email"], $_POST["cedula"], $_POST["contraseña"], $_POST["rol"]);

    if ($stmt->execute()) {
        
    } else {
        echo "Problemas al dar de alta alumno: " . $stmt->error;
    }
    $stmt->close();
}
?>
