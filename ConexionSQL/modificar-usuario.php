<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nombre"]) && !empty($_POST["email"]) && !empty($_POST["cedula"])&& !empty($_POST["contraseña"]) && !empty($_POST["rol"])) {
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $cedula = $_POST["cedula"];
        $contraseña=$_POST["contraseña"];
        $id_roles = $_POST["rol"];
        $id = $_POST["id"];

        $sql = $conn->query("UPDATE usuarios SET nombre='$nombre', email='$email', cedula='$cedula',contraseña='$contraseña', id_roles='$id_roles' WHERE id='$id'");
        if ($sql) {
            header("location: ../php/administrador.php");
            exit(); 
        } else {
            echo "Error al actualizar el usuario: " . $conn->error;
        }
    } else {
        echo "Campos vacíos";
    }
} else {
    echo "Acceso no autorizado";
}
?>